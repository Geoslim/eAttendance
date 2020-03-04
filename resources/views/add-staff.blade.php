@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add Staff</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Staff</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-4" style="margin:auto;">
            <div class="card card-dark" >
                <div class="card-header">
                <h3 class="card-title">Staff Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ url('store-staff') }}" method="POST">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Full Name" value="{{old('fullname')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Full Name" value="{{old('mobile')}}">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" value="{{old('designation')}}">
                    </div>
                    <div class="form-group">
                        <label for="dept">Department</label>
                        <input type="text" class="form-control" id="dept" name="dept" placeholder="Enter Department" value="{{old('dept')}}">
                    </div>
                    
                    {{-- <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div> --}}
                    {{-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                    </div> --}}
                    <div class="form-check">
                    {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label> --}}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
                </form>
            </div>
        </div>
      </div>
   
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection
