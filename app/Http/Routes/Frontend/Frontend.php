<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
// FILE HANDLING

Route::post('dropzone/uploadFiles', 'DropzoneController@uploadFiles')->name('dropzone.upload');
Route::get('dropzone/uploadFiles', 'DropzoneController@uploadFiles')->name('dropzone.upload');
Route::get('json', 'DropzoneController@getJSON')->name('dropzone.json');
Route::get('file/remove/{file_id}', 'DropzoneController@removeFile')->name('remove.file');


/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
		Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('choose', 'DashboardController@choose')->name('frontend.user.choose');
        Route::get('courses/public', 'CourseController@index')->name('frontend.courses');
        Route::get('courses', 'CourseController@my')->name('frontend.my.courses');
        Route::get('course/join', 'CourseController@register')->name('course.register');
        Route::post('course/join', 'CourseController@join')->name('course.join');
        Route::get('course/switch/{course_id}', 'CourseController@change')->name('course.change');
        Route::get('course/create', 'CourseController@create_form')->name('course.create');
        Route::post('course/create', 'CourseController@create')->name('course.created');
        Route::get('course/add/levels', 'CourseController@add_levels')->name('course.add.levels');
        Route::post('course/add/level', 'CourseController@add_level')->name('course.add.level');
        Route::post('course/remove/level', 'CourseController@remove_level')->name('course.remove.level');
        Route::get('course/add/skills', 'CourseController@add_skills')->name('course.add.skills');
        Route::post('course/add/skill', 'CourseController@add_skill')->name('course.add.skill');
        Route::post('course/remove/skill', 'CourseController@remove_skill')->name('course.remove.skill');
        Route::get('course/remove/skill/{id}', 'CourseController@remove_skill_ajax')->name('course.remove.skill.json');

        Route::post('manage/course/add/level', 'CourseController@add_level_m')->name('course.add.level.m');
        Route::post('manage/course/remove/level', 'CourseController@remove_level_m')->name('course.remove.level.m');
        Route::post('manage/course/edit/level', 'CourseController@edit_level')->name('course.edit.level');
        Route::post('manage/course/edit/team', 'CourseController@edit_team')->name('course.edit.team');
        Route::get('manage/course/team/{team_id}', 'CourseController@manage_team')->name('course.manage.team');
        Route::post('manage/course/team', 'CourseController@set_team')->name('course.set.team');
        Route::post('manage/course/add/skill', 'CourseController@add_skill_m')->name('course.add.skill.m');
        Route::post('manage/course/edit/skill', 'CourseController@edit_skill')->name('course.edit.skill');
        Route::post('manage/course/remove/skill', 'CourseController@remove_skill_m')->name('course.remove.skill.m');

        Route::post('manage/course/add/team', 'CourseController@add_team')->name('course.add.team');
        Route::post('manage/course/remove/team', 'CourseController@remove_team')->name('course.remove.team');
        
        Route::get('course/instructions', 'CourseController@instructions')->name('course.instructions');

        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');    
        Route::get('notification/dismiss/{id}', 'NoticeController@dismiss')->name('frontend.notification.dismiss');
        Route::get('notifications/dismiss', 'NoticeController@dismiss_all')->name('frontend.notification.dismiss.all');
        Route::get('quests/available', 'QuestController@available')->name('quests.available'); 
        Route::get('quest/{quest_id}/attempt/submission', 'QuestController@attempt_submission')->name('submission.attempt');
//        Route::get('quest/{quest_id}/attempt', 'QuestController@attempt_submission')->name('submission.attempt');
        Route::get('quest/{quest_id}/attempt/link', 'QuestController@attempt_link')->name('link.attempt');
        Route::get('quest/{quest_id}/watch', 'QuestController@watch_video')->name('quest.watch');
        Route::get('quest/redeem', 'QuestController@redeem')->name('quest.redeem');
        Route::post('quest/redeem', 'QuestController@redeemed')->name('quest.redeemed');
        Route::post('quest/submit', 'QuestController@submit')->name('quest.submitted'); 
        Route::post('quest/revise', 'QuestController@revise')->name('quest.revised'); 
        Route::post('quest/watched', 'GradeController@watched')->name('quest.watched'); 

        Route::get('quest/{quest_id}/revise', 'QuestController@revise_submission')->name('revise.submission');
        Route::get('quests/history', 'QuestController@history')->name('quests.history');
        
        Route::get('quest/{quest_id}/feedback/{user_id?}', 'QuestController@view_feedback')->name('quest.feedback');
        Route::get('feedback/like/{id}', 'FeedbackController@like')->name('feedback.like');
        Route::get('review/{quest_id}/{user_id}/{revision}', 'QuestController@give_feedback')->name('quest.review');
        Route::post('quest/feedback', 'QuestController@submit_feedback')->name('feedback.submitted');
        Route::get('feedback', 'QuestController@feedback_overview')->name('feedback.overview');

        Route::get('resource/{resource_id}', 'ResourceController@by_id')->name('resource.view');
        Route::get('resources/{resource_slug}', 'ResourceController@by_slug')->name('resource.slug.view');
        Route::get('resource/category/{category_id}', 'ResourceController@by_category')->name('resource.category');

        Route::get('announcements', 'AnnouncementController@index')->name('announcements');

        Route::get('grade/submissions', 'GradeController@submission_list')->name('grade.submissions');
        Route::get('grade/quest/{quest_id}/{submission_id}', 'GradeController@quest')->name('grade.quest');
//        Route::get('grade/submission/{submission_id}', 'GradeController@submission')->name('grade.submission');
//        Route::get('grade/link/{link_id}', 'GradeController@link')->name('grade.link');
        Route::get('grade/activity/{quest_id}', 'GradeController@activity')->name('grade.activity');
        Route::get('grade/inclass', 'GradeController@inclass')->name('grade.inclass');
        Route::post('grade/confirm', 'GradeController@confirm')->name('grade.confirm');
        Route::post('grade/confirm/activity', 'GradeController@group_confirm')->name('grade.group.confirm');

        Route::get('manage/quests/{course_id}', 'QuestController@manage')->name('quests.manage');
        Route::get('manage/quest/create/{course_id}', 'QuestController@choose')->name('quests.choose');
        Route::get('manage/quest/create/response/{course_id}', 'QuestController@create_response_form')->name('quests.create.response.form');
        Route::get('manage/quest/create/link/{course_id}', 'QuestController@create_link_form')->name('quests.create.link.form');
        Route::get('manage/quest/create/upload/{course_id}', 'QuestController@create_upload_form')->name('quests.create.upload.form');

        Route::get('manage/quest/create/submission/{course_id}', 'QuestController@create_submission_form')->name('quests.create.submission.form');
        Route::get('manage/quest/create/link/group/{course_id}', 'QuestController@create_group_link_form')->name('quests.create.group.link.form');
        Route::get('manage/quest/create/upload/group/{course_id}', 'QuestController@create_group_upload_form')->name('quests.create.group.upload.form');

        Route::get('manage/quest/create/video/{course_id}', 'QuestController@create_video_form')->name('quests.create.video.form');
        Route::get('manage/quest/create/activity/{course_id}', 'QuestController@create_activity_form')->name('quests.create.activity.form');


//        Route::get('manage/quest/create', 'QuestController@create_form')->name('quests.create.begin');
        Route::post('manage/quest/create', 'QuestController@create')->name('quests.create');
        Route::get('manage/quest/{quest_id}/delete', 'QuestController@delete')->name('quests.delete');
        Route::get('manage/quest/{quest_id}/show', 'QuestController@show')->name('quests.show');
        Route::get('manage/quest/{quest_id}/hide', 'QuestController@hide')->name('quests.hide');
        Route::get('manage/quest/{quest_id}/qrcodes', 'QuestController@qrcodes')->name('quests.qrcodes');
        Route::get('manage/quest/{quest_id}/qrcards', 'QuestController@qrcards')->name('quests.qrcards');
        Route::post('manage/quest/qrcodes', 'QuestController@generate_qrcodes')->name('quests.qrcodes.generate');
        
        Route::get('manage/quest/{quest_id}', 'QuestController@edit_form')->name('quests.edit');
        

        Route::post('manage/quest/update', 'QuestController@update')->name('quests.update');
        Route::get('manage/quest/{quest_id}/clone', 'QuestController@clone_form')->name('quests.clone.begin');
        Route::post('manage/quest/clone', 'QuestController@clone')->name('quest.clone');
        Route::get('manage/students', 'StudentController@index')->name('students.manage');
        Route::get('manage/student/{student_id}', 'StudentController@detail')->name('student.detail');
        Route::get('manage/student/{student_id}/leave', 'CourseController@leave')->name('course.leave');
        Route::get('manage/student/{student_id}/team/assign/{team_id}', 'StudentController@assign_team')->name('assign.team');
        Route::get('manage/student/{student_id}/team/remove', 'StudentController@remove_team')->name('remove.team');


        Route::get('manage/student/{student_id}/remove/quest/{quest_id}', 'QuestController@remove_student_attempt')->name('remove.student.quest');
        Route::get('manage/announcements/{course_id}', 'AnnouncementController@manage')->name('announcements.manage');
        Route::get('manage/announcement/create/{course_id}', 'AnnouncementController@create')->name('announcements.create');
        Route::get('manage/announcement/edit/{announcement_id}', 'AnnouncementController@details')->name('announcements.details');
        Route::get('manage/announcement/show/{announcement_id}', 'AnnouncementController@show')->name('announcements.show');
        Route::get('manage/announcement/hide/{announcement_id}', 'AnnouncementController@hide')->name('announcements.hide');

        Route::post('manage/announcements/create', 'AnnouncementController@save')->name('announcements.created'); 
        Route::post('manage/announcement/update', 'AnnouncementController@update')->name('announcement.update');
        Route::get('manage/announcement/delete/{announcement_id}', 'AnnouncementController@delete')->name('announcement.delete');

        Route::get('manage/resources/{course_id}', 'ResourceController@manage')->name('resources.manage');
        Route::get('manage/resources/create/{course_id}', 'ResourceController@choose')->name('resource.choose');
        Route::get('manage/resource/create/link/{course_id}', 'ResourceController@create_link')->name('resource.create.link');
        Route::get('manage/resource/create/content/{course_id}', 'ResourceController@create_content')->name('resource.create.content');

        Route::get('manage/resource/link/edit/{resource_id}', 'ResourceController@details_link')->name('resource.details.link');
        Route::get('manage/resource/content/edit/{resource_id}', 'ResourceController@details_content')->name('resource.details.content');

        Route::get('manage/resource/delete/{resource_id}', 'ResourceController@delete')->name('resource.delete');

        Route::post('manage/resources/create', 'ResourceController@save')->name('resources.created');
        Route::post('manage/resource/update', 'ResourceController@update')->name('resource.update');

        Route::get('manage/course', 'CourseController@manage')->name('course.manage');
        Route::post('manage/course/update', 'CourseController@update')->name('course.update');


    });
});