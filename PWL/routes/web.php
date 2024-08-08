<?php

use App\Http\Controllers\pembimbingController;
use App\Http\Controllers\pengajarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello',function(){
    return 'hello word';
});

Route::get('/VSGA',function(){
    return 'selamat datang di pelatihan VSGA';
});

Route::get('/ucapan',function(){
return 'selamat datang';
});

Route::get('/about',function(){
    return 'NIM : 1232132313';
});

// route menggunakan parameter
Route::get('/user/{nama}',function($nama){
    return 'nama saya ' .$nama;
});

//route menggunakan 2 parameter
Route::get('/posts/{post}/{comment}',function($post,$comment)
{
    return 'parameter pertama '.$post.' Komentar '.$comment;
});

//optional route
Route::get('/users/{name?}',function($name="noname"){
    return 'Nama saya '.$name;
});
Route::get('/userss/{name?}',function($name="nulls"){
    return 'Nama saya '.$name;
});
Route::get('/kodebarang/{jenis?}/{merek?}',function($jenis='ko1',$merek='mr01'){
    return "kode barang ".$jenis." kode merek ".$merek;
});


//route name
Route::get('about',function(){
    return view('about');
})->name('about');

Route::get('tampil',function(){
    return view('tampil');
})->name('tampil');


//route redirect
Route::get('/pesandisini',function(){
    return '<h1> silakan pesan disini  </h1>';
});
Route::redirect('/contactus','/pesandisini');

//route group
Route::prefix('/polinema')->group(function(){
   Route::get('/dosen',function(){
    echo "<h1>nama dosen</h1>";
   });
   Route::get('/tendik',function(){
    echo "<h1>nama tendik</h1>";
   });
   Route::get('/jurusan',function(){
    echo "<h1>nama jurusan</h1>";
   });
});

Route::prefix('/admin')->group(function(){
    Route::get('/dosen',function(){
     echo "<h1>nama dosen admin</h1>";
    });
    Route::get('/tendik',function(){
     echo "<h1>nama tendik admin</h1>";
    });
    Route::get('/jurusan',function(){
     echo "<h1>nama jurusan admin</h1>";
    });
 });

 //route fallback
 Route::fallback(function(){
    return "mohon halaman ini tidak tersedia";
 });

 //penggunaan route untuk controller
Route::get('/daftar-dosen',[pengajarController::class,'daftarPengajar']);
Route::get('/tabel-pengajar',[pengajarController::class,'tabelPengajar']);
Route::get('/blog-pengajar',[pengajarController::class,'blogPengajar']);



