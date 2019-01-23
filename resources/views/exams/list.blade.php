@extends('layouts.app')

@section('content')
<?php $page_title='Questions'; ?>
<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">
  <div class="col-sm-12">
  	@include('partials.courseinfo',['course'=>$course])
    <div class="white-box">
        <h3 class="box-title m-b-0">Course Questions</h3>
        <p class="text-muted m-b-30">Table of course questions</p>
        <a class="btn btn-sm btn-info" href="{{route('exams.createExam',['course'=>$course->id])}}"><i class="fa fa-plus"></i> Create New Exam</a>
        <div class="table-responsive">
            <table id="table1" class="table table-striped my-data-table">
              <thead>
                <tr>
                      <th>Id</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Diration</th>
                      <th class="text-center">Action</th>
                </tr>
              </thead>
              </tbody>
                    @foreach($exams as $exam)
                    <tr>
                      <td>{{$exam->id}}</td>
                      <td>{{$exam->date}}</td>
                      <td>{{$exam->time}}</td>
                      <td>{{$exam->duration}}</td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="{{route('exams.show',['exam'=>$exam->id])}}"><i class="fa fa-eye"></i> View</a>
                          <a class="btn btn-sm btn-danger" href="route('webauth.suspenduser',['userid'=>$record->id])"><i class="fa fa-trash"></i> Delete</a>
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
