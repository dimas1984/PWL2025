<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\CRUDPhoto;
use App\Http\Controllers\halloController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PageControllerSatu;
use App\Http\Controllers\pembimbingController;
use App\Http\Controllers\pengajarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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
Route::get('/daftar_dosen',[pengajarController::class,'daftarPengajar']);
Route::get('/tabel_pengajar',[pengajarController::class,'tabelPengajar']);
Route::get('/blog_pengajar',[pengajarController::class,'blogPengajar']);
Route::get('/pasar-buah',[PageControllerSatu::class,'satu']);

//route resourse
Route::resource('crud', CRUDController::class);

// route beberapa resource
Route::resource('photo',CRUDPhoto::class)->only([
    'index',
    'show'
]);

Route::resource('photos',CRUDPhoto::class)->except([
    'create',
    'store',
    'destroy',
    'edit'
]);

//view untuk route
Route::get('/selamat', function(){
    return view('hello',['name'=>'dono']);
});

// view untuk controller
Route::get('/greeting',[WelcomeController::class,'greeting']);

//meneruskan data ke view
Route::get('/pekerjaan',[halloController::class,'greeting']);


// route LevelController menggunakan DBFacade
Route::get('/level',[LevelController::class,'index']);
Route::get('/LevelInsert',[LevelController::class,'LevelInsert']);
Route::get('/LevelUpdate',[LevelController::class,'LevelUpdate']);
Route::get('/LevelDelete',[LevelController::class,'LevelDelete']);
Route::get('/LevelTampilData',[LevelController::class,'LevelTampilData']);


// route KategoriController menggunakan Query builder
Route::get('/kategori',[KategoriController::class,'index']);
Route::get('/KategoriInsert',[KategoriController::class,'KategoriInsert']);
Route::get('/KategoriUpdate',[KategoriController::class,'KategoriUpdate']);
Route::get('/KategoriDelete',[KategoriController::class,'KategoriDelete']);
Route::get('/KategoriTampilData',[KategoriController::class,'KategoriTampilData']);

// route UserController Menggunakan ORM
Route::get('/user',[UserController::class,'index']);
Route::get('/UserInsert',[UserController::class,'UserInsert']);
Route::get('/UserUpdate',[UserController::class,'UserUpdate']);
Route::get('/UserDelete',[UserController::class,'UserDelete']);

// route AnggotaController menggunakan ORM
Route::get('/AnggotaCekObject',[AnggotaController::class,'index']);
Route::get('/AnggotaInsert',[AnggotaController::class,'AnggotaInsert']);
Route::get('/AnggotaUpdate',[AnggotaController::class,'AnggotaUpdate']);
Route::get('/AnggotaDelete',[AnggotaController::class,'AnggotaDelete']);
Route::get('/AnggotaAll',[AnggotaController::class,'AnggotaAll']);
Route::get('/AnggotaFind',[AnggotaController::class,'AnggotaFind']);
Route::get('/AnggotaGetWhere',[AnggotaController::class,'AnggotaGetWhere']);

// route form
Route::get('/AnggotaForm',[AnggotaController::class,'index']);
// Route::get('proses-form',[AnggotaController::class,'prosesForm']);

//laravel bth CSRF token jika menggunakan metode post
// CSRF -> cross site request forgery
Route::post('/proses-form',[AnggotaController::class,'prosesForm']);

