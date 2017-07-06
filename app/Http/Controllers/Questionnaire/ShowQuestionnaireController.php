<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\QuestionnaireRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowQuestionnaireController extends Controller
{

    protected $question;
    protected $questionnaire;

    /**
     * ShowQuestionnaireController constructor.
     * @param $question
     */
    public function __construct(QuestionRepository $question, QuestionnaireRepository $questionnaire)
    {
        $this->question = $question;
        $this->questionnaire = $questionnaire;
    }

    //c端展示调查问卷
    public function index($id)
    {
        $questions = $this->question->byQuestionnaireId($id);
        $sub_question = $this->question->getAllSubQuestion($id);
        $questionnaire = $this->questionnaire->byId($id);
        return view('questionnaire.mobile_questionnaire.show_questionnaire', [
            'questionnaire_id' => $id,
            'questionnaire' => $questionnaire,
            'questions' => $questions,
            'sub_questions' => $sub_question,
        ]);
    }

    //c端重载入该调查问卷的以填信息


}
