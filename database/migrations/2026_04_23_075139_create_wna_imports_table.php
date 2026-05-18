<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wna_imports', function (Blueprint $table) {
            $table->id();

            $table->string('nama_lengkap')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nomor_paspor')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('jenis_izin')->nullable();
            $table->date('masa_berlaku')->nullable();
            $table->string('tujuan')->nullable();

            $table->text('alamat')->nullable();
            $table->string('kabupaten')->nullable();

            $table->string('nama_penjamin')->nullable();
            $table->text('alamat_penjamin')->nullable();

            $table->boolean('is_processed')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wna_imports');
    }
};
