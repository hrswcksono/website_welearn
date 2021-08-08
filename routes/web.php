<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\GambarController;

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

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [LandingController::class,'index']);
Auth::routes();

Route::get('/home', [HomeController::class,'show']);
Auth::routes();

Route::get('/user', [UserController::class,'showUser']);
Auth::routes();

Route::get('/view_user/{id}', [UserController::class,'viewUser']);
Auth::routes();

// Route::post('/hapus_user','UserController@delete');
Route::post('/hapus_user',[UserController::class,'delete']);
Auth::routes();

Route::get('/dashboard', [DashboardController::class,'showDashboard']);
Auth::routes();

Route::get('/soal_huruf', [SoalController::class,'showSoalHuruf']);
Auth::routes();

// Route::get('/add_soal_huruf', [SoalController::class,'addSoalHuruf']);
// Auth::routes();

Route::post('/storeSoalHuruf', [SoalController::class,'storeSoalHuruf']);
Auth::routes();

Route::get('/soal_huruf/edit/{id}', [SoalController::class,'editSoalHuruf']);
Auth::routes();

Route::post('/soal_huruf/edit', [SoalController::class,'postSoalHuruf']);
Auth::routes();

Route::get('/view_soalhuruf/{id}', [SoalController::class,'viewSoalHuruf']);
Auth::routes();

Route::post('/hapus_soalhuruf',[SoalController::class,'deleteSoalHuruf']);
Auth::routes();

Route::get('/soal_angka', [SoalController::class,'showSoalAngka']);
Auth::routes();

Route::post('/storeSoalAngka', [SoalController::class,'storeSoalAngka']);
Auth::routes();

Route::get('/view_soalangka/{id}', [SoalController::class,'viewSoalAngka']);
Auth::routes();

Route::get('/soal_angka/edit/{id}', [SoalController::class,'editSoalAngka']);
Auth::routes();

Route::post('/soal_angka/edit', [SoalController::class,'postSoalAngka']);
Auth::routes();

Route::post('/hapus_soalangka',[SoalController::class,'deleteSoalAngka']);
Auth::routes();

// Score
Route::get('/score_huruf', [ScoreController::class,'showScoreHuruf']);
Auth::routes();

Route::get('/score_angka', [ScoreController::class,'showScoreAngka']);
Auth::routes();

// konversi gambar
Route::get('/konversi_gambar', [GambarController::class,'viewGambar']);
Auth::routes();

Route::post('/konversi_gambar/upload', [GambarController::class,'uploadGambar'])->name('upload_gambar');
Auth::routes();


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', 'HomeController@show')->middleware('auth');

