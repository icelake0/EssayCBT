@extends('layouts.app')

@section('content')
<?php $page_title='Create Exam'; ?>
<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">
  <div class="col-sm-12">
    @include('partials.courseinfo',['course'=>$course])
    <form method='post' action="{{route('exams.createExam',['course'=>$course->id])}}">
    @csrf
    <div class="white-box">
        <label for="date">Exam Date</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-book"></i></div>
            <input type="date" class="form-control" placeholder="Exam Date" name='date' required> 
        </div>
        <label for="time">Exam Time</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-book"></i></div>
            <input type="time" class="form-control" placeholder="Exam Time" name='time' required> 
        </div>
        <label for="duration">Exam Duration(in miniutes)</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-book"></i></div>
            <input type="number" class="form-control" placeholder="Exam Duration(in miniutes)" name='duration' required> 
        </div>
        <label for="duration">Question Point</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-book"></i></div>
            <input type="number" class="form-control" placeholder="Question point" name='point' required> 
        </div>
        <h3 class="box-title m-b-0">Select Questions</h3>
        <p class="text-muted m-b-30">Select Exam Questions from the table by checking the boxes</p>
        <div class="table-responsive">
            <table id="table1" class="table table-striped my-data-table">
              <thead>
                <tr>
                      <th>Id</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th class="text-center">Select Question</th>
                </tr>
              </thead>
              </tbody>
                    @foreach($course->questions as $question)
                    <tr>
                      <td>{{$question->id}}</td>
                      <td>{{$question->question }}</td>
                      <td>{{$question->answer}}</td>
                      <td class="text-center">
                        <input name="questions[{{$question->id}}]" id="checkbox0" type="checkbox">
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table><br>
            <button class="btn btn-block btn-info btn-lg btn-rounded">Save Exam</button>
        </div>
    </div>
</form>
</div>
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js')}}"></script>
@endsection
