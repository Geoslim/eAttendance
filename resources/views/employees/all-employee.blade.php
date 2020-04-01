@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">All Employees</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employees</li>
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
       
            <div class="col-md-12"  style="margin:auto;">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">KJK Employees</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered table-hover" id="table-data">
                      <thead>                  
                        <tr>
                          <th>#</th>
                          <th>Avatar</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Designation</th>
                          <th>Office Hours</th>
                          <th>Status</th>
                          {{-- <th>Date | Time</th> --}}
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 0; ?>
                    @foreach($all_staff as $staff)
                    <?php $i++; ?>
                        <tr>
                          <td>{{$i}}</td>
                          <td><img src="storage/{{$staff->profile_image}}" width="80px"></td>
                          <td>{{$staff->fullname}}</td>
                          <td>{{$staff->email}}</td>
                          <td>{{$staff->designation->title}}</td>
                          <td>{{Carbon\Carbon::parse($staff->designation->time_in)->format('H:i a'). " - ". Carbon\Carbon::parse($staff->designation->time_out)->format('h:i a')}}</td>
                          {{-- <td>{{$staff->mobile}}</td> --}}
                          <td>
                              @if($staff->status == "Signed Out")
                                <p class=" badge badge-warning">{{$staff->status}}</p>
                              @elseif($staff->status == "Signed In")
                                <p class=" badge badge-success">{{$staff->status}}</p>
                              @endif
                            </td>
                          {{-- <td>{{$staff->updated_at->format('D jS, M Y | h:i A')}}</td> --}}
                          <td><a href="{{ route('view-employee', $staff->id) }}" class="btn btn-dark btn-sm">View</a></td>
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                 
                </div>
       
      </div>
   
    </div>


    </div>
    <!-- /.container-fluid -->
  </section>
@endsection
