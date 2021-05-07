<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('login', function(){
	return view('ccvtpassport.login');
});
Route::get('register', function(){
	return view('ccvtpassport.register');
});

Route::post('login', 'API\CCVTController@login')->name('loginuser');

Route::post('register', 'API\CCVTController@register')->name('registeruser');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('detailsofregisteredperson', 'API\CCVTController@details');
});
