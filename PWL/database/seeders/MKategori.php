<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MKategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'kategori_id' => 3,
                'kategori_kode' =>'KD03',
                'kategori_nama' => 'kode03',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'KD04',
                'kategori_nama' => 'kode04',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'KD05',
                'kategori_nama' => 'kode05',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
