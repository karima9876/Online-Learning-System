<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'student_id','name','address','email', 'cnumber','message_id','txn_id','status',
    ];
}
