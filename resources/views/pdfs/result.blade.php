<style>
    table, th, td {
    border: 1px solid black;
    }
</style>
<table>
	<tr><td>
		@include('partials.courseinfo',['course'=>$exam->course])
	</td>
	<td>
		@include('partials.examinfo',['exam'=>$exam])
	</td>
	</tr>
</table>


<h3>Attendance</h3>
<table class="table table-bordered" width='100%'>
    <thead>
        <tr>
        	<th>Name</th>
            <th>Matric Number</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($results as $result)
        <tr>
        	 <td>{{$result->student->user->name}}</td>
            <td>{{$result->student->reg_number}}</td>
        	<td>{{$result->score}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- /.row -->