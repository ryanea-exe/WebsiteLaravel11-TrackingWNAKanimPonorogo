<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WNAImport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\NotificationHelper;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = WNAImport::query();

        // ================= FILTER WILAYAH =================
        if ($request->filled('wilayah')) {
            $wilayah = strtoupper($request->wilayah);

            $listWilayah = [
                $wilayah,
                'KAB. ' . $wilayah,
                'KAB ' . $wilayah,
            ];

            $query->whereIn('kabupaten', $listWilayah);
        }

        // ================= FILTER JENIS IZIN =================
        if ($request->filled('jenis_izin')) {
            $query->where('jenis_izin', $request->jenis_izin);
        }

        $data = $query->latest()->paginate(20)->withQueryString();

        return view('admin.laporan.index', compact('data'));
    }

    public function cetak(Request $request)
    {
        $query = WNAImport::query();

        NotificationHelper::send(
            'admin',
            'Laporan Dicetak',
            auth()->user()->username . ' mencetak laporan WNA',
            'laporan',
            null
        );

        // ================= FILTER WILAYAH =================
        if ($request->filled('wilayah')) {
            $wilayah = strtoupper($request->wilayah);

            $listWilayah = [
                $wilayah,
                'KAB. ' . $wilayah,
                'KAB ' . $wilayah,
            ];

            $query->whereIn('kabupaten', $listWilayah);
        }

        // ================= FILTER JENIS IZIN =================
        if ($request->filled('jenis_izin')) {
            $query->where('jenis_izin', $request->jenis_izin);
        }

        $data = $query->latest()->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('data'))
            ->setPaper([0, 0, 595, 935], 'landscape');

        $kabupaten = $request->wilayah ?? 'Semua';

        return $pdf->download('Data WNA Kabupaten ' . $kabupaten . '.pdf');
    }
}