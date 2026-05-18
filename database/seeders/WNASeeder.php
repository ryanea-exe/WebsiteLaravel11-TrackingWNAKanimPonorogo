<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WNA;
use App\Models\AlamatWNA;
use Illuminate\Support\Str;

class WNASeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {

            $passport = 'P' . strtoupper(Str::random(7));

            // Insert ke tabel WNA
            WNA::create([
                'nomor_paspor' => $passport,
                'nama' => fake()->name(),
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                'kewarganegaraan' => fake()->country(),
                'nomor_register' => 'REG-' . rand(1000, 9999),
                'masa_izin_tinggal' => fake()->date(),
                'penjamin' => fake()->name(),
                'jenis_izin_tinggal' => fake()->randomElement(['KITAS', 'KITAP']),
                'created_by' => 1
            ]);

            // Insert ke tabel alamat_wna
            AlamatWNA::create([
                'nomor_paspor' => $passport,
                'rt' => rand(1, 10),
                'rw' => rand(1, 5),
                'dusun' => fake()->streetName(),
                'desa' => fake()->city(),
                'kecamatan' => fake()->randomElement(['Pundak', 'Sugihmoro', 'Sawo', 'Durenan'])
                // 'kabupaten_kota' => fake()->randomElement(['Ponorogo', 'Pacitan', 'Trenggalek']),
                // 'kode_pos' => fake()->postcode(),
                // 'nomor_kontak' => fake()->phoneNumber(),
                // 'email' => fake()->safeEmail(),
            ]);
        }
    }
}