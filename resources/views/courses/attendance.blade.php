@extends('layouts.app')

@section('content')
<?php $page_title='Course Attendance'; ?>
 <!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Course Attendance</h3>
            <p class="text-muted m-b-20">Table showing all attendance for the course</p>
            @include('partials.courseinfo',['course'=>$course])
            <a class="btn btn-sm btn-primary" target='_BLANK' href="{{route('courses.printattendance',['course'=>$course->id])}}">
                            <i class="fa fa-print"></i> Print</a>
            <a class="btn btn-sm btn-info" href="{{route('courses.show',['course'=>$course->id])}}">
            <i class="fa fa-eye"></i> Course</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        	<th>Reg Number</th>
                        	@foreach($classes as $classe)
                        	<th>{{$classe->date}}({{$classe->time}})</th>
                        	@endforeach
                        	<th>Total</th>
                            <th>%</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($students as $student)
                        <tr>
                            <td>{{$student->reg_number}}</td>
                            @foreach($classes as $classe)
                                @php
                                    $attended=$student->attendances->whereIn('token_id',$classe->tokens)->first();
                                    if(!isset($student->total) && $attended){
                                        $student->total=1;
                                    }elseif($attended){
                                        $student->total++;
                                    }
                                @endphp
                        	<td>{!!($student->attendances->whereIn('token_id',$classe->tokens)->first())?'<i class="fa fa-check text-success"></i>':'<i class="fa fa-close text-danger"></i>'!!}</td>
                        	@endforeach
                            <td>{{$student->total}}</td>
                            <td>{{round($student->total/$course->classes->count()*100,2)}}%</td>  
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


@endsection