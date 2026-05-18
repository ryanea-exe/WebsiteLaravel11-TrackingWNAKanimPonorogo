<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alamat_wna', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_paspor');

            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('dusun')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota');
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();

            $table->string('nomor_kontak')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('nomor_paspor')
                ->references('nomor_paspor')
                ->on('wna')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alamat_wna');
    }
};