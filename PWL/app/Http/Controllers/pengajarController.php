<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pengajarController extends Controller
{
    //
    public function daftarPengajar(){
        return ' form daftar pengajar mahasiswa';
    }

    public function tabelPengajar(){
        return ' ini tabel pengajar mahasiswa';
    }

    public function blogPengajar(){
        return 'ini blog pengajar';
    }
}
