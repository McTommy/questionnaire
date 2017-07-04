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

    //
    public function index($id)
    {
        $questions = $this->question->byQuestionnaireId($id);
        $sub_question = $this->question->getAllSubQuestion($id);
        return view('questionnaire.mobile_questionnaire.show_questionnaire', [
            'questionnaire_id' => $id,
            'questionnaire' => $this->questionnaire->byId($id),
            'questions' => $questions,
            'sub_questions' => $sub_question,
        ]);
    }

}
