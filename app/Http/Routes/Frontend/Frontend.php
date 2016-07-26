<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
		Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');    
        Route::get('quests/available', 'QuestController@available')->name('quests.available');
        Route::get('quest/{quest_id}/attempt/submission', 'QuestController@attempt_submission')->name('submission.attempt');
        Route::get('quest/{quest_id}/attempt/link', 'QuestController@attempt_link')->name('link.attempt');
        Route::post('quest/submit', 'QuestController@submit')->name('quest.submitted');
        Route::get('quest/{quest_id}/revise/submission', 'QuestController@revise_submission')->name('revise.submission');

        Route::get('quests/completed', 'QuestController@completed')->name('quests.completed');
        
        Route::get('quest/{quest_id}/feedback', 'QuestController@view_feedback')->name('quest.feedback');
        Route::get('review/{submission_id}', 'QuestController@give_feedback')->name('quest.review');
        Route::post('quest/feedback', 'QuestController@submit_feedback')->name('feedback.submitted');
        Route::get('feedback', 'QuestController@feedback_overview')->name('feedback.overview');

    });
});