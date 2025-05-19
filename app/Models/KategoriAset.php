<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    // Menambahkan nama_kategori ke dalam $fillable
    protected $fillable = ['nama_kategori']; // <-- Tambahkan ini

    // Relasi dengan Asset
    public function aset()
    {
        return $this->hasMany(Asset::class, 'kategori_id');
    }
}
