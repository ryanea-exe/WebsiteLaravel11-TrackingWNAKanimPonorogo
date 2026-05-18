<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WNAImport extends Model
{
    protected $table = 'wna_imports';

    protected $primaryKey = 'nomor_paspor';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_paspor',
        'kewarganegaraan',
        'jenis_izin',
        'masa_berlaku',
        'tujuan',
        'alamat',
        'kabupaten',
        'nama_penjamin',
        'alamat_penjamin',
        'is_processed',
        'status_pengurusan',
    ];
}