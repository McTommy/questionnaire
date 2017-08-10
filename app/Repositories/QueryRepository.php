<?php
/**
 * Created by PhpStorm.
 * User: shucheng
 * Date: 17-8-8
 * Time: 下午6:11
 */

namespace App\Repositories;


use App\Query;

class QueryRepository
{
    //存储查询内容
    public function saveQuery($id, $content, $num)
    {
        $data = [
            'questionnaire_id' => $id,
            'content' => $content,
            'result_number' => $num,
        ];
        return Query::create($data);
    }

    //获取全部内容
    public function getAll()
    {
        return Query::where('status', 1)->get();
    }
}