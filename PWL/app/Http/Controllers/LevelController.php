<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//menggunakan DB Facade
class LevelController extends Controller
{
    //
    public function index()
    {
        DB::insert('insert into m_level (level_kode, level_nama, created_at) values (?, ?, ?)', ['CS', 'Customer Service', now()]);
        echo "data berhasil ditambah";
    }

    public function LevelInsert()
    {
        DB::insert('insert into m_level (level_kode, level_nama, created_at) values (?, ?, ?)', ['PL', 'Pelanggan', now()]);
        echo "data berhasil ditambah";
    }


    public function LevelUpdate(){
        $row=DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer','cus']);
        return "update data berhasil, jumlah data yang terupdate ".$row." baris";
    }

    public function LevelDelete(){
        $row = DB::delete('delete from m_level where level_kode = ?',['cus']);
        return "delete data berhasil, jumlah data yang terhapus ".$row." baris";
    }

    public function LevelTampilData(){
        $data=DB::select('select * from m_level');
        return view ('level',['data'=>$data]);
    }
}
