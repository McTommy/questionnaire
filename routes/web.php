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


Auth::routes();

//只登录才可进行操作
Route::group(['middleware' => 'auth'], function () {
    //重置密码
    Route::post('/reset_password', 'UserController@resetPassword');
    Route::get('/reset_password', 'UserController@resetPasswordShow');
    //登录默认页面
    Route::get('/home', 'HomeController@index')->name('home');
    //制作调查问卷url
    Route::get('questionnaire/{id}', 'Questionnaire\QuestionController@index')->name('questionnaire.question');
    Route::post('questionnaire/question/save', 'Questionnaire\QuestionController@save');
    Route::resource('questionnaire', 'Questionnaire\QuestionnaireController');
});

//展示问卷与填写提交问卷，不需要登录，调用中间件respondent
Route::group(['middleware' => 'respondent'], function () {
    Route::get('questionnaire/show/{id}', 'Questionnaire\ShowQuestionnaireController@index');
    Route::get('questionnaire/reload/{id_cookie}', 'Questionnaire\ShowQuestionnaireController@reload');
    Route::post('questionnaire/store_answers', 'Questionnaire\StoreAnswersController@store');
    //展示填写完后的页面
    Route::get('questionnaire/mobile/thanks', function () {
        return view('questionnaire.mobile_questionnaire.thanks');
    });
});