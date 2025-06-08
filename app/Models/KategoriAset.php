<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    
    protected $table = 'kategori_asets';

    protected $fillable = ['nama_kategori'];

    public function aset()
    {
        return $this->hasMany(Asset::class, 'kategori_id');
    }
}
