<?php

Route::group(['prefix'=>'account'], function(){
    Route::any('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});
