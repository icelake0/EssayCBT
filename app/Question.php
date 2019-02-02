<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function course(){
    	return $this->belongsTo('App\Course','course_id');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer','answer_id');
    }
}
