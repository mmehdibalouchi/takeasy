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
// Route::group(['prefix'=>'api'], function() {

// /privatequestions/{id}/answers/{id}

// /questions/{id}
// /questions/{id}/answers/{id}
// /questions/{id}/comments/{id}
// /questions/{id}/answers/{id}/comments/{id}

// /answers/{id}

	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');
	Route::resource('tags', 'TagsController');
	Route::resource('questions', 'QuestionsController');
	Route::resource('question.comments', 'CommentsController');
	Route::resource('answer.comments', 'CommentsController');
	Route::resource('question.likes', 'LikesController');
	Route::resource('answer.likes', 'LikesController');
	Route::resource('question.answers', 'AnswersController');
	Route::resource('pquestion.answers', 'AnswersController');
	Route::resource('pquestions', 'PrivateQuestionsController');
	Route::resource('user.questions', 'QuestionUserController');
	Route::resource('user', 'UserController');
	Route::controller('profile', 'ProfileController');

	Route::controllers(['/' => 'Auth\AuthController','password' => 'Auth\PasswordController',]);
// });

