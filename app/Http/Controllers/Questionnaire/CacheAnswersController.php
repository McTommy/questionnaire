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
        $questionnaire_id = $request->get('questionnaire_id');
        //组织数据格式
        $datas = $request->get('datas');
        //存储到数据库
        $this->cache_answer->store($datas, $questionnaire_id);
        //存储成功,问卷答题数加一
        return response()->json(['code' => 200, 'message' => '问卷缓存成功']);
    }

}
