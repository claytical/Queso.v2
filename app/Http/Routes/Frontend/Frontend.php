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
        Route::get('quest/{quest_id}/attempt/submission', 'QuestController@attempt_submission')->name('submission.attempt'); //done
        Route::get('quest/{quest_id}/attempt/submission', 'QuestController@attempt_submission')->name('submission.attempt'); //done
        Route::get('quest/{quest_id}/attempt/link', 'QuestController@attempt_link')->name('link.attempt');
        Route::get('quest/{quest_id}/watch', 'QuestController@watch_video')->name('quest.watch');
        Route::get('quest/redeem', 'QuestController@redeem')->name('quest.redeem');
        Route::post('quest/redeem', 'QuestController@redeemed')->name('quest.redeemed');
        Route::post('quest/submit', 'QuestController@submit')->name('quest.submitted'); 
        Route::post('quest/revise', 'QuestController@revise')->name('quest.revised'); 
        Route::post('quest/watched', 'QuestController@watched')->name('quest.watched'); 

        Route::get('quest/{quest_id}/revise/submission', 'QuestController@revise_submission')->name('revise.submission'); //done

        Route::get('quests/history', 'QuestController@history')->name('quests.history');
        
        Route::get('quest/{quest_id}/feedback', 'QuestController@view_feedback')->name('quest.feedback');
        Route::get('review/{submission_id}', 'QuestController@give_feedback')->name('quest.review');
        Route::post('quest/feedback', 'QuestController@submit_feedback')->name('feedback.submitted');
        Route::get('feedback', 'QuestController@feedback_overview')->name('feedback.overview');

        Route::get('resource/{resource_id}', 'ResourceController@by_id')->name('resource.view');
        Route::get('resource/category/{category_id}', 'ResourceController@by_category')->name('resource.category');


        Route::get('grade/submissions', 'GradeController@submission_list')->name('grade.submissions');
        Route::get('grade/submission/{submission_id}', 'GradeController@submission')->name('grade.submission');
        Route::get('grade/link/{link_id}', 'GradeController@link')->name('grade.link');
        Route::get('grade/activity/{quest_id}', 'GradeController@activity')->name('grade.activity');
        Route::get('grade/inclass', 'GradeController@inclass')->name('grade.inclass');
        Route::post('grade/confirm', 'GradeController@confirm')->name('grade.confirm');
        Route::post('grade/confirm/activity', 'GradeController@group_confirm')->name('grade.group.confirm');

        Route::get('manage/quests', 'QuestController@manage')->name('quests.manage');
        Route::get('manage/quest/create', 'QuestController@create')->name('quests.create');

// FILE HANDLING

        Route::post('dropzone/uploadFiles', 'DropzoneController@uploadFiles')->name('dropzone.upload');
    });
});