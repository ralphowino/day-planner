<?php

Route::auth();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('tasks', 'TasksController');
});
