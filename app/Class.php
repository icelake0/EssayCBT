<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
    public function course(){
    	return $this->belongsToOne('App\Course','course_id');
    }
    public function tokens()
    {
        return $this->hasMany('App\Token','class_id');
    }
}