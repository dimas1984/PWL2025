<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MBarang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'barang_id'=>4,
                'kategori_id' => 3,
                'barang_kode' =>'BR04',
                'barang_nama' => 'Minuman',
                'harga_beli'=>1000,
                'harga_jual'=>1500,
            ],
            [
                'barang_id'=>5,
                'kategori_id' => 1,
                'barang_kode' =>'BR05',
                'barang_nama' => 'Es Cream',
                'harga_beli'=>1200,
                'harga_jual'=>1500,
            ],
            [
                'barang_id'=>6,
                'kategori_id' => 1,
                'barang_kode' =>'BR06',
                'barang_nama' => 'Jus',
                'harga_beli'=>10000,
                'harga_jual'=>15000,
            ]
        ];
        DB::table('m_barang')->insert($data);
    }
}
