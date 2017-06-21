<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//创建调查问卷页面ajax调用的url
Route::middleware('auth:api')->post('/question/create_question', 'Questionnaire\QuestionController@createQuestion');
Route::middleware('auth:api')->post('/question/update_question', 'Questionnaire\QuestionController@updateQuestion');
Route::middleware('auth:api')->post('/question/delete_question', 'Questionnaire\QuestionController@deleteQuestion');
Route::middleware('auth:api')->post('/choice/create_choice', 'Questionnaire\QuestionController@createChoice');
Route::middleware('auth:api')->post('/choice/update_choice', 'Questionnaire\QuestionController@updateChoice');
Route::middleware('auth:api')->post('/choice/delete_choice', 'Questionnaire\QuestionController@deleteChoice');

