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
Route::get('/fiveNews', 'NewsController@home');
Route::get('/news', 'NewsController@index');
Route::get('/catalogue', 'ProductController@index');
Route::get('/brands', 'BrandController@index');
Route::group(['prefix' => 'auth','namespace'=>'Auth'], function () {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::get('me', 'MeController');
    Route::get('adminNews', 'AdminNewsController@index');
    Route::get('adminProducts', 'AdminProductsController@index');
});
Route::get('/products', 'ProductController@searchProduct');
Route::post('/contact', 'ContactController@index');
Route::get('/news/{id}', 'NewsController@show');
Route::get('/brand/{id}', 'BrandController@show');
Route::get('/{id}/product', 'ProductController@show');
