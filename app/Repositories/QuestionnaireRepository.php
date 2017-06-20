<?php

namespace App\Repositories;

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
}