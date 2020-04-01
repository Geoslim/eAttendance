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
                  src="storage/{{Auth::user()->profile_image}}"
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
                <input type="checkbox" name="status" {{(Auth::user()->status == 'Signed In') ? 'checked' : ''}} data-toggle="toggle" data-on="Signed In" data-off="Signed Out" data-onstyle="success" data-offstyle="warning" class="text-white">      
                <button class="btn btn-dark float-right">Enter</button>
              
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
                <p>Check Tab for details </p>
                
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
                         <a class="btn btn-dark btn-sm text-white" style="">Return</a>
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
