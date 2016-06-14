<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('login', 'TokenController@login');
Route::post('register', 'TokenController@register');

Route::post('question/answer', 'QuestionController@answerIt');
Route::resource('question', 'QuestionController', ['only' => ['index', 'store', 'show']]);

Route::post('radius', 'GeoController@inRadius');