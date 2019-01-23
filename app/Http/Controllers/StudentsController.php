<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Course;
use App\Classe;
use Auth;
use App\Token;
use App\Attendance;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findCourse(Request $request){
        if($request->isMethod('post')){
            $courses=Course::where('section','like',$request['section'])
                            ->Where('semester',$request['semester'])
                            ->Where('code','like',$request['code'])
                            ->get();
            return view('students.findCourseResult',['courses' => $courses]);
            
        }else{
            return view('students.findCourse');
        }

    }
    public function takeAttendance(Request $request, Classe $classe){
        //do some checks to be sure the student is a member of the class;
        $student=Auth::User()->student;
        //is student for the clsse?
        if(!$student->courses->contains($classe->course->id)){
            return back()->with('error','You are not registered for this course');
        }
        if($request->isMethod('post')){
            $submitted_token=$request['token'];
            $token=$classe->tokens->where('token','like',$submitted_token)->first();
            if(!$token){
                return back()->with('error','Invalid Token');
            }else{
                 //is token used?
                $attendance=$token->attendance;
                if($attendance){
                    //who used the token
                    $error=($attendance->student->id==$student->id)?"You have already taken attendance for this class":"Token already used by another student";
                    return back()->with('error',$error);
                }
                $attendance=new Attendance();
                $attendance->student_id=$student->id;
                $attendance->token_id=$token->id;
                if($attendance->save()){
                    return redirect(route('students.courses.attendance',['course','$course->classe->id']))->with('success','Your attendance have been taken for this class');
                }else{
                    return back()->with('error','Something went wrong please try again');
                }
            }
        }else{
            return view('students.takeAttendance',['classe'=>$classe]);
        }
    }
    public function attendance(Course $course){
        $classes=$course->classes()->with(['tokens'])->get();
        $classes=$classes->map(function($classe){
            $classe->tokens=$classe->tokens->map(function($token){
                return $token->id;
            })->toArray();
            return $classe;
        });
        $student=Auth::user()->student()->with(['attendances'])->first();
        $student_tokens=$student->attendances->map(function($student_token){
            return $student_token->token_id;
        })->toArray();
        return view('students.attendance',[
            'course'=>$course,
            'classes'=>$classes,
            'student_tokens'=>$student_tokens
        ]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
