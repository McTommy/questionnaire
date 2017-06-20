<?php
/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-6-20
 * Time: 下午3:53
 */

namespace App\Repositories;


use App\Question;

class QuestionRepository
{

    /**
     * @param $id
     * @return mixed
     */
    public function byQuestionnaireId($id)
    {
        return Question::with(['choices'])->where('questionnaire_id', $id)->get();
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
            'maximum_option' => $array['maximum_option'],
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
            'is_respondent_info' => $array['is_respondent_info'],
            'is_phone_number' => $array['is_phone_number']
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
            'parent_order' => $array['parent_order'],
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
            'type' => 4,
            'order' => $array['order'],
            'is_required' => $array['is_required'],
            'parent_order' => $array['parent_order'],
            'measure_word' => $array['measure_word']
        ];

        return Question::create($data);

    }
}