<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Lecturer;
use App\Classe;
use App\Token;
use PDF;
use App;
class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        if($user->hasRole('lecturer')){
            $courses=$user->lecturer->courses;
        }elseif($user->hasRole('student')){
            $courses=$user->student->courses;
        }
        return view('courses.index',[
            'courses'=>$courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lecturer=Auth::user()->lecturer;
        $course= new Course();
        $course->title=$request['title'];
        $course->code=$request['code'];
        $course->unit=$request['unit'];
        $course->section=$request['section'];
        $course->semester=$request['semester'];
        $course->reg_key=$request['reg_key'];
        $course->created_by=$lecturer->id;
        $course->updated_by=$lecturer->id;
        if($course->save()){
            $lecturer->courses()->attach($course->id);
            return redirect(route('home'));
        }else{
            return back()->with('error','An Error occues please review input and try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show',[
            'course'=>$course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        dd('This is the edit page for course');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }
    public function updateClasse(Classe $classe){
        dd($classe);
    }
    public function showClasse(Classe $classe){
        return view('courses.showClasse',[
            'classe'=>$classe
        ]);
    }
    public function addlecturers(Request $request, Course $course){
        if($course->created_by!==Auth::user()->lecturer->id){
            return back()->with('error','Your Can Only Add lectures to your courses ie. The courses you created');
        }
        if($request->isMethod('post')){
            $errors=[];
            $lecturer_ids=[];
            $lecturer_emails=$request['lecturers'];
            foreach($lecturer_emails as $lecturer_email){
                $user=User::where('email',$lecturer_email)->first();
                if(!$user){
                    array_push($errors,$lecturer_email." is not a valid user's email");
                }else{
                    $lecturer=$user->lecturer;
                    if(!$lecturer){
                        array_push($errors,$lecturer_email." is not a valid lecturer's email");
                    }else{
                        array_push($lecturer_ids,$lecturer->id);
                    }
                }
            }
            if(count($errors) != 0){
                return back()->with('errors',$errors);
            }else{
                $synced=$course->lecturers()->syncWithoutDetaching($lecturer_ids);
                if(!$synced){
                    return back()->with('error', 'Unable to add lecturers to course please check your input and try again');
                }else{
                    return redirect(route('courses.show',['course'=>$course->id]))->with('success','lecturers added to course');
                }
                //return to the course view page
            }
        }else{
            return view('courses.addlecturers',[
                'course'=>$course
            ]);
        }
    }
    public function studentRegister(Request $request, Course $course){
        if($request->isMethod('post')){
            $student=Auth::user()->student;
             if($student->courses->contains($course->id)){
                return back()->withInput()->with('error','You Have Already Registered for this course');
            }elseif($course->reg_key!==$request['reg_key']){
                return back()->withInput()->with('error','Invalid Registration Key, Please confirm the correct Registration Key from the course lecturer');
           }else{
                $course->students()->attach(Auth::user()->student->id);
                return redirect(route('courses.show',['course'=>$course->id]));
            }
        }else{
            return view('courses.studentRegister',['course'=>$course]);
        }

    }
    public function createClasse(Course $course, Request $request){
        $lecturer=Auth::user()->lecturer;
        if(!$course->lecturers->contains($lecturer->id)){
            return back()->withInput()->with('error','You are not a member of this course team, inform the course lecturer to add you as a member to be able to create a class for the course');
        }
        if($request->isMethod('post')){
            $duplicate_classe=Classe::where('course_id',$course->id)->where('date',$request['date'])->where('time',$request['time'])->first();
            if($duplicate_classe){
                return back()->withInput()->with('error','You have already created a class at same date and time for this course');
            }
            $classe= new Classe();
            $classe->course_id=$course->id;
            $classe->created_by=$lecturer->id;
            $classe->date=$request['date'];
            $classe->time=$request['time'];
            if($classe->save()){
                //gen tokens
                for($i=1; $i<=$request['no_of_token']; $i++){
                    $token= new Token();
                    $token->class_id=$classe->id;
                    $token->setToken();
                    $token->save();
                }
                return redirect(route('courses.show',['course'=>$course->id]));
            }else{
                return back()->withInput()->with('error','Something went wrong please try again');
            }
        }else{
            return view('courses.createClasse',[
                'course'=>$course
            ]);
        }

    }
    public function printTokens(Request $request, Classe $classe){
        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        $tokens=$classe->tokens;
        // $tokens=$tokens->map(function($token){
        //     return $token->token;
        // });
        //$tokens=$tokens->toArray();
        $html = view('pdfs.tokens',[
                        'tokens'=>$tokens,
                        'classe'=>$classe,
                    ])->render();
        $pdf = App::make('dompdf.wrapper');
       
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
    public function classes(Course $course){
        $classes=$course->classes;
        return view('courses.classes',[
            'course'=>$course,
            'classes'=>$classes
        ]);
    }
    public function attendance(Course $course){
        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        $attendance_prep=$this->prepAttendance($course);
        return view('courses.attendance',$attendance_prep);
    }
    public function printAttendance(Course $course){
        $attendance_prep=$this->prepAttendance($course);
        $html = view('pdfs.courseAttendance',$attendance_prep)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
    public function prepAttendance(Course $course){
        $course_tokens=[];
        $classes=$course->classes;
        $classes->each(function($classe,$key) use (&$course_tokens){
            $classe->tokens=$classe->tokens->map(function($token){
                return $token->id;
            })->toArray();
            $course_tokens=array_merge($course_tokens,$classe->tokens);
        });
        $students=$course->students()->with(['attendances'=> function($query) use ($course_tokens){
            $query->whereIn('token_id', $course_tokens);
        }])->get();
        //dd($students);
        return [
            'students'=>$students,
            'classes'=>$classes,
            'course'=>$course
        ];
    }
    public function classeAttendance(Classe $classe){
        $attendance_prep=$this->prepClasseAttendance($classe);
        return view('courses.classeAttendance',$attendance_prep);
    }
    public function printClasseAttendance(Classe $classe){
        $attendance_prep=$this->prepClasseAttendance($classe);
        $html = view('pdfs.classeAttendance',$attendance_prep)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream();
        // return view('pdf.classeAttendance');
    }
    public function prepClasseAttendance(Classe $classe){
        $tokens=$classe->tokens->map(function($token){
            return $token->id;
        })->toArray();
        $students=$classe->course->students()->with(['attendances'=> function($query) use ($tokens){
            $query->whereIn('token_id', $tokens);
        }])->get();
        return [
            'classe'=>$classe,
            'students'=>$students
        ];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
