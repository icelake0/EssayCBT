@extends('layouts.app')

@section('content')
<?php $page_title='profile'; ?>
<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">
<link href="{{asset('css/star-rating.min.css')}}"  media="all" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
            <div class="user-bg"> <img width="100%" alt="user" src="{{$user->avatar}}">
                <div class="overlay-box">
                    <div class="user-content">
                        <a href="javascript:void(0)"><img src="{{$user->avatar}}" class="thumb-lg img-circle" alt="img"></a>
                        <h4 class="text-white">{{$user->name}}</h4>
                        <h5 class="text-white">{{$user->email}}</h5> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="white-box">
            <ul class="nav nav-tabs tabs customtab">
                <li class="tab @if(!$settings) active @endif">
                    <a href="#profile" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span> </a>
                </li>
                @if($user->id==Auth::user()->id)
                <li class="tab @if($settings) active @endif">
                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Settings</span> </a>
                </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if(!$settings) active @endif" id="profile">
                    <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                            <br>
                            <p class="text-muted">{{$user->name}}</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                            <br>
                            <p class="text-muted">{{$user->phone}}</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                            <br>
                            <p class="text-muted">{{$user->email}}</p>
                        </div>
                        <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                            <br>
                            <p class="text-muted">{{$user->address}}</p>
                        </div>
                    </div>
                    <hr>
                    @role('lecturer')
                    <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Title</strong>
                            <br>
                            <p class="text-muted">{{$user->lecturer->title}}</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Area Of Specialization</strong>
                            <br>
                            <p class="text-muted">{{$user->lecturer->aos}}</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Office Address</strong>
                            <br>
                            <p class="text-muted">{{$user->lecturer->office_address}}</p>
                        </div>
                    </div>
                    @endrole
                    @role('student')
                    <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Reg Number</strong>
                            <br>
                            <p class="text-muted">{{$user->student->reg_number}}</p>
                        </div>
                    </div>
                    @endrole
                     <h4 class="font-bold m-t-30">About Me</h4>
                    <p class="m-t-30">{{$user->about_me}}</p>
                </div>
                @if($user->id==Auth::user()->id)
                <div class="tab-pane @if($settings) active @endif" id="settings">
                    <form method='post' class="form-horizontal" action="{{route('webauth.updateavatar')}}" files="true" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-12">Select File For Avatar</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="exampleInputPassword1"  name='avatar' required>
                            </div>
                        </div>
                        <button class="btn btn-success">Update Avatar</button>
                    </form>
                    <br>
                    <form class="form-horizontal form-material" method="POST" action="{{route('webauth.updateprofile')}}">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" name='name' value="{{$user->name}}" class="form-control form-control-line"> </div>
                        </div>
                         <div class="form-group">
                            <label for="address" class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$user->address}}" class="form-control form-control-line" name="address" id="example-email"> </div>
                        </div>
                         <div class="form-group">
                            <label for="Nearest Buststop" class="col-md-12">Nearest Buststop</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$user->nearest_busstop}}" class="form-control form-control-line" name="nearest_busstop" id="example-email"> </div>
                        </div>
                         <div class="form-group">
                            <label for="city" class="col-md-12">City</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$user->city}}" class="form-control form-control-line" name="city" id="example-email"> </div>
                        </div>
                         <div class="form-group">
                            <label for="state" class="col-md-12">State</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$user->state}}" class="form-control form-control-line" name="state" id="example-email"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" name='phone' value="{{$user->phone}}" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">About Me</label>
                            <div class="col-md-12">
                                <textarea name='about_me' rows="5" class="form-control form-control-line">{{$user->about_me}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" name='password' value="{{$user->password}}" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-block btn-info btn-lg btn-rounded">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('js/star-rating.min.js')}}" type="text/javascript"></script>
@endsection