@extends('layouts.master')
@section('pageTitle', 'Designations')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Designations</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Designations</li>
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
        <div class="col-md-3" style="">
            <div class="card card-dark" >
                <div class="card-header">
                <h3 class="card-title">{{ isset($designation_edit) ? 'Edit Designation' : 'Add Designation '}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action=" {{ isset($designation_edit) ? route('designation.update', $designation_edit->id) : url('designation')}}" method="POST">
                  @if (isset($designation_edit) )
                  @method('PUT')
                  @endif
                 
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digital Marketer" value="{{ isset($designation_edit) ?  $designation_edit->title : old('title')}}">
                    </div>
                    <div class="form-group">
                        <label for="time_in">Time In</label>
                        <input type="time" class="form-control" id="time_in" name="time_in" value="{{ isset($designation_edit) ?  $designation_edit->time_in : old('time_in')}}">
                    </div>
                    <div class="form-group">
                        <label for="time_out">Time Out</label>
                        <input type="time" class="form-control" id="time_out" name="time_out" value="{{ isset($designation_edit) ?  $designation_edit->time_out : old('time_out')}}">
                    </div> 
                    <div class="form-group">
                        <label for="lateness_benchmark">Lateness Benchmark</label>
                        <input type="time" class="form-control" id="lateness_benchmark" name="lateness_benchmark" value="{{ isset($designation_edit) ?  $designation_edit->lateness_benchmark : old('lateness_benchmark')}}">
                    </div>
                    
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-dark btn-sm">{{ isset($designation_edit) ?  'Update': 'Submit'}}</button>
                </div>
                </form>
            </div>
        </div>

        <div class="col-md-9" style="">
            <div class="card card-dark">
                <div class="card-header">
                  <h3 class="card-title">KJK Employees Designations</h3>
                </div>
                <!-- /.card-header -->
                @if(count($designations)>0)
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="table-data">
                      <thead>                  
                        <tr>
                          <th style="">#</th>
                          <th>Title</th>
                          <th>Schedule</th>
                          <th>Lateness Benchmark</th>
                          <th>Date | Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 0; ?>
                    @foreach($designations as $designation)
                    <?php $i++; ?>
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$designation->title}}</td>
                          <td>{{$designation->time_in .' - '. $designation->time_out}}</td>
                          <td>{{$designation->lateness_benchmark}}</td>
                          <td>{{$designation->updated_at->format('M d, Y | h:i A')}}</td>
                          <td>
                            <a href="{{ route('designation.edit', $designation->id) }}" class="btn btn-dark btn-sm">Edit</a>
                          </td>
                        
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                @else
                    <h3 class="text-center">No Designation to render</h3>
                @endif
               
               
              </div>
        </div>

      </div>
   
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection
