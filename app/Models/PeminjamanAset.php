<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAset extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama_peminjam',
        'aset_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];
    
    public function aset() {
        return $this->belongsTo(Asset::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
