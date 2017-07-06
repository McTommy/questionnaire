<?php
/**
 * Copyright (c) 2017. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-7-6
 * Time: 下午3:54
 */

namespace App\Repositories;


use App\CacheAnswer;
use App\CacheBlank;

class CacheAnswerRepository
{
//存储答案到数据库
    public function store($datas, $questionnaire_id)
    {
        //

        $max_respondent_id = max(CacheAnswer::where('questionnaire_id', $questionnaire_id)->max('respondent_id'),
            CacheBlank::where('questionnaire_id', $questionnaire_id)->max('respondent_id'));
        $respondent_id = $max_respondent_id ? $max_respondent_id + 1 : 1;
        //清空该调查问卷的缓存记录
        if(CacheBlank::where('questionnaire_id', $questionnaire_id)->first()) {
            CacheBlank::where('questionnaire_id', $questionnaire_id)->delete();
        }
        if(CacheAnswer::where('questionnaire_id', $questionnaire_id)->first()) {
            CacheAnswer::where('questionnaire_id', $questionnaire_id)->delete();
        }
        foreach ($datas as $data) {
            if ($data['type'] == 3) {
                $this->storeBlanks($data, $questionnaire_id, $respondent_id);
            } else {
                $this->storeAnswers($data, $questionnaire_id, $respondent_id);
            }
        }
    }

    //存储填空题
    public function storeBlanks($data, $questionnaire_id, $respondent_id)
    {
        if(isset($data['content'])) {
            $store_data = [
                'questionnaire_id' => $questionnaire_id,
                'question_id' => $data['question_id'],
                'respondent_id' => $respondent_id,
                'content' => $data['content'],
            ];
            CacheBlank::create($store_data);
        }
    }

    //存储除了填空外其他题型
    public function storeAnswers($data, $questionnaire_id, $respondent_id)
    {
        if(isset($data['choice_id'])) {
            if(($data['type'] == 7 && isset($data['multi_blank'])) || $data['type'] != 7) {
                $store_data = [
                    'questionnaire_id' => $questionnaire_id,
                    'question_id' => $data['question_id'],
                    'respondent_id' => $respondent_id,
                    'choice_id' => $data['choice_id'],
                    'other' => isset($data['other']) ? $data['other'] : null,
                    'multi_blank' => isset($data['multi_blank']) ? $data['multi_blank'] : null,
                ];
                CacheAnswer::create($store_data);
            }
        }
    }
}