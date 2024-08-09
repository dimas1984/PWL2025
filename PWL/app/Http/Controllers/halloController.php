<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class halloController extends Controller
{
    //
    public function hello(){
        return('hello word');
    }

    public function greeting(){
        return view('blog.hellow')
        ->with('name','antok')
        ->with('pekerjaan','petani');
    }
}
