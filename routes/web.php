<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('', 'PagesController@welcome')->name('home');
Route::get('view', 'PagesController@viewStudents')->name('view');
Route::post('export', 'ExportController@export')->name('export');
Route::get('export-course', 'ExportController@exportCourse')->name('exportCourse');
