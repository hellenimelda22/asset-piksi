<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAset extends Model
{
    use HasFactory;
    protected $fillable = ['aset_id', 'user_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    public function aset() {
        return $this->belongsTo(Aset::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
