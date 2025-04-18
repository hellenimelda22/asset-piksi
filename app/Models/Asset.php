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
        'lokasi',
        'kondisi',
        'gambar_aset',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id');
    }
}
