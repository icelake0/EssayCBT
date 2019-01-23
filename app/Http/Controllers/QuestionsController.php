<?php

namespace App\Http\Controllers;

use App\Question;
use App\Course;
use Illuminate\Http\Request;
//use Auth;
//use App;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $questions = $course->questions;
        return view('questions.list',['questions'=>$questions, 'course'=>$course]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('see thge qeudwid ');
        return view('questions.create');
    }
    public function createQuestions(Request $request, Course $course){
        // if($course->created_by!==Auth::user()->lecturer->id){
        //     return back()->with('error','You can only create questions for your courses');
        // }
        if($request->isMethod('post')){
            $questions=$request['question'];
            $answers=$request['answer'];
            foreach($questions as $key=>$question){
                $new_question = new Question();
                $new_question->question=$question;
                $new_question->answer=$answers[$key];
                $new_question->course_id=$course->id;
                $new_question->save();
            }
             return redirect(route('courses.show',['course'=>$course->id]))->with('success','New Questions added to courses successfully');
        }else{
            return view('questions.create',['course'=>$course]);
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
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('questions.edit',['question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $updated=Question::where('id',$question->id)->update([
              "question" =>$request["question"],
              "answer" => $request["answer"]
        ]);
        if($updated){
           return redirect()->route('questions.list', ['course'=> $question->course->id])
            ->with('success' , 'Question update success');
        }else{
            return back()->withInput()->with('error','Something went wrong, review your inputs and try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
