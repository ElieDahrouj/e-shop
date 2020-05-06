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
Route::get('/', 'NewsController@home');
Route::get('/news', 'NewsController@index');
Route::get('/catalogue', 'ProductController@index');
Route::group(['prefix' => 'auth','namespace'=>'Auth'], function () {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::get('me', 'MeController');
});
Route::get('/{id}/new', 'NewsController@show');
Route::get('/{id}/brand', 'BrandController@show');
Route::get('/{id}/product', 'ProductController@show');