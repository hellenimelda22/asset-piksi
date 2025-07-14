<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPeminjaman extends Model
{
    protected $table = 'bukti_peminjaman';

    protected $fillable = [
        'peminjaman_id',
        'file_bukti'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanAset::class, 'peminjaman_id');
    }
}
