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

Route::get('/', function () {
     return view('index');
//     return view('welcome');
  });
  
  Route::post('/decision', 'App\Http\Controllers\BuyController@decision');
  Route::post('/confirm', 'App\Http\Controllers\BuyController@confirm');
  Route::get('/basket', 'App\Http\Controllers\BuyController@basket');
  Route::post('/storebasket', 'App\Http\Controllers\BuyController@storebasket');
  Route::post('/getBaskets', 'App\Http\Controllers\BuyController@getBaskets');
  Route::post('/removeBasket', 'App\Http\Controllers\BuyController@removeBasket');
  Route::get('/address', 'App\Http\Controllers\BuyController@address');
  Route::get('/choice', 'App\Http\Controllers\BuyController@choice');
  Route::get('/buy', 'App\Http\Controllers\BuyController@index');
  Route::get('/contact', 'App\Http\Controllers\HomeController@contact');
  Route::post('/contact_confirm', 'App\Http\Controllers\HomeController@confirm');
  
  Route::post('/settle_recive', 'App\Http\Controllers\ReceiveController@settle_recive');
  
  Route::group(['middleware' => 'auth'], function () {
  Route::get('/mypage', 'App\Http\Controllers\MypageController@index');
  Route::post('/delete_account', 'App\Http\Controllers\MypageController@delete_account');
  });
  //  Route::match(['get', 'post'], '/login', 'App\Http\Controllers\UserController@login');
//  Route::get('/regist', 'App\Http\Controllers\UserController@regist');
//  Route::post('/registmail', 'App\Http\Controllers\UserController@registmail');

Route::get('/test', 'App\Http\Controllers\TestController@test');
  
  Route::get('/law', function () {
    return view('law');
  });
  
  
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
