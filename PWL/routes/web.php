<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\CRUDPhoto;
use App\Http\Controllers\halloController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PageControllerSatu;
use App\Http\Controllers\pembimbingController;
use App\Http\Controllers\pengajarController;
use App\Http\Controllers\StokController;
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

Route::pattern('id','[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka


Route::get('/', [WelcomeController::class,'index']);

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

//route menggunakan 2 parameter
Route::get('/posts/{post}/{comment}',function($post,$comment)
{
    return 'parameter pertama '.$post.' Komentar '.$comment;
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

//  //route fallback
//  Route::fallback(function(){
//     return "mohon halaman ini tidak tersedia";
//  });

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
Route::post('/level/list',[LevelController::class,'list']); // untuk list json datatables
Route::get('/level/create',[LevelController::class,'create']);
Route::post('/level',[LevelController::class,'store']);
Route::get('/level/{id}/edit',[LevelController::class,'edit']); // untuk tampilkan form edit
Route::put('/level/{id}',[LevelController::class,'update']);    // untuk proses update data
Route::delete('/level/{id}',[LevelController::class,'destroy']); // untuk proses hapus data


Route::get('/LevelInsert',[LevelController::class,'LevelInsert']);
Route::get('/LevelUpdate',[LevelController::class,'LevelUpdate']);
Route::get('/LevelDelete',[LevelController::class,'LevelDelete']);
Route::get('/LevelTampilData',[LevelController::class,'LevelTampilData']);



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


Route::get('/tsa', [\App\Http\Controllers\TSAController::class, 'index']);
Route::get('/tsb', [\App\Http\Controllers\TSAController::class, 'alamat']);



// route CatController menggunakan Query builder
Route::get('/kategori',[KategoriController::class,'index']);

Route::get('/kategori/{id}',[KategoriController::class,'show']);
Route::get('/kategori/create',[KategoriController::class,'create']);

Route::post('/kategori/list',[KategoriController::class,'list']); // utk list json datatables
Route::post('/kategori',[KategoriController::class,'store']);
Route::get('/kategori/{id}/edit',[KategoriController::class,'edit']); // utk tampilkan form edit
Route::put('/kategori/{id}',[KategoriController::class,'update']);    // utk proses update data
Route::delete('/kategori/{id}',[KategoriController::class,'destroy']); // utk proses hapus data

Route::get('/kategori/{id}',[KategoriController::class,'show']);
Route::post('/KategoriInsert',[CatController::class,'KategoriInsert']);
Route::put('/KategoriUpdate',[CatController::class,'KategoriUpdate']);
Route::delete('/KategoriDelete',[CatController::class,'KategoriDelete']);
Route::get('/KategoriTampilData',[CatController::class,'KategoriTampilData']);


// route UserController Menggunakan ORM
Route::get('/user',[UserController::class,'index']);
Route::get('/user/create',[UserController::class,'create']);
Route::post('/user',[UserController::class,'store']);
Route::post('/user/list',[UserController::class,'list']);
Route::get('/user/{id}/edit',[UserController::class,'edit']);
Route::put('/user/{id}',[UserController::class,'update']);
Route::delete('/user/{id}',[UserController::class,'destroy']); 
Route::get('/user/create_ajax',[UserController::class,'create_ajax']); // ajax form create
Route::post('/user_ajax',[UserController::class,'store_ajax']); // ajax store
Route::get('/user/{id}/edit_ajax',[UserController::class,'edit_ajax']); // ajax form edit
Route::put('/user/{id}/update_ajax',[UserController::class,'update_ajax']); // ajax update
Route::get('/user/{id}/delete_ajax',[UserController::class,'confirm_ajax']); // ajax form confirm delete
Route::delete('/user/{id}/delete_ajax',[UserController::class,'delete_ajax']); // ajax delete




// route UserController Menggunakan ORM
Route::get('/stok',[StokController::class,'index']);
Route::get('/stok/create',[StokController::class,'create']);
Route::post('/stok',[StokController::class,'store']);
Route::post('/stok/list',[StokController::class,'list']);
Route::get('/stok/{id}/edit',[StokController::class,'edit']);
Route::put('/stok/{id}',[StokController::class,'update']);
Route::delete('/stok/{id}',[StokController::class,'destroy']); 
Route::get('/stok/create_ajax',[StokController::class,'create_ajax']); // ajax form create
Route::post('/stok_ajax',[StokController::class,'store_ajax']); // ajax store
Route::get('/stok/{id}/edit_ajax',[StokController::class,'edit_ajax']); // ajax form edit
Route::put('/stok/{id}/update_ajax',[StokController::class,'update_ajax']); // ajax update
Route::get('/stok/{id}/delete_ajax',[StokController::class,'confirm_ajax']); // ajax form confirm delete
Route::delete('/stok/{id}/delete_ajax',[StokController::class,'delete_ajax']); // ajax delete