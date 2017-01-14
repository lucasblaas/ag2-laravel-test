<?php
Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::resource('company','CompanyController');

Route::resource('group','GroupController');

Route::resource('user','UserController');
