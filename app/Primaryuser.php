<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class primaryuser extends Model
{
    protected $fillable = [
        'login_id','gmail','ctactnumber', 'guarnumber',
    ];
}
