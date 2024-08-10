<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{

    public function index(){
        // $anggota = new Anggota;
        // dump($anggota);
        return view('form-pendataran');
    }

    public function AnggotaInsert(){
        $anggota= new Anggota;
        $anggota->nip='123453';
        $anggota->nama='doni';
        $anggota->tanggal_lahir='2002-10-02';
        $anggota->nilai='3.5';
        $anggota->save();
        echo "data berhasil disimpan";
    }

    public function AnggotaUpdate(){
        $anggota= Anggota::find(1);
        $anggota->nama='dono';
        $anggota->nilai='3.0';
        $anggota->save();
        echo "data berhasil diupdate";
    }

    public function AnggotaDelete(){
        $anggota= Anggota::find(1);
        $anggota->delete();
        echo "data berhasil dihapus";
    }


    public function AnggotaAll(){
        $result= Anggota::all();
        return view("tampilkan_anggota",['anggotas'=>$result]);
    }

    public function AnggotaFind(){
        $result= Anggota::find(4);
        return view("tampilkan_anggota",['anggotas'=>[$result]]);
        // dump($result);
    }


    public function AnggotaGetWhere(){
        $result = Anggota::where('nilai','>','3.3')
        ->orderBy('nama', 'desc')
        ->get();
    return view('tampilkan_anggota',['anggotas' => $result]);
    }

    public function prosesForm(Request $request){
        // dump($request);
        echo $request->nip;
        echo "<br>";
        echo $request->nama;
        echo "<br>";
    }

}
