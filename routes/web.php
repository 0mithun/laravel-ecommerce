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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('login', function(){
//     return 'login';
// })->name('login');



Route::group(['namespace'=>'Site'], function(){
    Route::get('/category/{slug}','CategoryController@show')->name('category.show');
    Route::get('/product/{slug}','ProductController@show')->name('product.show');

    Route::post('/product/add/cart','ProductController@addToCart')->name('product.add.cart');


    Route::get('/cart','CartController@getCart')->name('checkout.cart');
    Route::get('/cart/item/{id}/remove','CartController@removeItem')->name('checkout.cart.remove');
    Route::get('/cart/clear','CartController@clearCart')->name('checkout.cart.clear');
});