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

//API V1
/* 
* Auth
*/
Route::post('login', 'App\Http\Controllers\API\V1\Globals\UserController@login');
Route::post('register', 'App\Http\Controllers\API\V1\Globals\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){

    /**
     * User
     */
	Route::get('detail', 'App\Http\Controllers\API\V1\Globals\UserController@detail');
	Route::get('logout', 'App\Http\Controllers\API\V1\Globals\UserController@logout');

    /**
     * gambar dan soal
     */
	Route::get('train', 'App\Http\Controllers\API\V1\Projects\GambarController@trainHuruf');
    Route::get('trainAngka', 'App\Http\Controllers\API\V1\Projects\GambarController@trainAngka');
	Route::get('soalAngka/{id}', 'App\Http\Controllers\API\V1\Projects\GambarController@getSoalAngka');
	Route::get('soalHuruf/{id}', 'App\Http\Controllers\API\V1\Projects\GambarController@getSoalHuruf');
	Route::post('predict', 'App\Http\Controllers\API\V1\Projects\GambarController@predict');
    Route::post('predictaksara', 'App\Http\Controllers\API\V1\Projects\GambarController@predictaksara');
    Route::get('randHuruf/{id}', 'App\Http\Controllers\API\V1\Projects\GambarController@getRandHuruf');
    Route::get('randAngka/{id}', 'App\Http\Controllers\API\V1\Projects\GambarController@getRandAngka');
    Route::post('predictangka', 'App\Http\Controllers\API\V1\Projects\GambarController@predictangka');
    Route::post('scoreHuruf', 'App\Http\Controllers\API\V1\Projects\GambarController@scoreHuruf');
    Route::get('scoreHurufUser', 'App\Http\Controllers\API\V1\Projects\GambarController@scoreHurufUser');
    Route::get('scoreAngkaUser', 'App\Http\Controllers\API\V1\Projects\GambarController@scoreAngkaUser');

    // Score tertinggi huruf dan angka
    Route::get('scoreTHuruf', 'App\Http\Controllers\API\V1\Projects\GambarController@scoreTHuruf');
    Route::get('scoreTAngka', 'App\Http\Controllers\API\V1\Projects\GambarController@scoreTAngka');
});
