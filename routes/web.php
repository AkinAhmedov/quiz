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


Route::get('/',  'HomeGetController@get_index');
Route::get('/home', 'HomeGetController@get_index');
Route::get('/add', 'HomeGetController@get_add');
Route::get('/add/{id}', 'HomeGetController@get_update');


Route::post('/', 'HomePostController@post_action');
Route::post('/home', 'HomePostController@post_action');
Route::post('/add', 'HomePostController@post_add');
Route::post('/add/{id}', 'HomePostController@post_update');


Auth::routes();

