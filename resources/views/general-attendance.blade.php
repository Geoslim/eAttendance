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
                    <h3 class="card-title">KJK Employee Attendance</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered table-hover" id="table-data">
                      <thead>                  
                        <tr>
                          <th>#</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Designation</th>
                          <th>Mobile</th>
                          <th>Lateness</th>
                          <th>Status</th>
                          <th>Date | Time</th>
                          <th>Action</th>
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
                          <td>{{$attend->user->designation->title}}</td>
                          <td>{{$attend->mobile}}</td>
                          <td><p class=" badge badge-success">Not Late</p></td>
                          <td>
                              @if($attend->status == "Signed Out")
                                <p class="badge badge-warning">{{$attend->status}}</p>
                              @elseif($attend->status == "Signed In")
                                <p class="badge badge-success">{{$attend->status}}</p>
                              @endif
                            </td>
                          <td>{{$attend->updated_at->format('D jS, M Y | h:i A')}}</td>
                          <td></td>
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                    {{-- {{ $attendance->links() }} --}}
                  </div>
                  <!-- /.card-body -->
                 
                </div>
       
      </div>
   
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection
