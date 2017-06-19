<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
      'questionnaire_id', 'name', 'type', 'order', 'maximum_option',
        'is_respondent_info', 'parent_order', 'is_required', 'is_phone_number',
        'status'
    ];

    //定义与questionnaires表关系为多对一
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    //定义与answers表关系为一对多
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    //定义与choices表关系为一对多
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    //定义与填空答案表blanks关系为一对多
    public function blanks()
    {
        return $this->hasMany(Blank::class);
    }
}
