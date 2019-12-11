<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('TArea/list_area','TArea@list_area');
Route::post('TSubArea/list_sub_area','TSubArea@list_sub_area');
Route::post('TUnsDetail/list','TUnsDetail@list');
Route::post('TUnsafe/list','TUnsafe@list');
Route::post('PekaCostCenter/list','PekaCostCenter@list');

Route::post('PekaEmployee/list','PekaEmployee@list');
Route::post('PekaEmployee/get','PekaEmployee@get');
Route::post('PekaEmployee/connect_ldap','PekaEmployee@connect_ldap');

Route::post('TObservasi/list','TObservasi@list');
Route::post('TObservasi/get','TObservasi@get');
Route::post('TObservasi/delete','TObservasi@delete');
Route::post('TObservasi/insert','TObservasi@insert');
Route::post('TObservasi/update','TObservasi@updateapi');
Route::get('/TObservasi/download/{file}','TObservasi@downloadFile');

Route::post('TObsKlas/list','TObsKlas@list');
Route::post('TObsKlas/get','TObsKlas@get');
Route::post('TObsKlas/delete','TObsKlas@delete');
Route::post('TObsKlas/insert','TObsKlas@insert');
Route::post('TObsKlas/update','TObsKlas@updateapi');
