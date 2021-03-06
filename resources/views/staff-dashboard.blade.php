@extends('layouts.master')

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
          <h1 class="m-0 text-dark">Employee Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee</li>
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

              <p class="text-muted text-center">{{ Auth::user()->designation->title }}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  @if(Auth::user()->status == "Signed Out")
                  <b>Currently </b><span class=" badge badge-warning float-right">{{Auth::user()->status}}</span>
                @elseif(Auth::user()->status == "Signed In")
                <b>Currently </b><span class=" badge badge-success float-right">{{Auth::user()->status}}</span>
                @endif
                 
                </li>

                <li class="list-group-item">
                  <b>Tasks </b><span class=" badge badge-warning float-right">{{ count($incomplete_tasks) }} Pending</span>
                </li>
                <li class="list-group-item">
                  @if(Auth::user()->status == "Signed Out")
                  <b>Signed Out </b><span class="time float-right"><i class="far fa-clock"></i> {{Auth::user()->updated_at->format('h:i:s A')}}</span>
                  @elseif(Auth::user()->status == "Signed In")
                  <b>Signed In </b><span class="time float-right"><i class="far fa-clock"></i> {{Auth::user()->updated_at->format('h:i:s A')}}</span>
                  @endif
                </li>
               
              </ul>
              

              <form action="{{ url('updateStaffStatus/'.Auth::user()->id) }}" method="POST" class="" style="margin:auto;">
                @method('PUT')
                @csrf 
                <input type="checkbox" name="status" {{(Auth::user()->status == 'Signed In') ? 'checked' : ''}} data-toggle="toggle" data-on="{{(Auth::user()->status == 'Signed In') ? 'Signed In' : 'Sign In'}}" data-off="{{(Auth::user()->status == 'Signed Out') ? 'Signed Out' : 'Sign Out'}}" data-onstyle="success" data-offstyle="warning" class="text-white">      
                <button class="btn btn-dark float-right" {{($stepped_out) ? 'disabled' : ''}} >Enter</button>
              
            </form>

            </div>
            <!-- /.card-body -->
            
            @if (Auth::user()->status == 'Signed In')
            @if (!$stepped_out)

            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-default">
              Step Out
            </button>

            @elseif($stepped_out)
            <ul class="list-group list-group-unbordered mb-1 p-2">
              
              <li class="list-group-item">
                <b>Currently Stepped out </b><span class="time float-right"><i class="far fa-clock"></i> {{$stepped_out->created_at->format('h:i:s A')}}</span>
                <span class="badge pulsate badge-secondary">Check Tab for details </span>
                
              </li>
             
            </ul>
            @endif
            @endif
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Step Out Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    {{-- <p> reason for stepping out</p> --}}
                    <form action="{{ route('step.out') }}" method="POST" class="" style="margin:auto;">

                      @csrf 
                      <div class="form-group">
                        <input type="text" name="user_id" id="" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" name="status" id="" value="0" hidden>
                        <label for="reason">Please state your reason for stepping out</label>
                        <textarea class="form-control" rows="3" name="reason" id="reason" placeholder="Enter ..."></textarea>

                      </div>
                      <button class="btn btn-dark btn-sm float-right">Enter</button>
                    </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                    {{-- <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button> --}}
                    {{-- <button type="button" class="btn btn-dark btn-sm">Save changes</button> --}}
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          </div>
          <!-- /.card -->

      
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills ">
                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Attendance Timeline</a></li>
                <li class="nav-item"><a class="nav-link " href="#step" data-toggle="tab">Stepping In/Out</a></li>
                <li class="nav-item"><a class="nav-link " href="#to-do-list" data-toggle="tab">To-Do List</a></li>
                <li class="nav-item"><a class="nav-link " href="#details" data-toggle="tab">Details</a></li>
               
              </ul>
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
                    @foreach ($staff_attendance as $staff_attend)

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
                  {{ $staff_attendance->links() }}
                </div>
                <!-- /.tab-pane -->

                <div class=" tab-pane" id="step">
                 
                  <div class="timeline">
                  
                    <!-- timeline item -->
                    @foreach ($stepped_out_details as $stepped_out_detail)
                    <div>
                      <i class="fas fa-walking bg-blue"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> {{ $stepped_out_detail->created_at->format('l jS F Y | h:i:s a') }} </span>
                        <h3 class="timeline-header"><a href="#"> {{ $stepped_out_detail->user->fullname }} </a> stepped out</h3>
      
                        <div class="timeline-body">
                         {{ $stepped_out_detail->reason }}

                         @if ($stepped_out_detail->status == "0")
                         <form action="{{ route('step.in', Auth::user()->id) }}" method="POST" class="" >
                          @method('PUT')
                          @csrf 
                          <input type="text" name="status" value="1" hidden>      
                          <button class="btn btn-dark btn-sm text-white" style="">Return</button>
                        
                      </form>
                      
                         @elseif($stepped_out_detail->status == "1")
                        <span class="time badge badge-success text-white "> Returned: <i class="fas fa-clock"></i> {{ $stepped_out_detail->updated_at->format('h:i:s a') }} </span>

                         @endif

                        </div>
                      
                      </div>
                    </div>
                    @endforeach
                    <!-- END timeline item -->
                
               
                </div>
                <!-- /.tab-pane -->
                {{ $stepped_out_details->links() }}
              </div>

              <div class=" tab-pane" id="to-do-list">
                <div class="row">
                
                  <div class="col-md-12">
                      <ul class="todo-list" data-widget="todo-list">

                        @foreach ($to_do_list as $to_do)
                        
                        <li>
                         
                            <!-- checkbox -->
                            <div  class="icheck-primary d-inline ml-2">
                              <input type="checkbox" value="" name="" id="{{ $to_do->id }}" {{ ($to_do->status == 1)? 'checked':'' }}>
                              {{-- <label for="{{ $to_do->id }}"></label> --}}
                            </div>
                            <!-- todo text -->
                            <span class="text">{{ $to_do->to_do_item }}</span>
                            <!-- Emphasis label -->
                            <small class="badge badge-secondary"><i class="far fa-clock"></i> {{ $to_do->created_at }}</small>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                             
                              <form action="{{ route('update.to_do', $to_do->id) }}" method="POST" style=" display:inline;">
                                  @method('PUT')
                                  @csrf 
                                  {{-- <input type="text" name="status" id="status" value="{{ ($to_do->status == 1)? '0':'1' }}" hidden> --}}
                                  <input type="text" name="status" id="status" value="{{ ($to_do->status == 1)? '0':'1' }}" hidden>
                                  <button class="btn"><i class="fas fa-{{ ($to_do->status == 1)? 'times':'check' }}"></i> </button>
                                
                              </form>
                              
                            </div>

                        </li>
                     
                        @endforeach
                      
                      </ul>
                  </div>
                 
            
                </div>
                {{ $to_do_list->links() }}
               
              </div>

              <div class=" tab-pane" id="details">
                <div class="row">
                  <div class="col-md-6">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Email Address:</b> <span class="time float-right"> {{ Auth::user()->email }}</span>
                      </li>
                      <li class="list-group-item">
                        <b>Member Since: </b> <span class="time float-right"> {{ Carbon\Carbon::parse(Auth::user()->member_since)->format('D jS, M Y') }}</span>
                      </li>
                      <li class="list-group-item">
                        <b>Office Hours: </b> <span class="time float-right"> {{ Carbon\Carbon::parse(Auth::user()->designation->time_in)->format('H:i a'). " - ". Carbon\Carbon::parse(Auth::user()->designation->time_out)->format('h:i a')}}</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Mobile Number:</b> <span class="time float-right"> {{ Auth::user()->mobile }}</span>
                      </li>
                      <li class="list-group-item">
                        <b>Gender: </b> <span class="time float-right"> {{ Auth::user()->gender}}</span>
                      </li>
                      <li class="list-group-item">
                        <b>Lateness Benchmark: </b> <span class="time float-right"> {{ Carbon\Carbon::parse(Auth::user()->designation->lateness_benchmark)->format('h:i a')}}</span>
                      </li>
                    </ul>
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
