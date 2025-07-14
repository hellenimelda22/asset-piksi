<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAset extends Model
{
    use HasFactory;
    protected $fillable =  ['user_id','nama_peminjam', 'aset_id', 'status', 'tanggal_pinjam', 'tanggal_kembali'];
    
     // Relasi ke model Aset
     public function aset()
     {
         return $this->belongsTo(Asset::class,'aset_id');
     }
        public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bukti()
    {
        return $this->hasOne(BuktiPeminjaman::class, 'peminjaman_id');
    }

}
