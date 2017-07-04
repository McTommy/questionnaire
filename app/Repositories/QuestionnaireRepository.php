<?php

namespace App\Repositories;

use App\Choice;
use App\Question;
use App\Questionnaire;

class QuestionnaireRepository
{
    //创建paginate
    public function questionnaire_paginate($number)
    {
        return Questionnaire::where('status', 1)->paginate($number);
    }

    //存储questionnaire数据
    public function create($data)
    {
        return Questionnaire::create($data);
    }

    //以主键查找调查问卷
    public function byId($id)
    {
        return Questionnaire::find($id);
    }

    //更改该问卷模板状态
    public function toggleTemplate($id)
    {
        $questionnaire = Questionnaire::find($id);
        if($questionnaire->is_template == 1) {
            $questionnaire->is_template = 0;
        } else {
            $questionnaire->is_template = 1;
        }
        $questionnaire->save();
    }

    //返回所有模板
    public function getAllTemplate()
    {
        $condition = [
            ['is_template', 1],
            ['status', 1]
        ];
        return Questionnaire::where($condition)->get();
    }

    //加载所选模板的问题和选项
    public function loadSelectTemplate($template_id, $id)
    {
        $condition = [
          ['questionnaire_id', $template_id]
        ];
        $template_questions = Question::where($condition)->get();
        foreach ($template_questions as $template_question) {
            $question_data = [
                'questionnaire_id' => $id,
                'name' => $template_question->name,
                'type' => $template_question->type,
                'order' => $template_question->order,
                'maximum_option' => $template_question->maximum_option,
                'is_respondent_info' => $template_question->is_respondent_info,
                'parent_order' => $template_question->parent_order,
                'is_required' => $template_question->is_required,
                'measure_word' => $template_question->measure_word,
                'is_phone_number' => $template_question->is_phone_number,
            ];
            $question = Question::create($question_data);
            foreach ($template_question->choices as $template_choice) {
                $choice_data = [
                    'question_id' => $question->id,
                    'content' => $template_choice->content,
                    'next_question_order' => $template_choice->next_question_order,
                    'order' => $template_choice->order,
                ];
                Choice::create($choice_data);
            }
        }
    }

    //
    public function incrementAnswerNumber($id)
    {
        Questionnaire::where('id', $id)->increment('answer_number');
    }

}