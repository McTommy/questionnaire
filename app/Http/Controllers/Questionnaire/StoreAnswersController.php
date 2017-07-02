<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Requests\StoreAnswersRequest;
use App\Repositories\AnswerRepository;
use App\Http\Controllers\Controller;
use Auth;

class StoreAnswersController extends Controller
{

    protected $answer;

    /**
     * StoreAnswersController constructor.
     * @param $answer
     */
    public function __construct(AnswerRepository $answer)
    {
        $this->middleware('auth');
        $this->answer = $answer;
    }

    //存储调查问卷信息到answer以及blank表中
    public function store(StoreAnswersRequest $request)
    {
        //组织数据格式
        $questionnaire_id = $request->get('questionnaire_id');
        $datas = $request->get('datas');
        //存储到数据库
        $this->answer->store($datas, $questionnaire_id);
        //存储成功
        return response()->json(['code' => 200, 'message' => '问卷提交成功']);
    }
}
