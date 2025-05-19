<?php

use Illuminate\Database\Seeder;
use App\Models\Asset;

class AsetSeeder extends Seeder
{
    public function run()
    {
        // 10 Laptop Dell
        for ($i = 1; $i <= 10; $i++) {
            Asset::create([
                'kode_aset' => 'LTP-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_aset' => 'Laptop Dell 3420',
                'kategori_id' => 1, // pastikan kategori_id 1 itu 'Laptop'
                'status' => 'Tersedia',
                'kondisi' => 'Baik',
            ]);
        }

        // 5 Proyektor Epson
        for ($i = 1; $i <= 5; $i++) {
            Asset::create([
                'kode_aset' => 'PRJ-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_aset' => 'Proyektor Epson X100',
                'kategori_id' => 2, // kategori_id 2 itu 'Proyektor'
                'status' => 'Tersedia',
                'kondisi' => 'Baik',
            ]);
        }
    }
}
