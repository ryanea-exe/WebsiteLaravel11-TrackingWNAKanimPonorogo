<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan WNA</title>

    <style>
        @page {
            margin-top: 25px;
            margin-right: 20px;
            margin-bottom: 25px;
            margin-left: 20px;
        }

        body {
            padding: 10px;
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
        }

        .header h3 {
            margin: 2px;
            font-size: 12px;
            font-weight: bold;
        }

        .header p {
            margin: 2px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 9px;
        }

        th, td {
            border: 1px solid #000;
            padding: 2px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            font-size: 8px;
            font-weight: bold;
        }

        .text-left { text-align: left; }

        tr { page-break-inside: avoid; }
        thead { display: table-header-group; }

        /* ===== FORCE WIDTH KOLOM (DOMPDF FIX) ===== */
        th:nth-child(1), td:nth-child(1) { width: 2%; }   /* NO */
        th:nth-child(2), td:nth-child(2) { width: 10%; }  /* NAMA */
        th:nth-child(3), td:nth-child(3) { width: 4%; }   /* L/P */
        th:nth-child(4), td:nth-child(4) { width: 9%; }   /* TEMPAT LAHIR */
        th:nth-child(5), td:nth-child(5) { width: 6%; }   /* TGL LAHIR */
        th:nth-child(6), td:nth-child(6) { width: 8%; }   /* PASPOR */
        th:nth-child(7), td:nth-child(7) { width: 9%; }   /* NEGARA */
        th:nth-child(8), td:nth-child(8) { width: 5%; }   /* JENIS */
        th:nth-child(9), td:nth-child(9) { width: 7%; }   /* MASA BERLAKU */
        th:nth-child(10), td:nth-child(10) { width: 8%; } /* TUJUAN */
        th:nth-child(11), td:nth-child(11) { width: 14%; }/* ALAMAT */
        th:nth-child(12), td:nth-child(12) { width: 7%; } /* KOTA */
        th:nth-child(13), td:nth-child(13) { width: 7%; } /* PENJAMIN */
        th:nth-child(14), td:nth-child(14) { width: 10%; }/* ALAMAT PENJAMIN */
    </style>
</head>
<body>

@php
    function warnaKabupaten($kabupaten) {
        $kabupaten = strtolower($kabupaten);

        if (str_contains($kabupaten, 'pacitan')) return 'rgba(59,130,246,0.25)';
        if (str_contains($kabupaten, 'trenggalek')) return 'rgba(251,191,36,0.25)';
        if (str_contains($kabupaten, 'ponorogo')) return 'rgba(34,197,94,0.25)';

        return 'rgba(135,206,235,0.25)';
    }

    $wilayah = request('wilayah') ?? '';
    $warnaHeader = warnaKabupaten($wilayah);

    $grouped = collect($data)->groupBy('jenis_izin');

    $no = 1;
@endphp

<!-- HEADER -->
<div class="header">
    <h3>DATA ORANG ASING PEMEGANG IZIN KEIMIGRASIAN</h3>
    <p>KANTOR IMIGRASI KELAS II NON TPI PONOROGO</p>
    <p>KABUPATEN {{ strtoupper($wilayah ?: 'SEMUA WILAYAH') }}</p>
    <p>PERIODE {{ strtoupper(now()->locale('id')->translatedFormat('F Y')) }}</p>
</div>

<!-- TABEL UTAMA -->
<table>

    <thead>
        <tr style="background-color: {{ $warnaHeader }};">
            <th>NO</th>
            <th>NAMA LENGKAP</th>
            <th>L/P</th>
            <th>TEMPAT LAHIR</th>
            <th>TGL LAHIR</th>
            <th>NO. PASPOR</th>
            <th>KEWARGANEGARAAN</th>
            <th>JENIS</th>
            <th>MASA BERLAKU</th>
            <th>TUJUAN</th>
            <th>ALAMAT</th>
            <th>KOTA/KAB</th>
            <th>PENJAMIN</th>
            <th>ALAMAT PENJAMIN</th>
        </tr>
    </thead>

    <tbody>
    @forelse($grouped as $jenis_izin => $items)

        <!-- SUBHEADER -->
        <tr>
            <td colspan="14" style="background: rgba(255,165,0,0.2); font-weight:bold; text-align:left;">
                {{ strtoupper($jenis_izin) }}
            </td>
        </tr>

        @foreach($items as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td class="text-left">{{ $item->nama_lengkap }}</td>
            <td>
                @php
                    $jk = strtolower($item->jenis_kelamin);
                @endphp

                {{ str_contains($jk, 'l') ? 'L' : 'P' }}
            </td>
            <td>{{ $item->tempat_lahir }}</td>
            <td>
                {{ $item->tanggal_lahir 
                    ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') 
                    : '-' 
                }}
            </td>
            <td>{{ $item->nomor_paspor }}</td>
            <td>{{ $item->kewarganegaraan }}</td>
            <td>{{ strtoupper($item->jenis_izin) }}</td>
            <td>
                {{ $item->masa_berlaku
                    ? \Carbon\Carbon::parse($item->masa_berlaku)->format('d/m/Y') 
                    : '-' 
                }}
            </td>
            <td>{{ $item->tujuan ?? '-' }}</td>
            <td class="text-left">{{ $item->alamat ?? '-' }}</td>
            <td>{{ $item->kabupaten ?? '-' }}</td>
            <td>{{ $item->nama_penjamin }}</td>
            <td class="text-left">{{ $item->alamat_penjamin ?? '-' }}</td>
        </tr>
        @endforeach

    @empty
        <tr>
            <td colspan="14">Tidak ada data</td>
        </tr>
    @endforelse
    </tbody>
</table>

<br><br>

@php
    function normalize($text) {
        return strtolower(trim($text));
    }

    $groupedRekap = collect($data)->groupBy(function ($item) {
        return normalize($item->jenis_izin);
    });

    $mapping = [
        'affidavit' => 'AFFIDAVIT',
        'voa' => 'VOA',
        'itk' => 'ITK',
        'itas' => 'ITAS',
        'itap' => 'ITAP',
    ];

    $rekap = [];

    foreach ($mapping as $key => $label) {
        $rekap[$label] = $groupedRekap->get($key, collect())->count();
    }

    $total = array_sum($rekap);

    $warnaTotal = str_replace('0.25', '0.5', $warnaHeader);
@endphp

<!-- TABEL REKAP -->
<table style="width: 50%; margin-top:10px;">
    <thead>
        <tr style="background-color: {{ $warnaHeader }};">
            <th>IZIN TINGGAL</th>
            <th>JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekap as $izin => $jumlah)
        <tr>
            <td class="text-left">{{ $izin }}</td>
            <td>{{ $jumlah }}</td>
        </tr>
        @endforeach

        <tr style="background-color: {{ $warnaTotal }}; font-weight:bold;">
            <td>TOTAL</td>
            <td>{{ $total }}</td>
        </tr>
    </tbody>
</table>

</body>
</html>