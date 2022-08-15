<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyUpDownModel extends Model
{
    protected $fillable = [
        'ruserId','ans_id', 'rup','rdown',
    ];
}
