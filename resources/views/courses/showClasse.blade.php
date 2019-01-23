@extends('layouts.app')

@section('content')
<?php $page_title='Course Information'; ?>
<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
            	<a class="btn btn-sm btn-success" href="{{route('courses.classes',['course'=>$classe->course->id])}}">
              <i class="fa fa-table"></i> All Classes</a>
              @role('student')
              <a class="btn btn-sm btn-warning" href="{{route('students.courses.attendance',['course'=>$classe->course->id])}}">
              <i class="fa fa-list-alt"></i> My Attendance</a>
              @endrole
            	@include('partials.classeinfo',['classe'=>$classe])
                @role('lecturer')
               <a class="btn btn-sm btn-warning" href="{{route('courses.classes.update',['classe'=>$classe->id])}}">
                <i class="fa fa-pencil"></i> Update</a>
               <a class="btn btn-sm btn-info" href="{{route('courses.classes.attendance',['classe'=>$classe->id])}}"><i class="fa fa-list-alt"></i> Attendance</a>
               <a target="_blank" class="btn btn-sm btn-primary" href="{{route('courses.printtokens',['classe'=>$classe->id])}}">
                <i class="fa fa-print"></i> Print Tokrns
              </a>
              @endrole
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>
@endsection