<?php

use Illuminate\Support\Facades\Route;

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

 //Route::get('/', function () {
//    return view('welcome');
//   return view('top');
//});
Route::get('/basket', 'App\Http\Controllers\BuyController@basket');
Route::get('/choice', 'App\Http\Controllers\BuyController@choice');
Route::get('/buy', 'App\Http\Controllers\BuyController@index');
Route::get('/login', 'App\Http\Controllers\UserController@index');