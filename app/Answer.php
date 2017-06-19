<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id', 'choice_id', 'other', 'status'
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
}
