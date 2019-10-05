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
require('admin.php');

Route::view('/', 'site.pages.homepage');

Auth::routes();

Route::group(['namespace' => 'Site'], function () {
    Route::get('/category/{slug}','CategoryController@show')->name('category.show');
    Route::get('/product/{slug}','ProductController@show')->name('product.show');
});
