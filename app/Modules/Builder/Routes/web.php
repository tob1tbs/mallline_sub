<?php

// GENERAL ROUTES
Route::group(['middleware' => [], 'prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['prefix' => 'builder', 'middleware' => []], function () {
        Route::get('/', 'BuilderController@actionBuilderIndex')->name('actionBuilderIndex');
    });
});

// AJAX ROUTES
Route::group(['prefix' => 'builder/ajax', 'middleware' => []], function () {
    Route::get('/check', 'BuilderAjaxController@ajaxCheckSubdomain')->name('ajaxCheckSubdomain');
    Route::post('/submit', 'BuilderAjaxController@ajaxBuilderSubmit')->name('ajaxBuilderSubmit');
});