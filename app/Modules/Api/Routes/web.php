<?php

// GENERAL ROUTES
Route::group(['prefix' => 'apis', 'middleware' => []], function () {
    Route::get('/', 'ApiController@actionApiIndex')->name('actionApiIndex');
});

// AJAX ROUTES
Route::group(['prefix' => 'apis/ajax', 'middleware' => []], function () {
    
});