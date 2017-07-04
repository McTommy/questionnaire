<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\DeleteQuestionRequest;
use App\Http\Requests\EditQuestionRequest;
use App\Repositories\QuestionnaireRepository;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    protected $question;
    protected $questionnaire;

    /**
     * QuestionController constructor.
     * @param $question
     */
    public function __construct(QuestionRepository $question, QuestionnaireRepository $questionnaire)
    {
        $this->question = $question;
        $this->questionnaire = $questionnaire;
    }


    //现实id为$id的调查问卷的问题配置页
    public function index($id)
    {
        $questionnaire = $this->questionnaire->byId($id);
        $questions = $this->question->byQuestionnaireId($id);
        $sub_question = $this->question->getAllSubQuestion($id);
        $has_phone_number = $this->question->hasPhoneNumber($id);
        $first_question = $this->question->getFirstQuestion($id);
        if($questionnaire->start_time < date("Y-m-d H:i:s") && $questionnaire->end_time && $questionnaire->start_time)
            return redirect('/questionnaire');
        return view('questionnaire.question.questionnaire_configure', [
                'activity_info_id' => $id,
                'questions' => $questions,
                'sub_questions' => $sub_question,
                'has_phone_number' => $has_phone_number,
                'first_question' => $first_question,
            ]);
    }

    //新建问题
    public function createQuestion(CreateQuestionRequest $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $order = $request->get('order');
        //使该问卷中order大于等于$order的问题的order（矩阵题parent_order）加一
        $this->question->changeOrder($questionnaire_id, $order);
        $data = $request->only([
            'questionnaire_id', 'order', 'is_required', 'type', 'name', 'is_phone_number'
        ]);
        switch($request->get('type')) {
            case 1:
                $question = $this->question->saveSingleChoice($data);
                break;
            case 2:
                $question = $this->question->saveMultiChoice($data);
                break;
            case 3:
                $question = $this->question->saveFillInBlank($data);
                break;
            case 4:
                $question = $this->question->saveMatrixSingleChoice($data);
                break;
            case 5:
                $question = $this->question->saveMatrixScale($data);
                break;
            case 6:
                $question = $this->question->saveParaDescrip($data);
                break;
            case 7:
                $question = $this->question->saveMultiBlank($data);
                break;
            default:
                $question = null;
        }
        if($question) return response()->json(['status' => 200]);
        return response()->json(['status' => 500, 'message' => '新增失败或题型未知']);

    }

    //编辑问题
    public function updateQuestion(EditQuestionRequest $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $order = $request->get('order');
        $old_order = $request->get('old_order');
        $id = $this->question->saveEditQuestion($questionnaire_id, $old_order, $order, $request->get('name'), $request->get('is_required'));
        if($order != $old_order)
            $this->question->changeOrder($questionnaire_id, $order, $old_order, $id);
        if($id) return response()->json(['status' => 200]);
        return response()->json(['status' => 500, 'message' => '更新失败']);

    }

    //删除问题
    public function deleteQuestion(DeleteQuestionRequest $request)
    {
        $questionnaire_id = $request->get('questionnaire_id');
        $order = $request->get('order');
        $this->question->deleteQuestion($questionnaire_id,$order);
        return response()->json(['status' => 200]);
    }

}
