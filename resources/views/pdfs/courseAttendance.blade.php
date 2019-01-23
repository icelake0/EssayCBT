<style>
    table, th, td {
    border: 1px solid black;
    }
</style>
@include('partials.courseinfo',['course'=>$course])
<h3>Attendance</h3>
<table class="table table-bordered" width='100%'>
    <thead>
        <tr>
        	<th>Reg Number </th>
        	@foreach($classes as $key=>$classe)
        	<th>{{$key+1}}</th>
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
        	<td>{!!($attended)?'+':'-'!!}</td>
        	@endforeach
            <td>{{$student->total}}</td>
            <td>{{round($student->total/$course->classes->count()*100,2)}}%</td>  
        </tr>
        @endforeach
    </tbody>
</table>
<!-- /.row -->