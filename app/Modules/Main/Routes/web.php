<?php

// GENERAL ROUTES
Route::group(['middleware' => [], 'prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', 'MainController@actionMainIndex')->name('actionMainIndex');
    Route::get('/checkout', 'MainController@actionMainCheckout')->name('actionMainCheckout');
    Route::get('/cart', 'MainController@actionMainCart')->name('actionMainCart');
    Route::get('/about-us', 'MainController@actionMainAboutUs')->name('actionMainAboutUs');
    Route::get('/contact', 'MainController@actionMainContact')->name('actionMainContact');
    Route::get('/wishlist', 'MainController@actionMainWishlist')->name('actionMainWishlist');
    Route::get('/how-to-buy', 'MainController@actionMainHowToBuy')->name('actionMainHowToBuy');
    Route::get('/privacy', 'MainController@actionMainPrivacy')->name('actionMainPrivacy');
    Route::get('/terms', 'MainController@actionMainTerms')->name('actionMainTerms');
    Route::get('/compare', 'MainController@actionMainCompare')->name('actionMainCompare');
});

// AJAX ROUTES
Route::group(['prefix' => 'main/ajax', 'middleware' => []], function () {
    // WISHLIST
    Route::post('/wishlist/add', 'MainAjaxController@ajaxMainWishlistAdd')->name('ajaxMainWishlistAdd');
    Route::post('/wishlist/remove', 'MainAjaxController@ajaxMainWishlistRemove')->name('ajaxMainWishlistRemove');
    Route::post('/wishlist/clear', 'MainAjaxController@ajaxMainWishlistClear')->name('ajaxMainWishlistClear');
    // CART
    Route::post('/cart/add', 'MainAjaxController@ajaxGeneralAddToCart')->name('ajaxGeneralAddToCart');
    Route::post('/cart/remove', 'MainAjaxController@ajaxGeneralRemoveFromCart')->name('ajaxGeneralRemoveFromCart');
    Route::post('/cart/quantity', 'MainAjaxController@ajaxGeneralQuantityCart')->name('ajaxGeneralQuantityCart');
    Route::post('/cart/clear', 'MainAjaxController@ajaxGeneralClearCart')->name('ajaxGeneralClearCart');
    // QUICK VIEW
    Route::get('/quick', 'MainAjaxController@ajaxGeneralProductQuickView')->name('ajaxGeneralProductQuickView');
    // COMPARE
    Route::post('/compare/add', 'MainAjaxController@ajaxGeneralProductCompare')->name('ajaxGeneralProductCompare');
    Route::post('/compare/remove', 'MainAjaxController@ajaxGeneralProductCompareRemove')->name('ajaxGeneralProductCompareRemove');
    // CONTACT
    Route::post('/contact', 'MainAjaxController@ajaxSendContact')->name('ajaxSendContact');
    // CHECKOUT SUBMIT
    Route::post('/checkout', 'MainAjaxController@ajaxCheckoutSubmit')->name('ajaxCheckoutSubmit');
    // SUBSCRIBE
    Route::post('/subscribe', 'MainAjaxController@ajaxSubscribe')->name('ajaxSubscribe');
});