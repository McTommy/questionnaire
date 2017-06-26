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
 * Date: 17-6-26
 * Time: 上午10:59
 */

namespace App\Repositories;

use App\Blank;
use Illuminate\Support\Facades\DB;
use App\Answer;

class AnswerRepository
{

    //存储答案到数据库
    public function store($datas, $questionnaire_id)
    {
        //
        $max_respondent_id = Answer::max('respondent_id');
        $respondent_id = $max_respondent_id ? $max_respondent_id + 1 : 1;
        $status = 0;
        DB::beginTransaction();

        foreach ($datas as $data) {
            if($data['type'] == 3) {
                $this->storeBlanks($data);
            } else {
                $this->storeAnswers($data);
            }
        }

        if($status == 0) {
            DB::rollback();
            return false;
        } else {
            DB::commit();
            return true;
        }
    }

    //存储填空题
    public function storeBlanks($data)
    {
        try{
            $store_data = [
                'questionnaire_id' => $data['questionnaire_id'],
                'question_id' => $data['question_id'],
                'respondent_id' => $data['respondent_id'],
                'content' => $data['content'],
            ];
            $answer = Blank::create($store_data);
            if($answer == null) return false;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    //存储除了填空外其他题型
    public function storeAnswers($data)
    {
        try{
            $store_data = [
                'questionnaire_id' => $data['questionnaire_id'],
                'question_id' => $data['question_id'],
                'respondent_id' => $data['respondent_id'],
                'choice_id' => $data['content'],
                'other' => $data['other'],
                'multi_blank' => $data['multi_blank'],
            ];
            $answer = Answer::create($store_data);
            if($answer == null) return false;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}