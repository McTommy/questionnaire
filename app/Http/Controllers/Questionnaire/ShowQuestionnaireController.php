<?php

namespace App\Http\Controllers\Questionnaire;

use App\Repositories\CacheAnswerRepository;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowQuestionnaireController extends Controller
{

    protected $question;
    protected $questionnaire;
    protected $cache_answer;

    /**
     * ShowQuestionnaireController constructor.
     * @param $question
     */
    public function __construct(QuestionRepository $question,
                                QuestionnaireRepository $questionnaire,
                                CacheAnswerRepository $cache_answer)
    {
        $this->question = $question;
        $this->questionnaire = $questionnaire;
        $this->cache_answer = $cache_answer;
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
    public function reload($id_cookie)
    {

        $id = explode('_', $id_cookie)[0];
        $cookie = explode('_', $id_cookie)[1];
        //若访问该网页，无cache提取，返回上一页面
        $status = $this->cache_answer->verifyCookie($cookie, $id);
        if(!$status) return back();
        $questions = $this->question->byQuestionnaireId($id, $cookie);
        $sub_question = $this->question->getAllSubQuestion($id, $cookie);
        $questionnaire = $this->questionnaire->byId($id);
        return view('questionnaire.mobile_questionnaire.reload_questionnaire', [
            'questionnaire_id' => $id,
            'questionnaire' => $questionnaire,
            'questions' => $questions,
            'sub_questions' => $sub_question,
        ]);
    }

    //展示感谢页面
    public function thanks($id)
    {
        return view('questionnaire.mobile_questionnaire.thanks', [
            'questionnaire_id' => $id
        ]);
    }

}
