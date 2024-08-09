<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function hello(){
        return('hello word');
    }

    public function greeting(){
        return view('blog.hello',['name'=>'ando']);
    }
}
