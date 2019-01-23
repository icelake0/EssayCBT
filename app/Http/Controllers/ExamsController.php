<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Course;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $exams = $course->exams;
        return view('exams.list',['exams'=>$exams, 'course'=>$course]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exams.create');
    }
    public function createExam(Request $request, Course $course){
        // if($course->created_by!==Auth::user()->lecturer->id){
        //     return back()->with('error','You can only create questions for your courses');
        // }
        if($request->isMethod('post')){
            $exam = new Exam();
            $exam->course_id=$course->id;
            $exam->duration=$request['duration'];
            $exam->time=$request['time'];
            $exam->date=$request['date'];
            $questions=$request['questions'];
            foreach($questions as $key=>&$question){
                $question=$key;
            }
            $exam->questions=json_encode($questions);
            $exam->save();
             return redirect(route('exams.list',['course'=>$course->id]))->with('success','New Exam Created For Course added');
        }else{
            return view('exams.create',['course'=>$course]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
