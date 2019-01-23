@extends('layouts.app')

@section('content')
<?php $page_title='Dashboard'; ?>
<!-- .row -->
<div class="row">

            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Lecturers</h3>
                    <ul class="list-inline two-part">
                        <li><i class="icon-people text-info"></i></li>
                        <li class="text-right"><span class="counter">23</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Students</h3>
                    <ul class="list-inline two-part">
                        <li><i class="fa fa-users text-success"></i></li>
                        <li class="text-right"><span class="">117</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Courses</h3>
                    <ul class="list-inline two-part">
                        <li><i class="icon-folder-alt text-danger"></i></li>
                        <li class="text-right"><span class="">17</span></li>
                    </ul>
                </div>
            </div>
        </div>
    
@endsection
