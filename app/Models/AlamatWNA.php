<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlamatWNA extends Model
{
    protected $table = 'alamat_wna';
    protected $fillable = [
    'nomor_paspor',
    'rt',
    'rw',
    'dusun',
    'desa',
    'kecamatan',
    'kabupaten_kota',
    'provinsi',
    'kode_pos',
    'nomor_kontak',
    'email',
];

public function wna()
{
    return $this->belongsTo(WNA::class, 'nomor_paspor', 'nomor_paspor');
}

}
