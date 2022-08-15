<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class answerReport extends Model
{
    protected $fillable = [
        'reported_by', 'reported_to','reported_aid','reported_cause',
     ];
}
