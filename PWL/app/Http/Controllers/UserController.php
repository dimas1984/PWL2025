<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index (){

        $user= UserModel::all();
        return view('user',['dat'=>$user]);
    }


    public function UserInsert(){
        $data=
            [
                'username'=>'dika',
                'nama'=>'dika',
                'password'=>Hash::make(23445),
                'user_id'=>4,
                'level_id'=>1
            ];
            UserModel::insert($data);

            $user= UserModel::all();
            return view('user',['dat'=>$user]);
    }

    public function UserUpdate(){
        $data=[
            'nama'=>'yuli'
        ];
        UserModel::where('username','dika')->update($data);

        $user= UserModel::all();
            return view('user',['dat'=>$user]);

    }

    public function UserDelete(){
        UserModel::where('username','dika')->delete();

        $user= UserModel::all();
        return view('user',['dat'=>$user]);

    }

}

