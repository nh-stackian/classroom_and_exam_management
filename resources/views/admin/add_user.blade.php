@extends('admin.layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Student Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('all-student') }}">Student</a></li>
                        <li class="active">Add Student</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
	           <!-- Basic example -->
	           <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Add Student</h3></div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="panel-body">
                            <form role="form" action="{{ url('admin/insert-student') }}" method="post" enctype="multipart/form-data">
                            	@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Full Name" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student ID</label>
                                    <input type="text" class="form-control" name="student_id" placeholder="Matric Number" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword20">Student Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword20">Student Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Password" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword21"> Student Phone Number</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword21"> Semester </label>
                                    <input type="text" class="form-control" name="semester" placeholder="Semester" >
                                </div>
                                <div class="form-group">
                                	<img id="image" style="width: 100px;height: 100px;margin-bottom:20px;" src="{{ URL::to('frontend/images/user.png') }}" />
                                    <label for="exampleInputPassword11">Student Photo</label>
                                    <input type="file"  name="photo" accept="image/*"   onchange="readURL(this);">
                                </div>
                              
                                <button type="submit" class="btn btn-purple waves-effect waves-light">Add</button>
                            </form>
                        </div><!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col-->

            </div>
        </div> <!-- container -->
                   
    </div> <!-- content -->
</div>

<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection