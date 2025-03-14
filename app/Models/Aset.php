<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_aset', 'nama_aset', 'kategori_id', 'lokasi', 'kondisi', 'gambar_aset', 'status'
    ];
}
