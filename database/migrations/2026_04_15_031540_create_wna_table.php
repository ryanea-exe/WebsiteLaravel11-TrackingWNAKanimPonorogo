<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wna', function (Blueprint $table) {
            $table->string('nomor_paspor')->primary(); // PK
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('kewarganegaraan');

            $table->string('nomor_register')->nullable();
            $table->date('masa_izin_tinggal')->nullable();
            $table->string('penjamin')->nullable();

            $table->string('jenis_izin_tinggal');

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wna');
    }
};