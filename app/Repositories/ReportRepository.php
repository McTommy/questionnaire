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
 * Date: 17-7-11
 * Time: 下午4:33
 */

namespace App\Repositories;

use App\Answer;

class ReportRepository
{
    //查询符合条件的答案
    public function selectAnswersTable($questionnaire_id ,$datas, $conditions)
    {
        //返回该调查问卷所有答案的集合
        $answers = Answer::where('questionnaire_id', $questionnaire_id)->get();
        for ($i=0;$i<count($datas);$i++) {
            $temps[$i] = $this->singleQuery($answers, $datas[$i]);
        }
        //执行交集 并集操作
        $result = [];
        if(!empty($temps)) {
            $result = $temps[0];
            for ($j=0;$j<count($conditions);$j++) {
                if($conditions[$j] == 'and') {
                    $result = array_intersect($result, $temps[$j+1]);
            } else {
                    $result = array_merge($result, $temps[$j+1]);
                }
            }
        }
        $result = array_unique($result);
        asort($result);
        return array_values($result);
    }

    //执行单独的查询语句
    private function singleQuery($answers, $condition)
    {
        $collections = $answers->where('choice_id', $condition['choice_id']);
        if($condition['is_non'] == 1) {
            $all_respondent_id = $this->getRespondentId($answers);
            $not_respondent_id = $this->getRespondentId($collections);
            return array_diff($all_respondent_id, $not_respondent_id);
        } else {
            return $this->getRespondentId($collections);
        }
    }

    //获取respondent_id
    private function getRespondentId($collections)
    {
        $respondent_id = [];
        foreach ($collections as $collection) {
            array_push($respondent_id, $collection->respondent_id);
        }
        return array_unique($respondent_id);
    }

}