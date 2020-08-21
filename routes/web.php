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

/*
Route::get('/about' , 'PageController@about');
Route::get('/services' , 'PageController@services'); 
*/
Route::get('/' , 'PageController@index');
Route::get('/youtube' , 'PostController@index');
Route::get('/search' , 'PostController@search');
Route::get('ajax', function(){return view('ajax');});
Route::get('/postajax','AjaxController@post');
Route::view('/javascript','javascript');