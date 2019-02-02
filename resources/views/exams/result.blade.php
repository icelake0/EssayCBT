@extends('layouts.app')

@section('content')
<?php $page_title='Exam Result'; ?>
<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">
  <div class="col-sm-12">
  	@include('partials.courseinfo',['course'=>$exam->course])
    <div class="white-box">
        <h3 class="box-title m-b-0">Exam Result</h3>
        <p class="text-muted m-b-30">Table of exam scores</p>
        <a class="btn btn-sm btn-info" href="{{route('exams.printResult',['exam'=>$exam->id])}}" target="_BLANK"><i class="fa fa-print"></i> Print</a>
        <div class="table-responsive">
            <table id="table1" class="table table-striped my-data-table">
              <thead>
                <tr>
                      <th>Student Name</th>
                      <th>Matric Number</th>
                      <th>Score</th>
                </tr>
              </thead>
              </tbody>
                    @foreach($results as $result)
                    <tr>
                      <td>{{$result->student->user->name}}</td>
                      <td>{{$result->student->reg_number}}</td>
                      <td>{{$result->score}}</td>
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
