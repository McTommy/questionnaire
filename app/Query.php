<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $fillable = ['questionnaire_id', 'content', 'result_number'];

    //定义与questionnaires表关系为多对一
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
