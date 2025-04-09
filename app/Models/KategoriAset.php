<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    // Menyatakan nama tabel yang digunakan
    protected $table = 'kategori_asets'; // Sesuaikan nama tabel dengan database

    // Definisikan kolom yang boleh diisi secara massal (untuk keamanan)
    protected $fillable = ['nama_kategori'];
}
