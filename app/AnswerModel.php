<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerModel extends Model
{
    protected $fillable = [
        'auserId','qid','afile', 'acontent',
    ];
}
