<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@splash')->name('frontend.splash');

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('/dashboard', 'DashboardController@index')->name('frontend.user.index');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
    });
});