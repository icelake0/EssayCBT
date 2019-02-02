<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Answer extends Model
{
	public function question(){
    	return $this->belongsTo('App\Question','question_id');
    }
    public function grade($point){
    	//get the question
    	//dd(Storage::disk('local')->path('grade.py'));
    	if(!$this->answer){
    		return 0;
    	}
    	$command=escapeshellcmd('python '.Storage::disk('local')->path('grade.py').' '.$this->question->answer.' '.$this->answer);
    	$edit_distance=(float)shell_exec($command);
    	$score=(1/(1+$edit_distance))*$point;
    	return $score;
    }
}
