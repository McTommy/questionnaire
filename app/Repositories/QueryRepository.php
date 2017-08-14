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

    //生成指定excel的数据
    public function generateCellData($queries, $cell_data)
    {
        foreach ($queries as $query) {
            $content = json_decode($query->content);
            $choice_array = [];
            foreach ($content->datas as $content_data) {
                $choice_content = $content_data->is_non == 1 ? '未' : '' . '选择题目为:' . $content_data->question_name .
                    ',子题目为:' . $content_data->sub_question_name . ',选项为:' . $content_data->choice_name . ' 的被调查人';
                array_push($choice_array, $choice_content);
            }
            $condition_array = [];
            foreach ($content->conditions as $condition) {
                $condition_content = $condition == 'and' ? '并且(与)' : '或者(或)';
                array_push($condition_array, $condition_content);
            }
            $data = [
                $query->id, $query->questionnaire->id, $query->questionnaire->title,
                $choice_array[0], isset($condition_array[0])?$condition_array[0]:'空',
                isset($choice_array[1])?$choice_array[1]:'空',isset($condition_array[1])?$condition_array[1]:'空',
                isset($choice_array[2])?$choice_array[2]:'空', $query->result_number,$query->created_at->format('Y-m-d H:i:s')
            ];
            array_push($cell_data, $data);
        }
        return $cell_data;
    }
}