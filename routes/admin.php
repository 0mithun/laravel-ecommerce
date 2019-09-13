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

    Route::post('/attributes/get-values','AttributeValueController@getValues');

    Route::post('/attributes/add-values','AttributeValueController@addValues');
    Route::post('/attributes/update-values','AttributeValueController@updateValues');
    Route::post('/attributes/delete-values','AttributeValueController@deleteValues');
});
