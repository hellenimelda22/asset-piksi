<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'asets'; // Pastikan tabelnya sesuai

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'kategori_id',
        'tahun_perolehan',
        'lokasi',
        'kondisi',
        'gambar_aset',
        'status',
    ];

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id');
    }

    // Relasi dengan peminjaman aset (one to many)
    public function peminjamanAset()
    {
        return $this->hasMany(PeminjamanAset::class, 'aset_id');  // Relasi ke PeminjamanAset
    }
}
