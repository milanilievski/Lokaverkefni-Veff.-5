<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function() {
	return view('home');
});

Route::get('/threads', 'ThreadsController@index');
Route::get('/threads/create', 'ThreadsController@create')->middleware('auth');
Route::get('/threads/{thread}', 'ThreadsController@show');
Route::post('/threads', 'ThreadsController@store')->middleware('auth');
Route::get('/threads/{thread}/edit', 'ThreadsController@edit')->middleware('auth');
Route::patch('/threads/{thread}', 'ThreadsController@update')->middleware('auth');
Route::delete('/threads/{thread}', 'ThreadsController@destroy')->middleware('auth');

Route::post('/threads/{thread}/comment', 'ThreadsController@store')->middleware('auth');

Route::get('/threads/user/{user}', 'ThreadsController@index');