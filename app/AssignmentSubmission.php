<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function assignment(){
        return $this->belongsTo(AssignmentCreate::class,'assignment_id');
    }
}
