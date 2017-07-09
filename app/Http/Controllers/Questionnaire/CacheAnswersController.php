<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\CacheAnswerRepository;
use App\Repositories\CacheBlankRepository;
use App\Repositories\QuestionnaireRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CacheAnswersController extends Controller
{
    protected $cache_answer;
    protected $questionnaire;

    /**
     * StoreAnswersController constructor.
     * @param $answer
     */
    public function __construct(CacheAnswerRepository $cache_answer, QuestionnaireRepository $questionnaire)
    {
//        $this->middleware('auth');
        $this->cache_answer = $cache_answer;
        $this->questionnaire = $questionnaire;
    }

    //存储答案与填空到缓存数据库中
    public function cacheAnswers(Request $request)
    {
        $old_cookie = $request->get('old_cookie');
        $new_cookie = $request->get('new_cookie');
        $questionnaire_id = $request->get('questionnaire_id');
        //组织数据格式
        $datas = $request->get('datas');
        //存储到数据库
        $this->cache_answer->store($datas, $questionnaire_id, $old_cookie, $new_cookie);

        return response()->json(['code' => 200, 'message' => '问卷缓存成功']);
    }

    //ajax校验cookie
    public function ajaxVerifyCookie(Request $request)
    {
        $cookie = $request->get('cookie');
        $questionnaire_id = $request->get('questionnaire_id');
        $status = $this->cache_answer->verifyCookie($cookie, $questionnaire_id);

        if($status) return response()->json(['code' => 200, 'cookie' => $cookie]);
        return response()->json(['code' => 500]);
    }

}
