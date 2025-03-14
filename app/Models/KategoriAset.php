<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    protected $table = 'kategori_aset'; // Pastikan sesuai dengan database
    protected $fillable = ['nama_kategori']; // Pastikan kolom bisa diisi
}
