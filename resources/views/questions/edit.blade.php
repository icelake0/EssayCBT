@extends('layouts.app')

@section('content')
<?php $page_title='Edit Question'; ?>
<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">Edit Question</h3>
        <p class="text-muted m-b-30 font-13">You can make modification to the question.</p>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
            	@include('partials.courseinfo',['course'=>$question->course])
                <form method='post' action='{{ route("questions.update",["course"=>$question->course->id]) }}'>
                    @csrf
                    <input type='hidden' name='_method' value='Put'>
                    <div class="form-group">
                        <span id='lecturers_inputs'>
							<div class="form-group">
		                        <label class="col-sm-12">Question</label>
		                        <div class="col-sm-12">
		                            <textarea class="form-control" rows="5"  name='question' required>{{$question->question}}</textarea>
		                        </div>	
	                    	</div>
	                    	<label for="exampleInputphone">Answer</label>
	                    	<div class="input-group">
	                            <div class="input-group-addon"><i class="ti-book"></i></div>
	                            <input type="text" class="form-control" placeholder="answer" name='answer' value="{{$question->answer}}" required> 
	                        </div>
                    	</span>
                    </div>
                   	 <button class="btn btn-block btn-info btn-lg btn-rounded">Update Question</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>
@endsection