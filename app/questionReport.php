<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questionReport extends Model
{
    protected $fillable = [
       'reported_by', 'reported_to','reported_qid','reported_cause',
    ];
}
