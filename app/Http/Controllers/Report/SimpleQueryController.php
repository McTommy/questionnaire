<?php

namespace App\Http\Controllers\Report;

use App\Repositories\ChoiceRepository;
use App\Repositories\QueryRepository;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class SimpleQueryController extends Controller
{

    protected $report;
    protected $question;
    protected $questionnaire;
    protected $choice;
    protected $query;

    /**
     * SimpleQueryController constructor.
     * @param $report
     */
    public function __construct(QuestionRepository $question,
                                QuestionnaireRepository $questionnaire,
                                ReportRepository $report,
                                ChoiceRepository $choice,
                                QueryRepository $query
    )
    {
        $this->report = $report;
        $this->question = $question;
        $this->questionnaire = $questionnaire;
        $this->choice = $choice;
        $this->query = $query;
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
//        dd($request);
        $questionnaire_id = $request->get('questionnaire_id');
        $datas = $request->get('datas');
        $conditions = $request->get('conditions');
        if (!$conditions) $conditions = [];
        if (count($datas) - count($conditions) !== 1)
            return response()->json(['code' => 500, 'message' => '数据格式错误']);
        $respondent_id = $this->report->selectAnswersTable($questionnaire_id, $datas, $conditions);
        return response()->json(['code' => 200, 'number' => count($respondent_id), 'respondent_id' => $respondent_id]);
    }

    //ajax获取指定问题的子问题
    public function ajaxGetSubQuestions(Request $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $parent_order = $request->get('question_order');
        $sub_questions = $this->question->getSpecifiedSubQuestion($questionnaire_id, $parent_order);
        $ques = [];
        if ($sub_questions) {
            foreach ($sub_questions as $question) {
                $que = [
                    'id' => $question->id,
                    'name' => $question->name,
                    'order' => $question->order
                ];
                array_push($ques, $que);
            }
            return response()->json(['sub_questions' => $ques, 'code' => 200]);
        } else {
            return response()->json(['messages' => "无指定子问题", 'code' => 500]);
        }
    }

    //ajax获取指定问题的答案
    public function ajaxGetChoices(Request $request)
    {
        $question_id = $request->get('question_id');
        $choices = $this->choice->getByQuestionId($question_id);
        if ($choices) {
            $datas = [];
            foreach ($choices as $choice) {
                $data = [
                    'id' => $choice->id,
                    'content' => $choice->content,
                    'order' => $choice->order
                ];
                array_push($datas, $data);
            }
            return response()->json(['datas' => $datas, 'code' => 200]);
        } else {
            return response()->json(['messages' => "无指定选项", 'code' => 500]);
        }
    }

    //ajax存储查询条件
    public function ajaxSaveQuery(Request $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $datas = $request->get('datas');
        $conditions = $request->get('conditions');
        if (!$conditions) $conditions = [];
        $respondent_id = $this->report->selectAnswersTable($questionnaire_id, $datas, $conditions);
        for ($i=0;count($datas)>$i;$i++) {
            if ($datas[$i]['sub_question_name'] == null)
                $datas[$i]['sub_question_name'] = '';
        }
        $content['datas'] = $datas;
        $content['conditions'] = $conditions;
        $content = json_encode($content, JSON_UNESCAPED_UNICODE);
        $result_number = count($respondent_id);
        if ($this->query->saveQuery($questionnaire_id, $content, $result_number))
            return response()->json(['code' => 200]);
        return response()->json(['code' => 500, 'number' => $result_number, 'message' => "数据保存失败"]);
    }

    //导出保存的调查问卷查询记录
    public function exportExcel($type)
    {
        $queries = $this->query->getAll();
        $cell_data = [
            ['序号', '调查问卷id', '调查问卷名称', '选项一', '条件一', '选项二', '条件二', '选项三', '符合条件的数目', '查询时间'],
        ];
        $cell_data = $this->query->generateCellData($queries, $cell_data);
        Excel::create('查询信息记录表', function ($excel) use ($cell_data) {
            $excel->sheet('simple_query', function ($sheet) use ($cell_data) {
                $sheet->rows($cell_data);
            });
        })->export($type);
    }
}
