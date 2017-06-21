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
Route::middleware('api')->post('question/create_question', 'Questionnaire\QuestionController@createQuestion');
Route::middleware('api')->post('question/update_question', 'Questionnaire\QuestionController@updateQuestion');
Route::middleware('api')->post('question/delete_question', 'Questionnaire\QuestionController@deleteQuestion');
Route::middleware('api')->post('choice/configure_choice', 'Questionnaire\ChoiceController@configureChoice');
Route::middleware('api')->post('choice/create_choice', 'Questionnaire\ChoiceController@createChoice');
Route::middleware('api')->post('choice/update_choice', 'Questionnaire\ChoiceController@editChoice');
Route::middleware('api')->post('choice/delete_choice', 'Questionnaire\ChoiceController@deleteChoice');

