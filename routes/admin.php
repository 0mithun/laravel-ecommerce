<?php

use Symfony\Component\HttpFoundation\Request;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {



    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login.post');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');
    });

    Route::get('/settings', 'SettingController@index')->name('admin.settings');
    Route::post('/settings', 'SettingController@update')->name('admin.settings.update');




    // Route::group(['prefix' => 'categories'], function () {
    //     Route::get('/', 'CategoryController@index')->name('admin.categories.index');
    //     Route::get('/create', 'CategoryController@create')->name('admin.categories.create');
    //     Route::post('/store', 'CategoryController@store')->name('admin.categories.store');
    //     Route::get('/{id}/edit', 'CategoryController@index')->name('admin.categories.edit');
    //     Route::post('/update', 'CategoryController@index')->name('admin.categories.update');
    //     Route::get('/{id}/delete', 'CategoryController@index')->name('admin.categories.delete');
    // });
    Route::name('admin.')->group(function () {
        Route::resource('categories', 'CategoryController')->except('show','destroy');
        Route::get('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

    });

    Route::name('admin.')->group(function(){
        Route::resource('attributes', 'AttributeController')->except(['show','destroy']);
        Route::get('/attributes/{attribute}','AttributeController@destroy')->name('attributes.destroy');
    });

    Route::name('admin.')->group(function(){
        Route::resource('brands', 'BrandController')->except(['show','destroy']);
        Route::get('/brands/{id}/delete','BrandController@destroy')->name('brands.destroy');
    });

    Route::name('admin.')->group(function(){
        Route::resource('products', 'ProductController')->except(['show','destroy']);
    });

    Route::post('/images/upload','ProductImageController@upload')->name('admin.products.images.upload');
    Route::get('/images/{id}/delete','ProductImageController@delete')->name('admin.products.images.delete');

    Route::post('/attributes/get-values','AttributeValueController@getValues');

    Route::post('/attributes/add-values','AttributeValueController@addValues');
    Route::post('/attributes/update-values','AttributeValueController@updateValues');
    Route::post('/attributes/delete-values','AttributeValueController@deleteValues');



    //Load attributes on the page load
    Route::get('products/attributes/load','ProductAttributeController@loadAttributes');

    //Load product attributes on the page load
    Route::post('products/attributes','ProductAttributeController@productAttributes');

    //Load option values for a attribute
    Route::post('products/attributes/values','ProductAttributeController@loadValues');

    //Add product attribute to the current product
    Route::post('products/attributes/add','ProductAttributeController@addAttribute');

    //Delete product attribute from the current product
    Route::post('products/attributes/delete','ProductAttributeController@deleteAttribute');


});
