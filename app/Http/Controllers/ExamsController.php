<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Course;
use App\Question;
use Illuminate\Http\Request;
use Auth;
use App\ExamResponse;
use App\Answer;
use Illuminate\Support\Carbon ;
use PDF;
use App;
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
            $exam->point=$request['point'];
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
    public function take(Request $request, Exam $exam){
        //this code below is needed here
       // App\ExamResponse::where('student_id',auth()->user()->student->id)->where('exam_id',$exam->id)->first()
        $user=auth()->user();
        $student=$user->student;
        //check that the student is reguistered for the course.
        if(!$student->courses()->where('course_id',$exam->course_id)->first()){
            return back()->with('error','You are not registered for the course');
        }
        //check that the student have not taken the exam
        if(ExamResponse::where('student_id',$student->id)->where('exam_id',$exam->id)->first()){
            return back()->with('error','You have already submitted your answers for the selected Exam');
        }
        //check if its the right time to take the exam
        $now=Carbon::now();
        $now->addHour(1);
        $exam_time=new Carbon(date($exam->date).' '.date($exam->time));
        $due_time=new Carbon(date($exam->date).' '.date($exam->time));
        $due_time=$due_time->addMinute($exam->duration);
        if($now->greaterThan($due_time)){
            return back()->with('error','You Are late for the selected Exam.');
        }
        if($now->lessThan($exam_time)){
             return back()->with('error','It now yet time for the Exam, confirm the time and check back');
        }
        if($request->isMethod('post')){
            $exam_response=new ExamResponse();
            $exam_response->student_id=auth()->user()->student->id;
            $exam_response->exam_id=$exam->id;
            if( $exam_response->save()){
                $answers=$request['answer'];
                $score=0;
                foreach($answers as $key=>$answer){
                    $new_answer= new Answer();
                    $new_answer->question_id=$key;
                    $new_answer->exam_res_id=$exam->id;
                    $new_answer->answer=$answer;
                    $new_answer->save();
                    $score+=$new_answer->grade($exam->point);
                }
                //lets do something sweet 
                $exam_response->score=$score;
                $exam_response->save();
                return redirect(route('exams.list',["exam"=>$exam->course->id]))->with('success','Exam Submitted, you can now check your score');
            }else{
                return back()->withInput()->with('error','Unabe to save your answer, try again');
            }
        }else{
            //TODO check if student have taken the exam first
            $questions=Question::WhereIn('id',$exam->getQuestions())->get();
            return view('exams.exam',['questions'=>$questions, 'exam'=>$exam]);
        }

    }
    public function result(Request $request, Exam $exam){
        $exam_responses=$exam->exam_responses()->with(['student.user'])->get();
        return view('exams.result',['results'=>$exam_responses,'exam'=>$exam]);
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
        $questions=Question::WhereIn('id',$exam->getQuestions())->get();
        return view('exams.show',['questions'=>$questions, 'exam'=>$exam]);
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
    public function printResult(Request $request, Exam $exam){
        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        $results=$exam->exam_responses()->with(['student.user'])->get();
        // $tokens=$tokens->map(function($token){
        //     return $token->token;
        // });
        //$tokens=$tokens->toArray();
        $html = view('pdfs.result',[
                        'results'=>$results,
                        'exam'=>$exam,
                    ])->render();
        $pdf = App::make('dompdf.wrapper');
       
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}
