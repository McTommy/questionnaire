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

//创建调查问卷页面ajax调用的api
Route::group(['middleware' => 'api'], function () {
    //新建 编辑 删除问题
    Route::post('question/create_question', 'Questionnaire\QuestionController@createQuestion');
    Route::post('question/update_question', 'Questionnaire\QuestionController@updateQuestion');
    Route::post('question/delete_question', 'Questionnaire\QuestionController@deleteQuestion');
    //新建选项 配置选项 编辑选项 删除选项
    Route::post('choice/configure_choice', 'Questionnaire\ChoiceController@configureChoice');
    Route::post('choice/create_choice', 'Questionnaire\ChoiceController@createChoice');
    Route::post('choice/update_choice', 'Questionnaire\ChoiceController@editChoice');
    Route::post('choice/delete_choice', 'Questionnaire\ChoiceController@deleteChoice');
});

