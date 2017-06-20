<?php
/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-6-20
 * Time: 下午3:53
 */

namespace App\Repositories;


class QuestionRepository
{

    public function saveSingleChoice($array)
    {
        $question_data = [
            'questionnaire_id' => $array['questionnaire_id'],
            'name' => $array['question']['name'],
            'type' => 1,
            'order' => $array['question']['order'],
            'is_required' => $array['question']['is_required']
        ];


    }


    public function saveMultiChoice($array)
    {

    }

    public function saveFillInBlank($array)
    {

    }

    public function saveMatrixSingleChoice($array)
    {

    }

    public function saveMatrixScale($array)
    {

    }
}