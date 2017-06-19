<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blank extends Model
{
    protected $fillable = [
      'question_id', 'content', 'order', 'status'
    ];

    //定义与questions表关系为多对一
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
