<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
      'question_id', 'content', 'next_question_order', 'order', 'status'
    ];

    //定义与questions表关系为多对一
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    //定义与answers表关系一对一
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    //定义与cache_answers表关系一对多
    public function cache_answer()
    {
        return $this->hasOne(CacheAnswer::class);
    }
}
