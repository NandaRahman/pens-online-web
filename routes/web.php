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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/login', 'LoginController@index')->name('login');
Route::get('/reminder', 'ReminderController@index')->name('reminder');
Route::get('/reminder/add', 'ReminderController@add')->name('reminder:add');

Route::post('/login', 'LoginController@login')->name('login:get');
Route::post('/reminder/get', 'ReminderController@get')->name('reminder:get');
Route::get('/reminder/delete/{nomor}', 'ReminderController@delete')->name('reminder:delete');
Route::post('/reminder/create', 'ReminderController@create')->name('reminder:create');
Route::post('/logout', 'LoginController@signout')->name('logout');



