<?php

namespace App\Http\Controllers\Report;

use App\Repositories\QuestionnaireRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SimpleQueryController extends Controller
{

    protected $report;
    protected $question;
    protected $questionnaire;

    /**
     * SimpleQueryController constructor.
     * @param $report
     */
    public function __construct(QuestionRepository $question,
                                QuestionnaireRepository $questionnaire,
                                ReportRepository $report)
    {
        $this->report = $report;
        $this->question = $question;
        $this->questionnaire = $questionnaire;
    }

//    拉取问题展示
    public function index($id)
    {
        $questions = $this->question->byQuestionnaireId($id);
        return view('report/simple_query/index', [
            'questionnaire_id' => $id,
            'questions' => $questions,
        ]);
    }

//    ajax提交查询条件
//    questionnaire_id: questionnaire_id,
//    datas: {
//        0: {
//           'is_non': 1 or 0,
//            'choice_id': 707
//        }
//        ...
//    },
//    conditions: {
//        0: 'and',
//        1: 'or',
//        ...
//    }
    public function ajaxSimpleQuery(Request $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $datas = $request->get('datas');
        $conditions = $request->get('conditions');
        if(count($datas) - count($conditions) !== 1)
            return response()->json(['code' => 500, 'message' => '数据格式错误']);
        $respondent_id = $this->report->selectAnswersTable($questionnaire_id, $datas, $conditions);
        return response()->json(['code' => 200, 'number' => count($respondent_id), 'respondent_id' => $respondent_id]);
    }
}
