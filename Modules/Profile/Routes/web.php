<?php

Route::group(['prefix' => 'account/profile','namespace' => 'Web', 'middleware' => ['auth']], function () {

    Route::get('/', 'ProfileController@index');
    Route::get('/verification', 'ProfileController@verification');
    //Route::post('/', 'ProfileController@store')->name('profile.store');
});
