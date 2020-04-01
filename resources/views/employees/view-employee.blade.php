@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ $view_employee->fullname }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee Details</li>
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
                  src="{{ asset('storage/'.$view_employee->profile_image) }}"
                     alt="User profile picture" height="10px">
              </div>

              <h3 class="profile-username text-center">{{ $view_employee->fullname }}</h3>

              <p class="text-muted text-center">{{ $view_employee->designation->title }}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  @if($view_employee->status == "Signed Out")
                  <b>Currently </b><span class=" badge badge-warning float-right">{{$view_employee->status}}</span>
                @elseif($view_employee->status == "Signed In")
                <b>Currently </b><span class=" badge badge-success float-right">{{$view_employee->status}}</span>
                @endif
                 
                </li>

                <li class="list-group-item">
                  @if($view_employee->status == "Signed Out")
                  <b>Signed Out </b><span class="time float-right"><i class="far fa-clock"></i> {{$view_employee->updated_at->format('h:i:s A')}}</span>
                  @elseif($view_employee->status == "Signed In")
                  <b>Signed In </b><span class="time float-right"><i class="far fa-clock"></i> {{$view_employee->updated_at->format('h:i:s A')}}</span>
                  @endif
                </li>

                @if($view_employee->hr_approve == 0 )
                <li class="list-group-item">
                 
                  <b>Forgot to Sign Out </b>
                  <span class="time float-right">
                    <form action="{{ route('approveuser.update', $view_employee->id) }}" method="POST" class="" style="margin:auto;">
                      @method('PUT')
                      @csrf 
                      <input type="text" name="hr_approve" id="hr_approve" value="1" hidden>
                      <button class="btn btn-dark btn-sm float-right">HR Sign Out</button>
                     
                  </form>
                  </span>
                 
                </li>
                @endif
              </ul>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

      
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-3 row">
              <ul class="nav nav-pills col-md-11">
                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Attendance Timeline</a></li>
                <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Statistics</a></li>
                <li class="nav-item"><a class="nav-link " href="#details" data-toggle="tab">Details</a></li>
               
              </ul>
              <span class="col-md-1 float-right">
                <form action="{{ route('employee.delete',$view_employee->id) }}" method="post">
                  @method('DELETE')
                  @csrf
                    <button type="submit" class="btn btn-sm" >
                      <i onclick="return confirm('Deleting Employee. Are you sure?')" class="fa fa-trash text-danger"></i>
                    </button>

                </form>
             

              </span>

            </div><!-- /.card-header -->
            
            <div class="card-body">
              <div class="tab-content">
            
                <div class=" active tab-pane" id="timeline">
                  <!-- The timeline -->
                  <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    {{-- <div class="time-label">
                      <span class="bg-info">
                        10 Feb. 2014
                      </span>
                    </div> --}}
                  
                    <!-- timeline item -->
                    @foreach ($attendance as $staff_attend)

                    @if ($staff_attend->status == "Signed In")
                      <div>
                        <i class="fas fa-user bg-success"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> {{ $staff_attend->created_at->format('l jS F Y | h:i:s A') }}</span>

                          <p class="timeline-header border-0 badge badge-success text-white">{{ $staff_attend->status }}</p>
                        </div>
                      </div>
                    @else
                    <div>
                      <i class="fas fa-user bg-warning"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> {{ $staff_attend->created_at->format('l jS F Y | h:i:s A') }}</span>

                        <p class="timeline-header border-0 badge badge-warning">{{ $staff_attend->status }}</p>
                      </div>
                    </div>
                    @endif
                     


                    @endforeach
                  
                    <!-- END timeline item -->
                 
                   
                    <div>
                      <i class="far fa-clock bg-gray"></i>
                    </div>
                  </div>
                  {{-- {{ $attendance->links() }} --}}
                </div>
                <!-- /.tab-pane -->

                <div class=" tab-pane" id="activity">
                 
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-clock"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Clocked In</span>
                          <span class="info-box-number">21</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-flag"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Clocked Out</span>
                          <span class="info-box-number">21</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-calendar"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Working Days</span>
                          <span class="info-box-number">21</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Late Days</span>
                          <span class="info-box-number">9</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                     <!-- /.col -->
                     <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Forgot to Sign Out</span>
                          <span class="info-box-number">9</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                  </div>
                 
               
                </div>
                <!-- /.tab-pane -->

                <div class=" tab-pane" id="details">
                  <div class="row">
                    <div class="col-md-6">
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Email Address:</b> <span class="time float-right"> {{ $view_employee->email }}</span>
                        </li>
                        <li class="list-group-item">
                          <b>Member Since: </b> <span class="time float-right"> {{ Carbon\Carbon::parse($view_employee->member_since)->format('D jS, M Y') }}</span>
                        </li>
                        <li class="list-group-item">
                          <b>Office Hours: </b> <span class="time float-right"> {{ Carbon\Carbon::parse($view_employee->designation->time_in)->format('H:i a'). "-". Carbon\Carbon::parse($view_employee->designation->time_out)->format('h:i a')}}</span>
                        </li>
                    </div>
                    <div class="col-md-6">
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Mobile Number:</b> <span class="time float-right"> {{ $view_employee->mobile }}</span>
                        </li>
                        <li class="list-group-item">
                          <b>Gender: </b> <span class="time float-right"> {{ $view_employee->gender}}</span>
                        </li>
                        <li class="list-group-item">
                          <b>Lateness Benchmark: </b> <span class="time float-right"> {{ Carbon\Carbon::parse($view_employee->designation->lateness_benchmark)->format('h:i a')}}</span>
                        </li>
                    </div>
                  </div>
                 
                </div>
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
    
    <!-- /.container-fluid -->
  </section>
@endsection
