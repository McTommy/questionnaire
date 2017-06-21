<?php
/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-6-20
 * Time: 下午3:53
 */

namespace App\Repositories;


use App\Choice;
use App\Question;

class QuestionRepository
{

    private $condition = [
        ['type', '<>', 4],
        ['type', '<>', 5],
    ];

    /**
     * @param $id
     * @return mixed
     */
    public function byQuestionnaireId($id)
    {
        return Question::where('questionnaire_id', $id)->get();
    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveSingleChoice($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 1,
            'order' => $array['order'],
            'is_required' => $array['is_required']
        ];
        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveMultiChoice($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 2,
            'order' => $array['order'],
            'maximum_option' => isset($array['maximum_option']) ? $array['maximum_option'] : null,
            'is_required' => $array['is_required'],
        ];
        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveFillInBlank($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 3,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
            'is_respondent_info' => isset($array['is_respondent_info']) ? $array['is_respondent_info'] : null,
            'is_phone_number' => isset($array['is_phone_number']) ? $array['is_phone_number'] : null,
        ];

        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveMatrixSingleChoice($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 4,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
            'parent_order' => isset($array['parent_order']) ? $array['parent_order'] : null,
        ];

        return Question::create($data);

    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveMatrixScale($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 5,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
            'parent_order' => isset($array['parent_order']) ? $array['parent_order'] : null,
            'measure_word' => isset($array['measure_word']) ? $array['measure_word'] : null
        ];

        return Question::create($data);
    }

    /**
     * @param $array
     * @return mixed
     */
    public function saveParaDescrip($array)
    {
        $data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['name'],
            'type' => 5,
            'order' => $array['order'],
            'is_required' => 0,
        ];

        return Question::create($data);
    }

    /**
     * @param $questionnaire_id
     * @param $order
     * @param $old_order
     */
    public function changeOrder($questionnaire_id, $order, $old_order = null)
    {
        $questions = Question::where('questionnaire_id', $questionnaire_id)->get();
        foreach ($questions as $question)
        {
            //不为矩阵题
            if($question->type != 4 && $question->type != 5) {
                //若存在旧order
                if($old_order) {
                    //新大于旧， 更改区间内的order
                    if($order > $old_order && $old_order < $question->order && $question->order <= $order) {
                        $question->order --;
                        $question->save;
                    } elseif($order < $old_order && $old_order > $question->order && $question->order >= $order) {
                        $question->order ++;
                        $question->save;
                    }

                } elseif ($question->order >= $order) {
                    $question->order ++;
                    $question->save;
                }
            } else {
                //如果矩阵题parent_order
                if($old_order) {
                    if($order > $old_order && $old_order < $question->parent_order && $question->parent_order <= $order) {
                        $question->parent_order --;
                        $question->save;
                    } elseif($order < $old_order && $old_order > $question->parent_order && $question->parent_order >= $order) {
                        $question->parent_order ++;
                        $question->save;
                    }
                } elseif ($question->parent_order >= $order) {
                    $question->parent_order ++;
                    $question->save;
                }
            }
        }
    }

    /**
     * @param $questionnaire
     * @param $order
     * @param $name
     */
    public function saveEditQuestion($questionnaire, $order, $name, $is_required)
    {
        $data = [
          ['questionnaire_id', $questionnaire],
          ['order', $order],
          ['type', '<>', 4],
          ['type', '<>', 5],
        ];
        $question = Question::where($data)->first();
        $question->name = $name;
        $question->is_required = $is_required;
        $question->save;
    }

    /**
     * @param $questionnaire
     * @param $order
     */
    public function deleteQuestion($questionnaire,$order)
    {
        $condition1 = [
            ['questionnaire_id', $questionnaire],
            ['order', $order],
            ['type', '<>', 4],
            ['type', '<>', 5],
        ];
        //删除关联的选项
        $question = Question::where($condition1)->first();
        Choice::where('question_id', $question->id)->delete();
        //删除关联的子问题
        $condition2 = [
            ['questionnaire_id', $questionnaire],
            ['parent_order', $order],
            ['type', 4],
        ];
        $condition3 = [
            ['questionnaire_id', $questionnaire],
            ['parent_order', $order],
            ['type', 5],
        ];
        Question::where($condition2)->orwhere($condition3)->delete();
        //删除该问题
        $question->delete();
        //order大于该问题的order减一
        $data = [
            ['questionnaire_id', $questionnaire],
            ['order', '>', $order],
            ['type', '<>', 4],
            ['type', '<>', 5],
        ];
        $questions = Question::where($data)->get();
        foreach ($questions as $question) {
            $question->order --;
            $question->save;
        }
    }
}