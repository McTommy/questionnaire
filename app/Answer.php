<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id', 'respondent_id', 'multi_blank',
        'choice_id', 'other', 'status', 'questionnaire_id'
    ];

    //定义与questions表关系为多对一
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    //定义与choices表关系为多对一
    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    //定义与questionnaires表关系为多对一
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
