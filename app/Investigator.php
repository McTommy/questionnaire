<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigator extends Model
{
    protected $fillable = [
        'name', 'employee_id', 'status', 'extra'
    ];

    //定义与questionnaires表关系为多对多
    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)->withTimestamps();
    }
}
