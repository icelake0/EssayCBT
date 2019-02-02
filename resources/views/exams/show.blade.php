@extends('layouts.app')

@section('content')
<?php $page_title='Exam Infromation'; ?>

<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
      @include('partials.courseinfo',['course'=>$exam->course])
      @include('partials.examinfo',['exam'=>$exam])
        <h3 class="box-title m-b-0">Exam Questions</h3>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                
                  @foreach($questions as $key=>$question)
                    <code>Question {{$key+1}}</code><br>
                    <label for="exampleInputphone">{{$question->question}}</label><br>
                    <code>Answer</code><br>
                    <label for="exampleInputphone">{{$question->answer}}</label><br><br>
                    
                  @endforeach
                    <a class="btn btn-sm btn-primary" href="{{route('exams.list',['course'=>$exam->course->id])}}"><i class="fa fa-table"></i> Exmas</a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>

@endsection
