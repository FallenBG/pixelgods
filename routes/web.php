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

Route::get('/stories', 'StoryController@index');
Route::get('/story/create', 'StoryController@create');
Route::get('/story/{story}', 'StoryController@show');
Route::get('/story/{story}/edit', 'StoryController@edit');
Route::post('/story/{story}/updateFinishPublish', 'StoryController@updateFinishPublish');
Route::post('/story/{story}/update', 'StoryController@update');
Route::patch('/story/{story}/updateNote', 'StoryController@updateNote');


Route::get('/story/{story}/chat', 'ChatController@show');
Route::post('/story/{story}/chat', 'ChatController@update');






Route::get('/apiOwnProjects', 'StoryController@apiOwnProjects');
Route::get('/apiJoinedStories', 'StoryController@apiJoinedStories')->name('apiJoinedStories'); // what name does?
