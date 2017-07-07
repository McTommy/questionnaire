<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Requests\ConfigureChoiceRequest;
use App\Http\Requests\CreateChoiceRequest;
use App\Http\Requests\DeleteChoiceRequest;
use App\Http\Requests\EditChoiceRequest;
use App\Repositories\ChoiceRepository;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\Controller;

class ChoiceController extends Controller
{

    protected $choice;
    protected $question;

    /**
     * ChoiceController constructor.
     * @param $choice
     */
    public function __construct(ChoiceRepository $choice, QuestionRepository $question)
    {
        $this->choice = $choice;
        $this->question = $question;
    }

    //创建选项，对应单选 多选题
    public function createChoice(CreateChoiceRequest $request)
    {
        $question = $this->question->getSpecifiedQuestion($request);
        //删除对应选项
        $this->choice->deleteByQuestionId($question->id);
        //maximum_option
        $maximum_option = $request->get('maximum_option');
        $question->maximum_option = $maximum_option == null ? null : $maximum_option;
        $question->save();
        //存储新的选项
        $choices = $request->get('choices');
        foreach ($choices as $order => $content)
        {
            $data = [
                'question_id' => $question->id,
                'content' => $content,
                'order' => $order + 1,
                'other_is_required' => $content == "其他___" ? $request->get('other_is_required') : null,
            ];
            $this->choice->saveChoice($data);
        }

        return response()->json(['status' => 200]);
    }

    //编辑选项 单选多选题型的选项涉及编辑功能
    public function editChoice(EditChoiceRequest $request)
    {
        $order = $request->get('order');
        $old_order = $request->get('old_order');
        //获取该选项所在的问题
        $question = $this->question->getSpecifiedQuestion($request);
        //删除该选项
        $this->choice->delByQuestionIdAndOrder($question->id, $old_order);
        //调整顺序
        $this->choice->changeOrder($question->id, $order, $old_order);
        //重新填入该选项
        $data = [
            'question_id' => $question->id,
            'content' => $request->get('content'),
            'order' => $order,
            'jump_to' => $request->get('jump_to'),
        ];
        $this->choice->saveChoice($data);

        return response()->json(['status' => 200]);
    }

    //配置选项 矩阵单选题 矩阵量表题
    public function configureChoice(ConfigureChoiceRequest $request)
    {
        $type = $request->get('type');
        $questionnaire_id = $request->get('questionnaire_id');
        $parent_order = $request->get('question_order');
        $sub_questions = $request->get('sub_question');
        $sub_choices = $request->get('sub_choice');
        //获取主问题
        if($type == 5) {
            $question = $this->question->getSpecifiedQuestion($request);
            //更新主问题度量关键词
            $question->measure_word = $request->get('measure_word');
            $question->save();
        }
        //删除子问题 子问题选项
        $del_sub_questions = $this->question->getSubQuesByQuesOrder($parent_order, $questionnaire_id);
        foreach ($del_sub_questions as $del_sub_question) {
            foreach ($del_sub_question->choices as $choice) {
                $choice->delete();
            }
            $del_sub_question->delete();
        }
        //循环插入子问题与选项
        foreach ($sub_questions as $order => $name) {
            $sub_question_data = [
                'questionnaire_id' => $questionnaire_id,
                'name' => $name,
                'type' => $type,
                'order' => $order + 1,
                'parent_order' => $parent_order
            ];
            $sub_question = $this->question->saveSubMatrixQuestion($sub_question_data);
            foreach ($sub_choices as $choice_order => $content) {
                $sub_choice_data = [
                    'question_id' => $sub_question->id,
                    'content' => $content,
                    'order' => $choice_order + 1,
                ];
                $this->choice->saveChoice($sub_choice_data);
            }
        }

        return response()->json(['status' => 200]);
    }

    //删除选项
    public function deleteChoice(DeleteChoiceRequest $request)
    {
        $question_type = $request->get('type');
        if($question_type == null) {
            $order = $request->get('order');
            //获取该选项所在的问题
            $question = $this->question->getSpecifiedQuestion($request);
            //删除该选项
            $this->choice->delByQuestionIdAndOrder($question->id, $order);
            //调整顺序
            $this->choice->changeOrder($question->id, $order);

            return response()->json(['status' => 200]);
        } elseif ($question_type == 4 || $question_type == 5) {
            //查找此子问题
            $question_order = $request->get('question_order');
            $questionnaire_id = $request->get('questionnaire_id');
            $order = $request->get('order');
            $sub_question = $this->question->getSubQuesByQuesOrder($question_order, $questionnaire_id, $order);
            //删除子问题对应的所有选项
            foreach ($sub_question->choices as $choice) {
                $choice->delete();
            }
            //删除此子问题
            $sub_question->delete();
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 500, 'message' => '题型错误']);
        }
    }

}
