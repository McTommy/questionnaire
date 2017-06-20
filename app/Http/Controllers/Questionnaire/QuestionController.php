<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    protected $question;

    /**
     * QuestionController constructor.
     * @param $question
     */
    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }


    //现实id为$id的调查问卷的问题配置页
    public function index($id)
    {
        $questions = $this->question->byQuestionnaireId($id);
        return view('questionnaire.question.questionnaire_configure',
            ['activity_info_id' => $id, 'questions' => $questions]);
    }

    //存储调查问卷
    public function save(Request $request)
    {
        $data = $request->only(['activity', 'questions', 'answers']);

        dd($data);
        return response()->json(['status' => '123', 'data' => $data]);
    }

}
