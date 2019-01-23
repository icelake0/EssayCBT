@extends('layouts.app')

@section('content')
<?php $page_title='Take Attendance'; ?>
<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">Take Attendance</h3>
        <p class="text-muted m-b-30 font-13">Submit the token given in class to prove attendance</p>
        <div class="row">
        	@include('partials.classeinfo',['classe'=>$classe])
            <div class="col-sm-12 col-xs-12">
                <form method='post' class="form-horizontal" action='{{ route("students.takeattendance",["classe"=>$classe->id]) }}'>
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-12">Token</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Token" name="token" required>
                        </div>
                    </div>
                    <button class="btn btn-block btn-info btn-lg btn-rounded">Submit Token</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>
@endsection