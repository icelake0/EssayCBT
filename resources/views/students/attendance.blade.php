@extends('layouts.app')

@section('content')
<?php $page_title='Course Attendance'; $total_attendance=0;?>
 <!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Course Attendance</h3>
            <p class="text-muted m-b-20">Table showing your attendance for the course</p>
            @include('partials.courseinfo',['course'=>$course])
            <a class="btn btn-sm btn-info" href="{{route('courses.show',['course'=>$course->id])}}">
            <i class="fa fa-eye"></i> Course </a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Class </th>
                            <th>Attendance</th>              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $classe)
                        <tr>
                            <td>{{$classe->date}} {{$classe->time}}</td>
                            <td>
                            @php
                            if($classe->tokens()->whereIn('id',$student_tokens)->first()){
                                echo '<i class="fa fa-check text-success"></i>';
                                $total_attendance++;
                            }else{
                                echo '<i class="fa fa-close text-danger"></i> <a class="btn btn-sm btn-primary" href="'.route('students.takeattendance',['classe'=>$classe->id]).'">
                            <i class="fa fa-check text-success"></i> Take Attendance</a>';
                            }
                            @endphp
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>Total Class Attended </th>
                            <th>{{$total_attendance}}</th>              
                        </tr>
                        <tr>
                            <th>Attendance%</th>
                            <th>{{round($total_attendance/$course->classes->count()*100,2)}}%</th>              
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


@endsection