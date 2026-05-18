<?php

namespace App\Imports;

use App\Models\WNAImport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class WnaImportExcel implements ToModel
{
    public function model(array $row)
    {
        // =========================
        // SKIP HEADER
        // =========================
        if ($row[0] == 'NO.') {
            return null;
        }

        // =========================
        // VALIDASI PASPOR
        // =========================
        if (empty($row[5])) {
            return null;
        }

        $nomorPaspor = trim($row[5]);
        $namaLengkap = trim($row[1]);

        // =========================
        // FORMAT TANGGAL LAHIR
        // =========================
        $tanggalLahir = is_numeric($row[4]) && strlen($row[4]) == 8
            ? Carbon::createFromFormat('Ymd', $row[4])->format('Y-m-d')
            : null;

        // =========================
        // FORMAT MASA BERLAKU
        // =========================
        $masaBerlakuBaru = !empty($row[8])
            ? (
                is_numeric($row[8])
                    ? Date::excelToDateTimeObject($row[8])->format('Y-m-d')
                    : Carbon::createFromFormat('d/m/Y', $row[8])->format('Y-m-d')
            )
            : null;

        // ==================================================
        // 1. CEK NOMOR PASPOR
        // Jika paspor sama → skip
        // ==================================================
        $cekPaspor = WNAImport::where(
            'nomor_paspor',
            $nomorPaspor
        )->first();

        if ($cekPaspor) {
            return null;
        }

        // ==================================================
        // 2. CEK NAMA SAMA
        // Jika nama sama → bandingkan masa berlaku
        // ==================================================
        $cekNama = WNAImport::where(
            'nama_lengkap',
            $namaLengkap
        )->first();

        if ($cekNama) {

            $masaLama = $cekNama->masa_berlaku;

            // Jika data baru lebih terbaru
            if (
                $masaBerlakuBaru &&
                $masaLama &&
                $masaBerlakuBaru > $masaLama
            ) {

                $cekNama->update([
                    'jenis_kelamin'     => $row[2],
                    'tempat_lahir'      => $row[3],
                    'tanggal_lahir'     => $tanggalLahir,
                    'nomor_paspor'      => $nomorPaspor,
                    'kewarganegaraan'   => $row[6],
                    'jenis_izin'        => $row[7],
                    'masa_berlaku'      => $masaBerlakuBaru,
                    'tujuan'            => $row[9],
                    'alamat'            => $row[10],
                    'kabupaten'         => $row[11],
                    'nama_penjamin'     => $row[12],
                    'alamat_penjamin'   => $row[13],
                ]);
            }

            // Skip insert
            return null;
        }

        // ==================================================
        // 3. INSERT DATA BARU
        // ==================================================
        return new WNAImport([
            'nama_lengkap'      => $namaLengkap,
            'jenis_kelamin'     => $row[2],
            'tempat_lahir'      => $row[3],
            'tanggal_lahir'     => $tanggalLahir,
            'nomor_paspor'      => $nomorPaspor,
            'kewarganegaraan'   => $row[6],
            'jenis_izin'        => $row[7],
            'masa_berlaku'      => $masaBerlakuBaru,
            'tujuan'            => $row[9],
            'alamat'            => $row[10],
            'kabupaten'         => $row[11],
            'nama_penjamin'     => $row[12],
            'alamat_penjamin'   => $row[13],
        ]);
    }
}