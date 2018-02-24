<?php

Route::group(['prefix' => 'jobs', 'middleware' => 'auth:api'], function(){
    Route::post('new', 'JobsController@saveJob');
    Route::get('auth/active', 'JobsController@getAuthUserActiveJobs');
});