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
    //新建问题
    public function createQuestion(Request $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $order = $request->get('order');
        //使该问卷中order大于等于$order的问题的order（矩阵题parent_order）加一
        $this->question->changeOrder($questionnaire_id, $order);
        $data = $request->only([
            'questionnaire_id', 'order', 'is_required', 'type', 'name'
        ]);
        switch($request->get('type')) {
            case 1:
                $this->question->saveSingleChoice($data);
                break;
            case 2:
                $this->question->saveMultiChoice($data);
                break;
            case 3:
                $this->question->saveFillInBlank($data);
                break;
            case 4:
                $this->question->saveMatrixSingleChoice($data);
                break;
            case 5:
                $this->question->saveMatrixScale($data);
                break;
            case 6:
                $this->question->saveParaDescrip($data);
                break;
        }
        return response()->json(['status' => 200]);

    }

    //编辑问题
    public function updateQuestion(Request $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $order = $request->get('order');
        $old_order = $request->get('old_order');
        $id = $this->question->saveEditQuestion($questionnaire_id, $old_order, $order, $request->get('name'), $request->get('is_required'));
        if($order != $old_order)
            $this->question->changeOrder($questionnaire_id, $order, $old_order, $id);
        return response()->json(['status' => 200]);

    }

    //删除问题
    public function deleteQuestion(Request $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $order = $request->get('order');
        $this->question->deleteQuestion($questionnaire_id,$order);
        return response()->json(['status' => 200]);
    }

}
