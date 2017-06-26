<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreAnswersController extends Controller
{

    protected $answer;

    /**
     * StoreAnswersController constructor.
     * @param $answer
     */
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    //存储调查问卷信息到answer以及blank表中
    public function store(Request $request)
    {
        //组织数据格式
        $data = [
            ['type', 'question_id', 'choice_id', 'other', 'multi_blank', 'content'],
            []
        ];
        $questionnaire_id = 1;
        //存储到数据库
        $status = $this->answer->store($data, $questionnaire_id);
        //存储成功
        if($status) return response()->json(['code' => 200, 'message' => '问卷提交成功']);
        return response()->json(['code' => 200, 'message' => '问卷提交失败']);
    }
}
