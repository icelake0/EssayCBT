<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function course(){
    	return $this->belongsTo('App\Course','course_id');
    }
    public function getQuestions(){
    	return (array)json_decode($this->questions);
    }
    public function exam_responses()
    {
        return $this->hasMany('App\ExamResponse','exam_id');
    }
}
