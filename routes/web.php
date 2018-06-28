<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/parse', 'ParserController@parse')->name('parse');
Route::get('app/{name}', 'HomeController@showFile')->name('show.file.by.name');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'collection',
    'as' => 'collection.',
], function () {

    Route::get('/', 'CollectionController@index')
        ->name('index');

    Route::get('create', 'CollectionController@create')
        ->name('create');

    Route::get('edit/{collection}', 'CollectionController@edit')
        ->name('edit');

    Route::put('update/{collection}', 'CollectionController@update')
        ->name('update');

    Route::post('store', 'CollectionController@store')
        ->name('store');

    Route::get('show/{collection}', 'CollectionController@show')
        ->name('show');

    Route::post('{collection}/add', 'CollectionController@add')
        ->name('add.file');

    Route::delete('{collection}/delete/{file}', 'CollectionController@deleteFileFromCollection')
        ->name('delete.file');

    Route::delete('delete/{collection}', 'CollectionController@delete')
        ->name('delete');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'file',
    'as' => 'file.',
], function () {

    Route::get('/', 'FileController@index')
        ->name('index');

    Route::get('create', 'FileController@create')
        ->name('create');

    Route::post('store', 'FileController@store')
        ->name('store');

    Route::get('show/{file}', 'FileController@show')
        ->name('show');

    Route::get('edit/{file}', 'FileController@edit')
        ->name('edit');

    Route::put('update/{file}', 'FileController@update')
        ->name('update');

    Route::delete('delete/{file}', 'FileController@delete')
        ->name('delete');
});