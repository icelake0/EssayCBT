@extends('layouts.app')

@section('content')
<?php $page_title='Create Questions'; ?>
<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">Create Questions for  course</h3>
        <p class="text-muted m-b-30 font-13">Input the number of questions you wish to add, Enter the question followed by the answer</p>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
            	@include('partials.courseinfo',['course'=>$course])
                <form method='post' action='{{ route("questions.createQuestions",["course"=>$course->id]) }}'>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputphone">Number Of Questions</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ti-number"></i></div>
                            <input type="number" min='1' class="form-control" placeholder="Number Of lecturers" name='number' id='number_of_lecturers' value=1> 
                        </div>
                        <span id='lecturers_inputs'>
							<div class="form-group">
		                        <label class="col-sm-12">Question 1</label>
		                        <div class="col-sm-12">
		                            <textarea class="form-control" rows="5"  name='question[0]' required></textarea>
		                        </div>	
	                    	</div>
	                    	<label for="exampleInputphone">Answer 1</label>
	                    	<div class="input-group">
	                            <div class="input-group-addon"><i class="ti-book"></i></div>
	                            <input type="text" class="form-control" placeholder="answer" name='answer[0]' required> 
	                        </div>
                    	</span>
                    </div>
                   	 <button class="btn btn-block btn-info btn-lg btn-rounded">Save Questions</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
   $(document).ready(function(){
        $("#number_of_lecturers").keyup(function(){
            $("#lecturers_inputs").html("");
            var number_of_inputs=(Number)($("#number_of_lecturers").val());
            for(i=1; i<=number_of_inputs; i++){
                 $("#lecturers_inputs").append(`
                 	<div class="form-group">
		                <label class="col-sm-12">Question ${i}</label>
		                <div class="col-sm-12">
		                            <textarea class="form-control" rows="5"  name='question[${i}]' required></textarea>
		                </div>	
	                </div>
	                <label for="exampleInputphone">Answer ${i}</label>
	                <div class="input-group">
	                    <div class="input-group-addon"><i class="ti-book"></i></div>
	                        <input type="text" class="form-control" placeholder="answer${i}" name='answer[${i}]' required> 
	                </div>
	                <br>
                 	`);

            }
        });
    });
</script>
@endsection