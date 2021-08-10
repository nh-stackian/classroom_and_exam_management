@extends('teacher.layouts.app')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="panel panel-fill panel-inverse">
                        <div class="panel-heading">
                            <h3 class="" style="color:white;padding:20px">Hi <b>{{ Auth::guard('teacher')->user()->name }}</b>,</h3>
                        </div>
                        <div class="panel-body">
                            <div class="wrapper" style="padding:100px;">
                                <h2 style="color:white;">Welcome to PUST eClassroom</h2>
                                <h4 style="color:white;">Manage your Created Classes and Notices from Notice Board</h4>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
