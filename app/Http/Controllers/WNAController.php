<?php

namespace App\Http\Controllers;

use App\Models\WNAImport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\NotificationHelper;

class WNAController extends Controller
{

    // ===================== INDEX =====================
    public function index(Request $request)
    {
        $query = WNAImport::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                  ->orWhere('nama_penjamin', 'like', "%$search%")
                  ->orWhere('nomor_paspor', 'like', "%$search%")
                  ->orWhere('kewarganegaraan', 'like', "%$search%")
                  ->orWhere('jenis_izin', 'like', "%$search%")
                  ->orWhere('tujuan', 'like', "%$search%")
                  ->orWhere('tempat_lahir', 'like', "%$search%")
                  ->orWhere('kabupaten', 'like', "%$search%");
            });
        }

        $data = $query->latest()->paginate(50);

        // STATISTIK
        $statistikIzin = (clone $query)->get()
            ->groupBy('jenis_izin')
            ->map(fn($item) => $item->count());

        return view('admin.wna.index', compact('data', 'statistikIzin'));
    }

    // ===================== CREATE =====================
    public function create()
    {
        return view('admin.wna.create');
    }

    // ===================== STORE =====================
    public function store(Request $request)
    {
        $request->validate([
            'nomor_paspor' => 'required|unique:wna_imports,nomor_paspor',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'kewarganegaraan' => 'required',
        ]);

        $data = $request->all();

        $data['status_pengurusan'] = $request->status_pengurusan ?? null;

        $wna = WNAImport::create($data);

        NotificationHelper::send(
            'staff',
            'Data WNA Ditambahkan',
            auth()->user()->username . ' menambahkan data WNA ' . $wna->nama_lengkap,
            'create',
            $wna->nomor_paspor
        );

        return redirect()->route('wna.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // ===================== EDIT =====================
    public function edit($nomor_paspor)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }
        
        $wna = WNAImport::findOrFail($nomor_paspor);
        return view('admin.wna.edit', compact('wna'));
    }

    // ===================== UPDATE =====================
    public function update(Request $request, $nomor_paspor)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $wna = WNAImport::findOrFail($nomor_paspor);

        $data = $request->all();
        $data['status_pengurusan'] = $request->status_pengurusan ?? null;

        $wna->update($data);

        NotificationHelper::send(
            'staff',
            'Data WNA Diperbarui',
            auth()->user()->username . ' memperbarui data WNA ' . $wna->nama_lengkap,
            'update',
            $wna->nomor_paspor
        );

        return back()->with('success', 'Data berhasil diperbarui');
    }

    // ===================== DELETE =====================
    public function destroy($nomor_paspor)
    {
        if (auth()->user()->role !== 'admin') {
        abort(403, 'Akses ditolak');
    }
    
        $wna = WNAImport::findOrFail($nomor_paspor);

        NotificationHelper::send(
            'staff',
            'Data WNA Dihapus',
            auth()->user()->username . ' menghapus data WNA ' . $wna->nama_lengkap,
            'delete',
            null
        );

        $wna->delete();

        return redirect()->back()
            ->with('success', 'Data berhasil dihapus');
    }

    // ===================== SHOW =====================
   public function show($nomor_paspor)
    {
        $wna = WNAImport::findOrFail($nomor_paspor);
        return view('admin.wna.show', compact('wna')); // ← path sederhana
    }

    // ===================== FILTER WILAYAH =====================
    public function wilayah(Request $request, $wilayah)
    {
        // Normalisasi wilayah (biar fleksibel)
        $wilayahUpper = strtoupper($wilayah);

        $listWilayah = [
            strtoupper($wilayah),
            'KAB. ' . strtoupper($wilayah),
            'KAB ' . strtoupper($wilayah),
        ];

        $query = WNAImport::whereIn('kabupaten', $listWilayah);

        // Filter tanggal jika ada
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Statistik izin
        $data = [
            'voa' => (clone $query)->where('jenis_izin', 'VOA')->count(),
            'itas' => (clone $query)->where('jenis_izin', 'ITAS')->count(),
            'itap' => (clone $query)->where('jenis_izin', 'ITAP')->count(),
            'itk' => (clone $query)->where('jenis_izin', 'ITK')->count(),
            'affidavit' => (clone $query)->where('jenis_izin', 'AFFIDAVIT')->count(),
        ];

        // Data bulanan
        $bulanan = (clone $query)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [];
        $values = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->format('M');
            $values[] = $bulanan[$i] ?? 0;
        }

        // Total & gender
        $total = $query->count();
        $laki = (clone $query)->where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = (clone $query)->where('jenis_kelamin', 'Perempuan')->count();

        // =========================
        // REKAP TUJUAN WNA
        // =========================
        $tujuan_wna = WNAImport::selectRaw('tujuan, COUNT(*) as jumlah')
            ->whereIn('kabupaten', [
                strtoupper($wilayah),
                'KAB. ' . strtoupper($wilayah)
            ])
            ->whereNotNull('tujuan')
            ->where('tujuan', '!=', '')
            ->groupBy('tujuan')
            ->orderByDesc('jumlah')
            ->get()
            ->map(function ($item) use ($total) {

                $nama = trim($item->tujuan);

                // "-" => AFFIDAVIT
                if ($nama === '-') {
                    $nama = 'AFFIDAVIT';
                }

                $nama = strtoupper(str_replace('_', ' ', $nama));

                return [
                    'nama'   => $nama,
                    'jumlah' => $item->jumlah,
                    'persen' => $total > 0
                        ? round(($item->jumlah / $total) * 100, 1)
                        : 0,
                ];
            });

        return view('admin.wna.wilayah', compact(
            'wilayah',
            'data',
            'labels',
            'values',
            'total',
            'laki',
            'perempuan',
            'tujuan_wna'
        ));
    }

    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:5120' // 5MB max
        ]);

        try {
            Excel::import(new WNAImport(), $request->file('file'));

            NotificationHelper::send(
                'staff',
                'Import Data WNA',
                auth()->user()->username . ' melakukan import data WNA',
                'create',
                null
            );
            
            Log::info('WNA Import Success', [
                'user_id' => auth()->id(),
                'file_name' => $request->file('file')->getClientOriginalName()
            ]);

            return back()->with('import_success', '✅ Data WNA berhasil diimport!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMsg = "❌ Error di baris: " . collect($failures)->pluck('row')->implode(', ');
            
            Log::error('WNA Import Failed - Validation', [
                'user_id' => auth()->id(),
                'errors' => $failures
            ]);

            return back()->withErrors(['file' => $errorMsg]);

        } catch (\Exception $e) {
            Log::error('WNA Import Failed', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return back()->withErrors(['file' => '❌ Format file tidak valid atau data tidak sesuai template']);
        }
    }

   public function kabupaten(Request $request, $wilayah, $jenis = null)
    {
        $wilayahUpper = strtoupper($wilayah);

        $listWilayah = [
            $wilayahUpper,
            'KAB. ' . $wilayahUpper,
            'KAB ' . $wilayahUpper,
        ];

        $query = WNAImport::whereIn('kabupaten', $listWilayah);

        if ($jenis) {
            $query->where('jenis_izin', strtoupper($jenis));
        }

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('nomor_paspor', 'like', "%{$search}%")
                ->orWhere('tujuan', 'like', "%{$search}%")
                ->orWhere('tempat_lahir', 'like', "%{$search}%")
                ->orWhere('kewarganegaraan', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(50);

        return view('admin.wna.list', compact('data', 'wilayah', 'jenis'));
    }
}