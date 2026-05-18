<?php

namespace App\Http\Controllers;

use App\Models\WNAImport;

class DashboardController extends Controller
{
    // ===================== DASHBOARD =====================
public function index()
{
    // =========================
    // TOTAL WNA
    // =========================
    $total_wna = WNAImport::count();

    // =========================
    // STATISTIK JENIS IZIN
    // =========================
    $statistikIzin = WNAImport::selectRaw('jenis_izin, COUNT(*) as total')
        ->groupBy('jenis_izin')
        ->pluck('total', 'jenis_izin')
        ->toArray();

    $voa       = $statistikIzin['VOA'] ?? 0;
    $itas      = $statistikIzin['ITAS'] ?? 0;
    $itap      = $statistikIzin['ITAP'] ?? 0;
    $itk       = $statistikIzin['ITK'] ?? 0;
    $affidavit = $statistikIzin['AFFIDAVIT'] ?? 0;

    // =========================
    // STATISTIK WILAYAH
    // =========================
    $trenggalek = WNAImport::whereIn('kabupaten', [
        'Trenggalek',
        'KAB. TRENGGALEK'
    ])->count();

    $ponorogo = WNAImport::whereIn('kabupaten', [
        'Ponorogo',
        'KAB. PONOROGO'
    ])->count();

    $pacitan = WNAImport::whereIn('kabupaten', [
        'Pacitan',
        'KAB. PACITAN'
    ])->count();

    // =========================
    // STATISTIK JENIS KELAMIN
    // =========================
    $laki_laki = WNAImport::where('jenis_kelamin', 'Laki-laki')->count();

    $perempuan = WNAImport::where('jenis_kelamin', 'Perempuan')->count();

    // =========================
    // STATUS PENGURUSAN PASPOR
    // =========================

    // Sudah Perpanjangan
    $perpanjangan = WNAImport::where('status_pengurusan', 'perpanjangan')
        ->count();

    // Belum Perpanjangan + NULL
    $belum_perpanjangan = WNAImport::where('status_pengurusan', 'belum_perpanjangan')
        ->orWhereNull('status_pengurusan')
        ->count();

    $status_pengurusan = [
        'perpanjangan'       => $perpanjangan,
        'belum_perpanjangan' => $belum_perpanjangan,
    ];

    // =========================
    // DATA TUJUAN
    // =========================
    $tujuan_data = WNAImport::selectRaw('tujuan, COUNT(*) as jumlah')
        ->whereNotNull('tujuan')
        ->where('tujuan', '!=', '')
        ->groupBy('tujuan')
        ->orderByDesc('jumlah')
        ->get()
        ->map(function ($item) use ($total_wna) {

        $nama = trim($item->tujuan);

        if ($nama === '-') {
        $nama = 'AFFIDAVIT';
        
        } elseif (trim($nama) === '') {
            $nama = 'LAIN-LAIN';
        }

        // Replace underscore
        $nama = str_replace('_', ' ', $nama);

        // Uppercase semua
        $nama = strtoupper($nama);

        return [
            'nama'   => $nama,
            'jumlah' => $item->jumlah,
            'persen' => $total_wna > 0
                ? round(($item->jumlah / $total_wna) * 100, 1)
                : 0,
        ];
    });

    // =========================
    // RETURN VIEW
    // =========================
    return view('admin.dashboard', compact(
        'total_wna',
        'voa',
        'itas',
        'itap',
        'itk',
        'affidavit',
        'trenggalek',
        'ponorogo',
        'pacitan',
        'laki_laki',
        'perempuan',
        'status_pengurusan',
        'tujuan_data'
    ));
}
}