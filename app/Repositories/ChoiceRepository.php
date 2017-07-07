<?php
/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-6-20
 * Time: 下午4:35
 */

namespace App\Repositories;


use App\Choice;

class ChoiceRepository
{

    /**
     * @param $array
     * @return mixed
     */
    public function saveChoice($array)
    {
        $data = [
            'question_id' => $array['question_id'],
            'content' => $array['content'],
            'order' => $array['order'],
            'next_question_order' => isset($array['jump_to']) ? $array['jump_to'] : null,
            'other_is_required' => isset($array['other_is_required']) ? $array['other_is_required'] : null
        ];
        return Choice::create($data);
    }

    /**
     * @param $question_id
     * @return mixed
     */
    public function deleteByQuestionId($question_id)
    {
        return Choice::where('question_id', $question_id)->delete();
    }

    /**
     * @param $question_id
     * @param $order
     * @return mixed
     */
    public function delByQuestionIdAndOrder($question_id, $order)
    {
        $condition = [
            ['question_id', $question_id],
            ['order', $order]
        ];
        return Choice::where($condition)->delete();
    }


    /**
     * @param $question_id
     * @param $old_order
     * @param $order
     */
    public function changeOrder($question_id, $order, $old_order = null)
    {
        $choices = Choice::where('question_id', $question_id)->get();
        foreach ($choices as $choice)
        {
            if($old_order) {
                if($choice->order > $old_order && $choice->order <= $order) {
                    $choice->order--;
                    $choice->save();
                } elseif ($choice->order < $old_order && $choice->order >= $order) {
                    $choice->order++;
                    $choice->save();
                }
            } else {
                if($choice->order > $order) {
                    $choice->order--;
                    $choice->save();
                }
            }

        }
    }

}