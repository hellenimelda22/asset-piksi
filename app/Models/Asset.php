<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'asets';

    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'kategori_id',
        'tahun_perolehan',
        'lokasi',
        'kondisi',
        'gambar_aset',
        'status',
        'luas',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id');
    }

    public function peminjamanAset()
    {
        return $this->hasMany(PeminjamanAset::class, 'aset_id');
    }
}
