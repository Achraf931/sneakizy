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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');

Route::apiResource('/news', 'NewsController')->only(['index', 'show']);

Route::get('/basket', 'BasketController@store');

Route::get('/brands', 'BrandController@index');
Route::get('/brands/{id}', 'BrandController@show');
Route::get('/brands/{id}/products', 'BrandController@products');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show');
    Route::patch('users/{user}', 'UserController@update');
    Route::get('users/{user}/orders', 'UserController@showOrders');
    Route::patch('products/{product}/units/add', 'ProductController@updateUnits');
    Route::patch('orders/{order}/deliver', 'OrderController@deliverOrder');
    Route::resource('/orders', 'OrderController');

    Route::group(['middleware' => 'admin'], function () {
        Route::apiResource('/products', 'ProductController')->except(['index', 'show']);
    });
});
