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

Route::post('login', 'TokenController@login');
Route::post('register', 'TokenController@register');

Route::post('question/answer', 'QuestionController@answerIt');
Route::post('question/radius', 'GeoController@inRadius');

Route::resource('question', 'QuestionController', ['only' => ['index', 'store', 'show']]);

Route::get('user/{id}', 'UsersController@show');
Route::get('user/{id}/friends', 'FriendsController@ofUser');
Route::post('user/friends', 'FriendsController@addFriendship');