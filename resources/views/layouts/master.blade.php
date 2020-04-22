<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Attendance | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="{{ asset('bootstrap-toggle-master/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}"></script>
  <style>
    .timeline>div>.timeline-item>.timeline-header {
    font-size: 12px;
    padding: 10px;
}
.pulsate{
  padding:3%;
  display: block;
  animation: blink 2s ease infinite;
  /* border-radius: 50%; */
  border: 4px double lighten(black, 20%);
}


  @keyframes blink{
0%{opacity: .3;}
50%{opacity: .7;}
100%{opacity: 1;}

}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include('sweet::alert')
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <iframe src="http://free.timeanddate.com/clock/i76c2m26/n125/fn9/tt0/tw1/tm1/ts1" frameborder="0" width="238" height="19"></iframe>

      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      {{-- <img src="" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">e - attendance</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('storage/'. Auth::user()->profile_image)  }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->fullname }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('admin-only', auth()->user())
          <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          @endcan
          @can('admin-only', auth()->user())
          <li class="nav-item">
            <a href="{{ url('general-attendance') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  General Attendance
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          @endcan
          @can('staff-only', auth()->user())
          <li class="nav-item">
            <a href="{{ url('staff-dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-thumbs-up"></i>
              <p>
                Employee Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          @endcan

          @can('admin-only', auth()->user())
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Manage Employees
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('add-employee') }}" class="nav-link ">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('all-employees') }}" class="nav-link ">
                    <i class="fa fa-users nav-icon"></i>
                    <p>All Employees</p>
                  </a>
              </li>
            </ul>
          </li>
          @endcan
          @can('admin-only', auth()->user())
          <li class="nav-item">
            <a href="{{ url('designations') }}" class="nav-link">
                <i class="nav-icon fas fa-scroll"></i>
                <p>
                  Designations
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          @endcan
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Log Out
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
           

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
          </li>
       
        
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if (!url('add-employee'))
    @include('includes.messages')
    @endif
    
    @yield('content') 
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">KJK Africa</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/
/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{ asset('bootstrap-toggle-master/js/bootstrap-toggle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>

 $(function () {
    $("#table-data").DataTable();
   
  });
</script>

<script>
$("input[data-bootstrap-switch]").each(function(){
    on: 'Signed In',
      off:'Signed Out',
      $(this).bootstrapSwitch('state', $(this).prop('checked')
     
      );
    });

   
</script>

</body>
</html>
