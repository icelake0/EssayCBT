@extends('layouts.app')

@section('content')
<?php $page_title='Course Information'; ?>
<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
            	<a class="btn btn-sm btn-success" href="{{route('courses.index')}}">
                            <i class="fa fa-table"></i> All Courses</a>
            	@include('partials.courseinfo',['course'=>$course])
            	<blockquote>
					<ul class="list-icons">
						<li><i class="fa fa-caret-right text-info"></i><strong>Unit : </strong>{{$course->unit}}</li>
						<li><i class="fa fa-caret-right text-info"></i><strong>Reg Key : </strong>{{$course->reg_key}}</li>
						<li><i class="fa fa-caret-right text-info"></i><strong>Lecturer : </strong>{{$course->course_lecturer()->user->name}}</li>
						<li><i class="fa fa-caret-right text-info"></i><strong>Course Team : </strong>
							<ul>
							@foreach($course->lecturers()->with('user')->get() as $lecturer)
								<li><i class="fa fa-caret-right text-info"></i>{{$lecturer->user->name}}</li>
							@endforeach
							</ul>
						</li>
						<li><i class="fa fa-caret-right text-info"></i><strong>Students : </strong>{{$course->students->count()}}</li>
				    </ul>
				</blockquote>
              @role('lecturer')
              <a class="btn btn-sm btn-warning" href="{{route('courses.edit',['course'=>$course->id])}}">
                <i class="fa fa-pencil"></i> Update</a>
              <a class="btn btn-sm btn-info" href="{{route('courses.addlecturers',['course'=>$course->id])}}">
                <i class="fa fa-plus"></i> Add Lecturers</a>
              <a class="btn btn-sm btn-success" href="{{route('courses.attendance',['course'=>$course->id])}}">
                <i class="fa fa-list-alt"></i> Attendance</a>
              <a class="btn btn-sm btn-primary" href="{{route('courses.createclasse',['course'=>$course->id])}}"><i class="fa fa-plus"></i> New Class</a>
              @endrole
              <a class="btn btn-sm btn-info" href="{{route('courses.classes',['course'=>$course->id])}}"><i class="fa fa-table"></i> Classes</a>
              @role('student')
              <a class="btn btn-sm btn-warning" href="{{route('students.courses.attendance',['course'=>$course->id])}}">
              <i class="fa fa-list-alt"></i> My Attendance</a>
              @endrole
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>
@endsection