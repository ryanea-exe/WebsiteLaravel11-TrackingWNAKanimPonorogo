<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WNA extends Model
{
    protected $primaryKey = 'nomor_paspor';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'wna';

    protected $fillable = [
        'nomor_paspor',
        'nama',
        'jenis_kelamin',
        'kewarganegaraan',
        'nomor_register',
        'masa_izin_tinggal',
        'penjamin',
        'jenis_izin_tinggal',
        'created_by'
    ];

    public function alamat()
    {
        return $this->hasOne(\App\Models\AlamatWna::class, 'nomor_paspor', 'nomor_paspor');
    }
}