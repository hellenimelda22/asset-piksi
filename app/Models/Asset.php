<?php

// App\Models\Aset.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    // Menyatakan nama tabel yang digunakan (jika tidak sesuai default)
    protected $table = 'asets'; 

    // Relasi: setiap aset memiliki satu kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id');
    }
}
