<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = [
      'title', 'author', 'sub_title', 'make_time', 'start_time',
        'end_time', 'is_template', 'editable', 'status'
    ];

    //定义与investigators表为多对多关系
    public function investigators()
    {
        return $this->belongsToMany(Investigator::class)->withTimestamps();
    }

    //定义与questions表关系为一对多
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
