<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blank extends Model
{
    protected $fillable = [
      'question_id', 'content', 'order',
        'status', 'questionnaire_id', 'respondent_id'
    ];

    //定义与questions表关系为一对一
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    //定义与questionnaires表关系为多对一
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
