<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisAktaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\BadanUsahaController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\AktaBaruController;
use App\Http\Controllers\AktaKeluarController;
use App\Http\Controllers\BerkasAktaController;
use App\Http\Controllers\UserController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/', '/home');
Route::group(['middleware' => 'auth'], function(){
    Route::resource('badan_usaha', BadanUsahaController::class)->parameters(['badan_usaha' => 'id']);
    Route::resource('jenis_akta', JenisAktaController::class)->parameters(['jenis_akta' => 'id']);
    Route::resource('jabatan', JabatanController::class)->parameters(['jabatan' => 'id']);
    Route::resource('persyaratan', PersyaratanController::class)->parameters(['persyaratan' => 'id']);
    Route::resource('akta_baru', AktaBaruController::class)->parameters(['akta_baru' => 'id']);
    Route::resource('akta_keluar', AktaKeluarController::class)->parameters(['akta_keluar' => 'id']);
    Route::resource('berkas_akta', BerkasAktaController::class)->parameters(['berkas_akta' => 'id']);
    Route::resource('user', UserController::class)->parameters(['user' => 'id']);
    Route::post('/akta_baru/penghadap', [AktaBaruController::class, 'storePenghadap'])->name('akta_baru.storePenghadap');
    Route::get('/get-jenis-akta', [AktaBaruController::class, 'getJenisAkta'])->name('akta_baru.getJenisAkta');


});

Auth::routes();

