<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//menggunakan query builder
class CatController extends Controller
{
    //
    public function index()
    {
        $data = [
            'kategori_kode' => 'SNK',
            'kategori_nama' => 'Makanan Ringan',
            'created_at' => now()

        ];
        DB::table('m_kategori')->insert($data);
        return "data berhasil ditambah";

    }
    public function KategoriInsert()
    {
        $data = [
            'kategori_kode' => 'SNK',
            'kategori_nama' => 'Makanan Ringan',
            'created_at' => now()

        ];
        DB::table('m_kategori')->insert($data);
        return "data berhasil ditambah";
    }

    public function KategoriUpdate()
    {
        $row = DB::table('m_kategori')->where('kategori_kode', 'KD05')->update(['kategori_nama' => 'minuman']);
        return " data berhasil diupdate,jumlah data yang terupdate " . $row . " baris";
    }

    public function KategoriDelete(){
        $row=DB::table('m_kategori')->where('kategori_kode','SNK')->delete();
        return " data berhasil didelete, jumlah data yang terhapus ".$row. " baris";
    }

    public function KategoriTampilData(){
        $data=DB::table('m_kategori')->get();
        return view('kategori',['data'=>$data]);
    }
}
