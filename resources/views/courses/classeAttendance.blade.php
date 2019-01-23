@extends('layouts.app')

@section('content')
<?php $page_title='Class Attendance'; $total_attendance=0;?>
 <!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Class Attendance</h3>
            <p class="text-muted m-b-20">Table showing all attendance for the class</p>
            @include('partials.classeinfo',['classe'=>$classe])
            <a class="btn btn-sm btn-primary" target='_BLANK' href="{{route('courses.classes.printattendance',['classe'=>$classe->id])}}">
                            <i class="fa fa-print"></i> Print</a>
            <a class="btn btn-sm btn-info" href="{{route('courses.classes.show',['classe'=>$classe->id])}}">
            <i class="fa fa-eye"></i> Classe</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Reg Number </th>
                            <th>Attendance</th>              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{$student->reg_number}}</td>
                            <td>
                            @php
                            if($student->attendances->count()){
                                echo '<i class="fa fa-check text-success"></i>';
                                $total_attendance++;
                            }else{
                                echo '<i class="fa fa-close text-danger"></i>';
                            }
                            @endphp
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>Total Present Students </th>
                            <th>{{$total_attendance}}</th>              
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


@endsection