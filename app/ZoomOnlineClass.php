<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoomOnlineClass extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'host_user_id');
    }
}
