<blockquote>
	<h3 class="box-title">Class Information</h3>
	<ul class="list-icons">
		<li><i class="fa fa-caret-right text-info"></i><strong>Section : </strong>{{$classe->course->section}}</li>
		<li><i class="fa fa-caret-right text-info"></i><strong>Semester : </strong>{{($classe->course->semester==1)?'First':'Second'}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Course Title : </strong>{{$classe->course->title}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>course Code : </strong>{{$classe->course->code}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Date : </strong>{{$classe->date}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Time : </strong>{{$classe->time}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Registered Students : </strong>{{$classe->course->students->count()}}</li>
    </ul>
</blockquote>