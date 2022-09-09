<?php

// GENERAL ROUTES
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['middleware' => []], function () {
        Route::get('/sign-up', 'UsersController@actionUsersSignUp')->name('actionUsersSignUp');
        Route::get('/sign-in', 'UsersController@actionUsersSignIn')->name('actionUsersSignIn');
        Route::get('/restore', 'UsersController@actionUsersRestore')->name('actionUsersRestore');
        Route::get('/logout', 'UsersController@actionUsersLogout')->name('actionUsersLogout');
        Route::get('/facebook', 'UsersController@actionFacebookRedirect')->name('actionFacebookRedirect');
        Route::get('/facebook/callback', 'UsersController@actionFacebookCallback')->name('actionFacebookCallback');
        Route::get('/google', 'UsersController@actionGoogleRedirect')->name('actionGoogleRedirect');
        Route::get('/google/callback', 'UsersController@actionGoogleCallback')->name('actionGoogleCallback');
    });
    Route::group(['prefix' => 'user', 'middleware' => []], function () {
        Route::get('/', 'UsersController@actionUsersIndex')->name('actionUsersIndex');
    });
});

// AJAX ROUTES
Route::group(['prefix' => 'user/ajax', 'middleware' => []], function () {
    Route::post('/sign-in', 'UsersAjaxController@ajaxUserSignIn')->name('ajaxUserSignIn');
    Route::post('/sign-up', 'UsersAjaxController@ajaxUserSignUp')->name('ajaxUserSignUp');
    Route::post('/restore', 'UsersAjaxController@ajaxUserRestore')->name('ajaxUserRestore');
    Route::post('/restore/submit', 'UsersAjaxController@ajaxUserRestoreSubmit')->name('ajaxUserRestoreSubmit');
    Route::post('/update', 'UsersAjaxController@ajaxUserUpdate')->name('ajaxUserUpdate');
    Route::post('/updatePassword', 'UsersAjaxController@ajaxUserUpdatePassword')->name('ajaxUserUpdatePassword');
});