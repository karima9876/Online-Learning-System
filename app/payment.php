<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id','name','address','email', 'cnumber','amount','message_id','txn_id','payment_type','status',
    ];

    public function user(){
       return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
