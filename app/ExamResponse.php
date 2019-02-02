<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamResponse extends Model
{
    public function exam(){
    	return $this->belongsTo('App\Exam','course_id');
    }
    public function student(){
    	return $this->belongsTo('App\Student','student_id');
    }
}
