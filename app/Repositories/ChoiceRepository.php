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
            'next_question_order' => $array['next_question_order'],
            'order' => $array['order'],
        ];
        return Choice::create($data);
    }
}