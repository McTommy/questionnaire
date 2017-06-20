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

//续登录才可进行操作
Route::group(['middleware' => 'auth'], function () {
    //重置密码
    Route::post('/reset_password', 'UserController@resetPassword');
    Route::get('/reset_password', 'UserController@resetPasswordShow');
    //登录默认页面
    Route::get('/home', 'HomeController@index')->name('home');
    //制作调查问卷url
    Route::get('questionnaire/question/{id}', 'Questionnaire\QuestionController@index')->name('questionnaire.question');
    Route::post('questionnaire/question/save', 'Questionnaire\QuestionController@save');
    Route::resource('questionnaire', 'Questionnaire\QuestionnaireController');

});
