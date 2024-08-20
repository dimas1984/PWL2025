<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TSAController extends Controller
{
    public function index()
    {
        return view('hello_world');

//        $nama_lengkap = 'Alleria <strong>Windrunner</strong>';
//        $alamat = 'Malang';
//        $umur = 20;

        // pakai compact function
        // return view('tsa', compact('nama', 'alamat', 'umur'));

        // pakai array
        /*return view('tsa', [
            'nm' => $nama_lengkap,
            'alamat' => $alamat,
            'umur' => $umur
        ]);*/

        // pakai function with
        /*return view('tsa')
                    ->with('nm', $nama_lengkap)
                    ->with('alamat', $alamat)
                    ->with('umur', $umur);*/


    }

    public function alamat()
    {
        return view('hello_alamat');
    }
}
