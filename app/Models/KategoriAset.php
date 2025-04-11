<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    // Menyatakan nama tabel yang digunakan
    protected $table = 'kategori_asets'; // Pastikan sesuai dengan nama tabel di database

    // Kolom yang boleh diisi massal
    protected $fillable = ['nama_kategori'];

    // Relasi: satu kategori punya banyak aset
    public function asets()
    {
        return $this->hasMany(Aset::class, 'kategori_id');
    }
}
