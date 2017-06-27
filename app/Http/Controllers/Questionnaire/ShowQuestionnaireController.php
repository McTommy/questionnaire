<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowQuestionnaireController extends Controller
{

    protected $question;

    /**
     * ShowQuestionnaireController constructor.
     * @param $question
     */
    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    //
    public function index($id)
    {
        $questions = $this->question->byQuestionnaireId($id);
        $sub_question = $this->question->getAllSubQuestion($id);
        return view('questionnaire.mobile_questionnaire.show_questionnaire', [
            'activity_info_id' => $id,
            'questions' => $questions,
            'sub_questions' => $sub_question,
        ]);
    }

}
