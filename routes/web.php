<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/faq', 'HomeController@faq');


Route::get('/writers', 'UserController@index');
Route::get('/writer/{profile}', 'UserController@show');
Route::get('/writer/{profile}/edit', 'UserController@edit');

Route::get('/stories', 'StoryController@index');
Route::get('/stories/search', 'StoryController@search');
Route::get('/story/create', 'StoryController@create');
Route::post('/story/create', 'StoryController@store');
Route::get('/story/{story}', 'StoryController@show');
Route::get('/story/{story}/edit', 'StoryController@edit');
Route::get('/story/{story}/join', 'StoryController@join');
Route::get('/story/{story}/leave', 'StoryController@leave');
Route::patch('/story/{story}/updateFinishPublish', 'StoryController@updateFinishPublish');
Route::post('/story/{story}/update', 'StoryController@update');
Route::patch('/story/{story}/updateNote', 'StoryController@updateNote');
Route::post('/story/{story}/delete', 'StoryController@delete');


Route::get('/story/{story}/chat', 'ChatController@show');
Route::post('/story/{story}/chat', 'ChatController@update');




Route::get('/story/{story}/entry', 'StoriesEntriesController@show');
Route::post('/story/{story}/entry', 'StoriesEntriesController@update');






Route::get('/apiOwnProjects', 'StoryController@apiOwnProjects');
Route::get('/apiJoinedStories', 'StoryController@apiJoinedStories')->name('apiJoinedStories'); // what name does?
