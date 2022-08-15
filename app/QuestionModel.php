<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $fillable = [
        'quserId', 'qtitle', 'qcategoryname', 'qcontent','ufile',
    ];
}
