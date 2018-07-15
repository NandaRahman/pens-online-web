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


Route::prefix('mobile')->group(function() {
    Route::post('/login', 'Api\LoginController@index');
    Route::post('/reminder', 'Api\ReminderController@index');
    Route::post('/phone:edit', 'Api\ProfilController@editNoTelp');
    Route::post('/pengumuman', 'Api\DataController@pengumuman');
});

Route::prefix('mahasiswa')->group(function(){
    Route::post('/absen','Api\AbsensiController@mahasiswa');
    Route::post('/profil','Api\ProfilController@mahasiswa');
    Route::post('/jadwal','Api\JadwalController@mahasiswa');
});

Route::prefix('pegawai')->group(function(){
    Route::post('/absen','Api\AbsensiController@pegawai');
    Route::post('/profil','Api\ProfilController@pegawai');
});

