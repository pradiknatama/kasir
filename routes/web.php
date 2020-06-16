<?php

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
//
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function() {
    return redirect(route('login'));
});
Auth::routes();
Route::group(['middleware'=>'auth'],function(){
  Route::group(['middleware'=>['web','levelcek:1']],function(){
    Route::get('/home',array('as'=>'admin','uses'=>'HomeController@index'));
  });

  Route::group(['middleware'=>['web','levelcek:2']],function(){
    Route::get('/home',array('as'=>'admin','uses'=>'HomeController@index'));
    Route::get('/profil','profilControl@index');
    Route::post('/updateProfil','profilControl@updateprofile');
    Route::get('/produk','produkControll@index');
    Route::get('/produk/create','produkControll@GetAddProduct');
    Route::post('/createProduk','produkControll@tambahProduk');
    Route::get('/produk/edit/{id}','produkControll@getEdit');
    Route::get('/kasir','produkControll@kasir');
    Route::post('/cariData','produkControll@show');
  });

});




Route::get('/home', 'HomeController@index')->name('home');
