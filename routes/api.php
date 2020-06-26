<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::apiResource('/products', 'ProductController')->only(['index', 'show']);
Route::get('/products/length', 'ProductController@length');

Route::apiResource('/news', 'NewsController')->only(['index', 'show']);

Route::get('/basket', 'BasketController@store');
Route::post('/checkout', 'OrderController@store');

Route::get('/brands', 'BrandController@index');
Route::get('/brands/{id}', 'BrandController@show');
Route::get('/brands/{id}/products', 'BrandController@products');

Route::post('/contact', 'ContactController@mail');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users/{id}', 'UserController@show');
    Route::patch('users/{id}', 'UserController@update');
    Route::get('users/{id}/orders', 'UserController@showOrders');
    Route::patch('products/{product}/units/add', 'ProductController@updateUnits');
    Route::patch('orders/{order}/deliver', 'OrderController@deliverOrder');
    Route::resource('/orders', 'OrderController');
    Route::get('/logout', 'UserController@logout');

    Route::group(['middleware' => 'admin'], function () {
        Route::apiResource('/brands', 'BrandController')->except(['index', 'show', 'update']);
        Route::apiResource('/users', 'UserController')->except(['show', 'showOrders']);
        Route::apiResource('/products', 'ProductController')->except(['index', 'show', 'update']);
        Route::apiResource('/news', 'NewsController')->except(['index', 'show', 'update']);

        Route::post('/brands/{id}', 'BrandController@update');
        Route::post('/products/{id}', 'ProductController@update');
        Route::post('/news/{id}', 'NewsController@update');

        Route::post('/images', 'ImageController@store');
        Route::post('/images/{id}', 'ImageController@update');
        Route::delete('/images/{id}', 'ImageController@destroy');
    });
});
