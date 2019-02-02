<blockquote>
	<h3 class="box-title">Course Information</h3>
	<ul class="list-icons">
		<li><i class="fa fa-caret-right text-info"></i><strong>Section : </strong>{{$course->section}}</li>
		<li><i class="fa fa-caret-right text-info"></i><strong>Semester : </strong>{{($course->semester==1)?'First':'Second'}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Title : </strong>{{$course->title}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Code : </strong>{{$course->code}}</li>
    </ul>
</blockquote>