<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash; // ✅ penting

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Seksi Teknologi',
            'username' => 'seksi_teknologi', // ⚠️ jangan pakai spasi (best practice)
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->call(WNASeeder::class);
    }
}