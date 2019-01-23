@extends('layouts.app')

@section('content')
<?php $page_title='student Find Course'; ?>
<div class="col-md-3 col-xs-0">
</div>
<div class="col-md-6 col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">Search For Course</h3>
        <p class="text-muted m-b-30 font-13">Enter the course Detail to search for the course to register</p>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form method='post' class="form-horizontal" action='{{ route("students.findcourse") }}'>
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-12">Section</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Section" name="section" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Semester</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="semester" required>
                                <option disabled="" selected="" readonly>--Select Semester--</option>
                                <option value=1>First Semester</option>
                                <option value=2>Second Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Course code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Course Code" name="code" required>
                        </div>
                    </div>
                    <button class="btn btn-block btn-info btn-lg btn-rounded">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-xs-0">
</div>
@endsection