@extends('layouts.app')

@section('content')
<?php $page_title='student register course'; ?>
<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">student register course</h3>
        <p class="text-muted m-b-30 font-13">Privide a correct registration key obtained from the course lecturer to register</p>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
            	@include('partials.courseinfo',['course'=>$course])
                <form method='post' class="form-horizontal" action="{{ route('courses.studentregister',['course'=>$course->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-12">Registration Key</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Registration Key" name="reg_key" required>
                        </div>
                    </div>
                    <button class="btn btn-block btn-info btn-lg btn-rounded">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>
@endsection