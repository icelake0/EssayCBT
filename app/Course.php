<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lecturer;

class Course extends Model
{
	public function lecturers(){
        return $this->belongsToMany('App\Lecturer','course_lecturer','course_id','lecturer_id');
    }
    public function students(){
        return $this->belongsToMany('App\Student','course_student','course_id','student_id');
    }
    public function course_lecturer(){
   		return Lecturer::where('id',$this->created_by)->with('user')->first();
    }
    public function classes()
    {
        return $this->hasMany('App\Classe','course_id');
    }
}
