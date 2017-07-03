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
 * Date: 17-7-3
 * Time: 下午3:52
 */

namespace App\Repositories;


use App\Blank;

class BlankRepository
{
    //查询该手机号是否出现在指定问卷中
    public function verifyPhoneNumber($questionnaire_id, $question_id, $phone_number)
    {
        $condition = [
            ['questionnaire_id', $questionnaire_id],
            ['question_id', $question_id],
            ['content', $phone_number],
        ];
        $temp = Blank::where($condition)->first();
        if($temp) return true;
        return false;
    }
}