<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home']
        ];

        return  view('dashboard')
            ->with('breadcrumb', $breadcrumb);
    }
}
