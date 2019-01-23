<?php $total_attendance=0;?>
<style>
    table, th, td {
    border: 1px solid black;
    }
</style>
@include('partials.classeinfo',['classe'=>$classe])
<h3>Attendance</h3>
<table class="table table-bordered" width='100%'>
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
                echo '+';
                $total_attendance++;
            }else{
                echo '-';
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