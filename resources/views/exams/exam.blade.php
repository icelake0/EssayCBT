@extends('layouts.app')

@section('content')
<?php $page_title='Take Exam'; ?>
<link href="{{asset('css/flipclock.css')}}" rel="stylesheet">


<div class="col-md-3 col-xs-0">
  <blockquote>
  <h3 class="box-title">Student Information</h3>
  <ul class="list-icons">
        <li><i class="fa fa-caret-right text-info"></i><strong>Name : </strong>{{auth()->user()->name}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Matric Number : </strong>{{auth()->user()->student->reg_number}}</li>
  </ul>
</blockquote>
  @include('partials.courseinfo',['course'=>$exam->course])
</div>
<div class="col-md-6 col-sm-12">

    <div class="white-box">
      <div class="your-clock" style="overflow-y: auto;"></div>
        <h3 class="box-title m-b-0">Answer Question</h3>
        <p class="text-muted m-b-30 font-13">Enter The Answer to each question in the text box</p>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form method='post' action='{{route("exams.take",["exam"=>$exam->id])}}' id="answer_form">
                  @csrf
                  @foreach($questions as $key=>$question)
                    <code>Question {{$key+1}}</code><br>
                    <label for="exampleInputphone">{{$question->question}}</label>
                    <div class="input-group">
                          <div class="input-group-addon"><i class="ti-book"></i></div>
                          <input type="text" class="form-control answer-input" placeholder="Answer {{$key+1}}" name='answer[{{$question->id}}]' autocomplete="off"> 
                    </div>
                    <br>
                  @endforeach
                    <br>
                     <button class="btn btn-block btn-info btn-lg btn-rounded">Submit Answers</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
  @include('partials.examinfo',['course'=>$exam])
</div>




<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('js/flipclock.min.js')}}"></script>
<script>
var clock = $('.your-clock').FlipClock({
  countdown:true,
  callbacks: {
    interval: function () {
        let time = clock.getTime().time;
        //console.log('interval ;',time);
        if (time==0) {
            let answer_inputs=document.getElementsByClassName('answer-input');
            for (let answer_input of answer_inputs) {
                answer_input.setAttribute('readonly','readonly');
            }
            let answer_form=document.getElementById('answer_form');
            console.log(answer_form)
            answer_form.submit();
        }
    },
  }
});
clock.setTime(60*{{$exam->duration}})
clock.start()
</script>
@endsection
