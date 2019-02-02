@extends('layouts.app')

@section('content')
<?php $page_title='Exams'; ?>
<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">
  <div class="col-sm-12">
  	@include('partials.courseinfo',['course'=>$course])
    <div class="white-box">
        <h3 class="box-title m-b-0">Course Exams</h3>
        <p class="text-muted m-b-30">Table of course Exams</p>
        @role('lecturer')
        <a class="btn btn-sm btn-info" href="{{route('exams.createExam',['course'=>$course->id])}}"><i class="fa fa-plus"></i> Create New Exam</a>
        @endrole
        <div class="table-responsive">
            <table id="table1" class="table table-striped my-data-table">
              <thead>
                <tr>
                      <th>Id</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Diration</th>
                      <th>Questions</th>
                      <th>Point</th>
                      <th>Total Point</th>
                      @role('student')
                      <th>Score</th>
                      @endrole
                      <th class="text-center">Action</th>
                </tr>
              </thead>
              </tbody>
                    @foreach($exams as $exam)
                    <tr>
                      <td>{{$exam->id}}</td>
                      <td>{{$exam->date}}</td>
                      <td>{{$exam->time}}</td>
                      <td>{{$exam->duration}} Mins</td>
                      <td>{{count($exam->getQuestions())}}</td>
                      <td>{{$exam->point}}</td>
                      <td>{{count($exam->getQuestions())*$exam->point}}</td>
                      @role('student')
                      <td>	@php
                      			$score=App\ExamResponse::where('student_id',auth()->user()->student->id)->where('exam_id',$exam->id)->first();
                      			if($score){
                      				echo $score->score;
                      			}else{
                      				echo 'No Score';
                      			}
                      			//echo auth()->user()->name;
                      		@endphp
                  	  </td>
                      @endrole
                      <td class="text-center">
                      	  @role('lecturer')
                          <a class="btn btn-sm btn-info" href="{{route('exams.show',['exam'=>$exam->id])}}"><i class="fa fa-eye"></i> View</a>
                          <a class="btn btn-sm btn-danger" href="route('webauth.suspenduser',['userid'=>$record->id])"><i class="fa fa-trash"></i>  Delete</a>
                          <a class="btn btn-sm btn-success" href="{{route('exams.result',['exam'=>$exam->id])}}"><i class="fa fa-table"></i> Result</a>
                          @endrole
                          @role('student')
                          @if(!$score)
                           <a class="btn btn-sm btn-success" href="{{route('exams.take',['exam'=>$exam->id])}}"><i class="fa fa-pencil"></i> Start Exam</a>
                           @endif
                          @endrole
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js')}}"></script>
@endsection
