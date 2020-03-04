@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">General Attendance</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">General Attendance</li>
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
       
            <div class="col-md-11"  style="margin:auto;">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">KJK Staff Attendance</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>                  
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Mobile</th>
                          <th>Status</th>
                          <th>Date | Time</th>
                          <th style="width: 40px">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 0; ?>
                    @foreach($attendance as $attend)
                    <?php $i++; ?>
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$attend->fullname}}</td>
                          <td>{{$attend->email}}</td>
                          <td>{{$attend->user->designation}}</td>
                          <td>{{$attend->mobile}}</td>
                          <td>
                              @if($attend->status == "Signed Out")
                                <p class="badge badge-warning">{{$attend->status}}</p>
                              @elseif($attend->status == "Signed In")
                                <p class="badge badge-success">{{$attend->status}}</p>
                              @endif
                            </td>
                          <td>{{$attend->updated_at->format('l jS \\of F Y | h:i:s A')}}</td>
                          <td></td>
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                 
                </div>
       
      </div>
   
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection
