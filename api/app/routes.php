<?php

/*
|--------------------------------------------------------------------------
| Know My Story API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('/init', 'InitController@init');
Route::group(array('prefix' => '', 'before' => 'tokenMatch'), function() {
    Route::resource('topics', 'TopicsController');
    Route::post('topiclist', 'TopicsController@topicList');//Return topic list
    Route::post('countrylist', 'CountriesController@countryList');//Return country list
    Route::post('languagelist', 'LangController@languageList');//Return country list
    
    Route::resource('videos', 'VideosController');
    Route::post('tutorialvideo', 'VideosController@tutorialVideo'); //Return tutorial video url 
    Route::post('selfievideos', 'VideosController@selfieVideos');//Return all selfie videos of user
    Route::post('unpublishedselfievideos', 'VideosController@unpublishedSelfieVideos');//Return all unpublished and unviewed selfie videos of user
    Route::post('videos', 'VideosController@videos'); //Return list of videos based on search keyword/selected channel/topic/featured videos
    Route::post('addselfievideo', 'VideosController@addSelfieVideo');//Add selfie video to backend
    Route::post('updateselfievideo', 'VideosController@updateSelfieVideo');//Update selfie video
    Route::post('updateselfieviewstatus', 'VideosController@updateSelfieViewStatus');//Update view status of selfie video
    Route::post('allvideos', 'VideosController@allVideos'); //Return list of channel videos
    
    Route::post('adduser', 'UsersController@store');//Create user or allow the user to login
    Route::post('updateuser', 'UsersController@updateUser'); //Update user profile
    Route::post('viewuser', 'UsersController@viewUser');

    Route::resource('tags', 'TagsController');
    Route::post('addtag', 'TagsController@store');//Add new tag
    Route::post('suggesttags', 'TagsController@suggestTags');//Suggest tags

    Route::post('biblebooks', 'BibleController@getBibleBooks');//Returns list of books in bible
    Route::post('offlineverses', 'BibleController@getOfflineVerses');//Returns book verses (offline)
    Route::post('bibleverses', 'BibleController@getBibleVerses');//Returns bible verses

    
});
