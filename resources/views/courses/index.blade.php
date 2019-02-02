@extends('layouts.app')

@section('content')
<?php $page_title='Your Courses'; ?>
<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">
  <div class="col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">Courses</h3>
        <p class="text-muted m-b-30">Table of all courses you are a member of</p>
        <div class="table-responsive">
            <table id="table1" class="table table-striped my-data-table">
              <thead>
                <tr>
                      <th>Section</th>
                      <th>Semester</th>
                      <th>Title</th>
                      <th>Code</th>
                      <th class="text-center">Action</th>
                </tr>
              </thead>
              </tbody>
                    @foreach($courses as $course)
                    <tr>
                      <td>{{$course->section}}</td>
                      <td>{{($course->semester==1)?'First':'Second'}}</td>
                      <td>{{$course->title}}</td>
                      <td>{{$course->code}}</td>
                      <td class="text-center">
                           <a class="btn btn-sm btn-success" href="{{route('courses.show',['course'=>$course->id])}}">
                            <i class="fa fa-eye"></i> View</a>
                           @role('lecturer')
                           <a class="btn btn-sm btn-info" href="{{route('questions.list',['course'=>$course->id])}}"><i class="fa fa-table"></i> Questions</a>
                          <a class="btn btn-sm btn-warning" href="{{route('courses.addlecturers',['course'=>$course->id])}}">
                            <i class="fa fa-plus"></i> Add Lecturers</a>
                          @endrole
                          <a class="btn btn-sm btn-primary" href="{{route('exams.list',['course'=>$course->id])}}"><i class="fa fa-table"></i> Exams</a>
                          
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