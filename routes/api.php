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
Route::get('/products', 'ProductController@searchProduct');
Route::post('/contact', 'ContactController@index');
Route::group(['prefix' => 'auth','namespace'=>'Auth'], function () {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::get('me', 'MeController');
    Route::get('adminNews', 'AdminNewsController@index');
    Route::get('adminProducts', 'AdminProductsController@index');

    Route::post('createBrand', 'AdminBrandController@store');
    Route::post('createNews', 'AdminNewsController@store');
    Route::post('createSneakers', 'AdminProductsController@store');

    Route::get('displayBrand/{id}', 'AdminBrandController@show');
    Route::get('displayNew/{id}', 'AdminNewsController@show');
    Route::get('displayProduct/{id}', 'AdminProductsController@show');

    Route::delete('deleteNews/{id}', 'AdminNewsController@destroy');
    Route::delete('deleteBrand/{id}', 'AdminBrandController@destroy');
    Route::delete('deleteSneaker/{id}', 'AdminProductsController@destroy');
    Route::delete('deleteSecondaryPicture/{id}', 'AdminImage@destroy');

    Route::post('updateNew/{id}', 'AdminNewsController@update');
    Route::post('updateBrand/{id}', 'AdminBrandController@update');
    Route::post('updateProduct/{id}', 'AdminProductsController@update');
});
Route::get('/news/{id}', 'NewsController@show');
Route::get('/brands/{id}', 'BrandController@showOne');
Route::get('/brands/{id}/products', 'BrandController@show');
Route::get('/product/{id}', 'ProductController@show');
