<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\User;
use Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

// Route::get('/dinas', function () {
//     return view('dinas');
// })->middleware('auth:dinas');

// Route::get('/pemilikw', function () {
//     return view('pemilikw');
// })->middleware('auth:pemilikw');

// Route::get('/masuk', function () {
//     return view('login');
// })->middleware('guest');

Auth::routes();
 Route::get('/', function () {
     return view('welcome');
 });
Route::group(['middleware'=>['web','auth']],function(){

 // dd(Auth::user());
 Route::get('/home',function(){
  if(Auth::user()->status==0){
    $kunjungans = DB::table('kunjungans')
                    ->join('wisatas','kunjungans.idwisata','=','wisatas.id')
                    ->select('kunjungans.*', 'wisatas.kapasitas as kapasitas')
                    ->get();
    $reviews = DB::table('reviews')->get();
    $categories = [];
    $data = [];
    foreach($kunjungans as $kunjung){
      if($kunjung->idwisata == 1){
        $categories[] = $kunjung->created_at;
        $data[] = $kunjung->jumlah;
      }
    }
    return view('dasbor', ['kunjungans' => $kunjungans, 'reviews' => $reviews, 'categories' => $categories, 'data' => $data]);
    //return view('pemilikw');
  }
  else if(Auth::user()->status==1){
    $kunjungans = DB::table('kunjungans')
                    ->join('wisatas','kunjungans.idwisata','=','wisatas.id')
                    ->select('kunjungans.*','wisatas.nama as namawisata', 'wisatas.kapasitas as kapasitas')
                    ->get();
    $categories = [];
    $data = [];
    foreach($kunjungans as $kunjung){
      $categories[] = $kunjung->namawisata;
      if($kunjung->created_at == '2020-07-01'){
        $data[] = ($kunjung->jumlah / $kunjung->kapasitas) * 100;
      }
    }
    return view('index', ['kunjungans' => $kunjungans, 'categories' => $categories, 'data' => $data]);
    //return view('dinas');
  } 
 });
});

Route::post('/kirimdata', 'login@masuk');
Route::post('/keluar', 'login@keluar');

//BUAT DINAS

Route::get('/index', 'PageController@index');
Route::get('/datawisata/{wisata}', 'PageController@show');
Route::get('/datawisata','PageController@indexwisata');
Route::get('/dataajuan','PageController@indexajuan');

//masih belom bisa
//pencarian di datawisata.blade.php
Route::get('/search','PageController@search');
//nerima & nolak ajuan di dataajuan.blade.php
Route::put('/dataajuan/acc/{ajuan}', 'PageController@terima');
Route::put('/dataajuan/del/{ajuan}', 'PageController@tolak');


//BUAT PEMILIK

Route::get('/dasbor','OwnController@index');
Route::get('/ajuan','OwnController@indexajuan');
Route::get('/ajuan/delete/{id}','OwnController@delete');
Route::get('/ajuan/create', 'OwnController@create');
Route::post('/ajuan', 'OwnController@store');
Route::get('/about','OwnController@about');





// Route::get('/home', 'HomeController@index')->name('home');
