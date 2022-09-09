<?php

// GENERAL ROUTES
Route::group(['prefix' => 'vendors', 'middleware' => []], function () {
    Route::get('/guide', 'VendorsController@actionVendorsGuide')->name('actionVendorsGuide');
    Route::get('/', 'VendorsController@actionVendorsIndex')->name('actionVendorsIndex');
});

// AJAX ROUTES
Route::group(['prefix' => 'vendors/ajax', 'middleware' => []], function () {
    
});