<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $fillable = [
        'fuser_id','tuser_id', 'chat',
    ];
}
