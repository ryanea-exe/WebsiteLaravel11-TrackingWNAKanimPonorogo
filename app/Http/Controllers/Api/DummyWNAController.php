<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WNA;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DummyWNAController extends Controller
{
    public function generate(Request $request)
    {
        $jumlah = $request->input('jumlah', 10);

        $data = [];

        for ($i = 0; $i < $jumlah; $i++) {
            $data[] = WNA::create([
                'nomor_paspor' => strtoupper(Str::random(9)),
                'nama' => fake()->name(),
                'kewarganegaraan' => fake()->country(),
                'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
                'tanggal_lahir' => fake()->date(),
                'alamat' => fake()->address(),
                'wilayah' => fake()->city(),
                'jenis_tinggal' => fake()->randomElement(['Wisata', 'Kerja', 'Belajar']),
            ]);
        }

        return response()->json([
            'message' => 'Dummy WNA berhasil dibuat',
            'jumlah' => $jumlah,
            'data' => $data
        ]);
    }
}