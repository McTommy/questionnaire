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
    public function store($datas, $questionnaire_id, $old_cookie, $new_cookie)
    {
        $max_respondent_id = max(CacheAnswer::where('questionnaire_id', $questionnaire_id)->max('respondent_id'),
            CacheBlank::where('questionnaire_id', $questionnaire_id)->max('respondent_id'));
        $respondent_id = $max_respondent_id ? $max_respondent_id + 1 : 1;
        //清空该调查问卷的缓存记录
        $this->deleteCaches($questionnaire_id, $old_cookie);
        $cache_status = false;
        $blank_status = false;
        $answer_status = false;
        foreach ($datas as $data) {
            if ($data['type'] == 3) {
                $blank_status = $this->storeBlanks($data, $questionnaire_id, $respondent_id, $new_cookie);
            } else {
                $answer_status = $this->storeAnswers($data, $questionnaire_id, $respondent_id, $new_cookie);
            }
            if($blank_status || $answer_status) $cache_status = true;
        }
        return $cache_status;
    }

    //清空该调查问卷的缓存记录
    public function deleteCaches($questionnaire_id, $cookie)
    {
        $condition = [
            ['questionnaire_id', $questionnaire_id],
            ['cookie', $cookie]
        ];
        if(CacheBlank::where($condition)->first()) {
            CacheBlank::where($condition)->delete();
        }
        if(CacheAnswer::where($condition)->first()) {
            CacheAnswer::where($condition)->delete();
        }
    }

    //存储填空题
    public function storeBlanks($data, $questionnaire_id, $respondent_id, $new_cookie)
    {
        if(isset($data['content'])) {
            $store_data = [
                'questionnaire_id' => $questionnaire_id,
                'question_id' => $data['question_id'],
                'respondent_id' => $respondent_id,
                'content' => $data['content'],
                'cookie' => $new_cookie
            ];
            CacheBlank::create($store_data);
            return true;
        } else {
            return false;
        }
    }

    //存储除了填空外其他题型
    public function storeAnswers($data, $questionnaire_id, $respondent_id, $new_cookie)
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
                    'cookie' => $new_cookie
                ];
                CacheAnswer::create($store_data);
                return true;
            }
        } else {
            return false;
        }
    }

    //校验cookie
    public function verifyCookie($cookie, $questionnaire_id)
    {
        $condition = [
            ['questionnaire_id', $questionnaire_id],
            ['cookie', $cookie]
        ];
        if(CacheBlank::where($condition)->first() || CacheAnswer::where($condition)->first()) {
            return true;
        }
        return false;
    }
}