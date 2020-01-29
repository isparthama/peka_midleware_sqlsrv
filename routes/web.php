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

/*Route::get('/', function () {
    return view('/layouts/login');
});*/

/*Route::get('/', 'User@login');
Route::get('/home', 'User@index');
Route::get('/login', 'User@login');
Route::post('/loginPost', 'User@loginPost');
Route::get('/logout', 'User@logout');

Route::get('/master/kategori_layanan', 'User@kategori_layanan');
Route::get('/master/data_pekerja', 'User@data_pekerja');*/

///Auth::routes();

/*Route::get('/', function () {
    return view('/layouts/login');
});*/

//Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/master/kategori_layanan', function () {
    return view('/layouts/master/kategori_layanan');
});
Route::get('/master/data_pekerja', function () {
    return view('/layouts/master/data_pekerja');
});*/
/*Route::get('/master/mitra_kerja', function () {
    return view('/layouts/master/mitra_kerja');
});
Route::get('/tables/simple', function () {
    return view('/layouts/pages/tables/simple');
});
Route::get('/tables/data', function () {
    return view('/layouts/pages/tables/data');
});*/

Route::get('test',function(){
    return phpinfo();
});
