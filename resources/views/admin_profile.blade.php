@extends('layouts.master')
@section('pageTitle', 'Admin Profile')

@section('content')
@if(count($errors) > 0)
   
        <script type="text/javascript">
            swal({
                icon: 'error',
                title:'Validation Error',
                text:" @foreach ($errors->all() as $error) {{ $error }} @endforeach",
                type:'error',
                timer:10000
            }).then((value) => {
              //location.reload();
            }).catch(swal.noop);
         </script>
   
@endif
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Admin Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="avatar/{{Auth::user()->profile_image}}"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ Auth::user()->fullname }}</h3>

                    <p class="text-muted text-center">Admin</p>

                    </div>
                
                </div>
                <!-- /.card -->

            <!-- /.card -->
            </div>

             <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills ">
                            <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab">Admin Details</a></li>
                            {{-- <li class="nav-item"><a class="nav-link " href="#step" data-toggle="tab">Stepping In/Out</a></li>
                            <li class="nav-item"><a class="nav-link " href="#to-do-list" data-toggle="tab">To-Do List</a></li>
                            <li class="nav-item"><a class="nav-link " href="#details" data-toggle="tab">Details</a></li> --}}
                        
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                    
                            <div class=" active tab-pane" id="details">
                                <form role="form" action="{{ route('admin.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Full Name" value="{{(Auth::user()->fullname) ?? old('fullname')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="{{(Auth::user()->email) ?? old('email')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label>
                                            <input type="phone" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" value="{{(Auth::user()->mobile) ?? old('mobile')}}">
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="profile_image">Profile Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="profile_image" name="profile_image">
                                                    <label class="custom-file-label" for="profile_image">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                    
                                    </div>
                                    <!-- /.card-body -->
                    
                                    <div class="">
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                        <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                <!-- /.nav-tabs-custom -->
                </div>
            <!-- /.col -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection
