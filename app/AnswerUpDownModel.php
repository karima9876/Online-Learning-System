<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerUpDownModel extends Model
{
    protected $fillable = [
        'auserId','ques_id', 'aup','adown',
    ];
}
