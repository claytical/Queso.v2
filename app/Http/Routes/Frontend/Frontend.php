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
//		Route::get('/', 'DashboardController@welcome')->name('frontend.welcome');
        Route::get('/dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
    });
});