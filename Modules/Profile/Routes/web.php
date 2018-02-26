<?php

Route::group(['prefix' => 'account/profile','namespace' => 'Web', 'middleware' => ['auth']], function () {

    Route::get('/', 'ProfileController@index');
    Route::post('/', 'ProfileController@store')->name('profile.store');
});
