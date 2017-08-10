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
    //新建 编辑 删除问题 自定义logo
    Route::post('question/create_question', 'Questionnaire\QuestionController@createQuestion');
    Route::post('question/update_question', 'Questionnaire\QuestionController@updateQuestion');
    Route::post('question/delete_question', 'Questionnaire\QuestionController@deleteQuestion');
    Route::post('question/save_logo', 'Questionnaire\QuestionController@saveLogoImg');
    //存为模板或取消该模板
    Route::post('question/toggle_template', 'Questionnaire\QuestionnaireController@toggleTemplate');
    //新建选项 配置选项 编辑选项 删除选项
    Route::post('choice/configure_choice', 'Questionnaire\ChoiceController@configureChoice');
    Route::post('choice/create_choice', 'Questionnaire\ChoiceController@createChoice');
    Route::post('choice/update_choice', 'Questionnaire\ChoiceController@editChoice');
    Route::post('choice/delete_choice', 'Questionnaire\ChoiceController@deleteChoice');
    //存储调查问卷填写的答案
    Route::post('answer/store', 'Questionnaire\StoreAnswersController@store');
    //验证该手机号是否参与了此次调查问卷
    Route::post('answer/verify_phone', 'Questionnaire\StoreAnswersController@verifyPhoneNumber');
    //缓存已答完题目到缓存数据库
    Route::post('answer/cache', 'Questionnaire\CacheAnswersController@CacheAnswers');
    //点击提取问卷时验证cookie
    Route::post('answer/cache/verify_cookie', 'Questionnaire\CacheAnswersController@ajaxVerifyCookie');

    //简单查询，返回查询数目
    Route::post('report/simple_query', 'Report\SimpleQueryController@ajaxSimpleQuery');
    //拉取指定问题的子问题
    Route::post('report/get_sub_questions', 'Report\SimpleQueryController@ajaxGetSubQuestions');
    //拉取指定问题的答案
    Route::post('report/get_choices', 'Report\SimpleQueryController@ajaxGetChoices');
    //存储查询条件与数据
    Route::post('report/save_query', 'Report\SimpleQueryController@ajaxSaveQuery');
    //更改问卷结束时间
    Route::post('questionnaire/update_end_time', 'Questionnaire\QuestionnaireController@ajaxUpdateEndTime');
    //检验问卷英文名唯一性
    Route::post('questionnaire/verify_en_name', 'Questionnaire\QuestionnaireController@ajaxVerifyEnName');
    //更新问卷英文名
    Route::post('questionnaire/update_en_name', 'Questionnaire\QuestionnaireController@ajaxUpdateEnName');
    //获取c端二维码
    Route::post('questionnaire/get_c_qrcode', 'Questionnaire\QuestionnaireController@ajaxGetCQrcode');

});

