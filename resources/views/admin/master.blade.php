<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISFOR</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  @yield('addcss')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="{{url('/homeadmin')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>F</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SISFOR</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{Auth::user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                  <p>
                    {{Auth::user()->name}}
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{Auth::user()->name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div> 
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li @if(Request::is('homeadmin')) class="active"@endif>
            <a href="{{url('/homeadmin')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li @if(Request::is('verifuser')) class="active"@endif>
            <a href="{{url('/verifuser')}}">
              <i class="fa fa-user"></i> <span>Verifikasi User</span>
            </a>
          </li>
          <li @if(Request::is('kelolalapangan')) class="active" @endif>
            <a href="{{url('/kelolalapangan')}}">
              <i class="fa  fa-edit"></i> <span>Kelola Lapangan</span>
            </a>
          </li>
          <li @if(Request::is('kelolatarif')) class="active" @endif>
            <a href="{{url('/kelolatarif')}}">
              <i class="fa fa fa-eye"></i> <span>Kelola Tarif Sewa Lapangan</span>
            </a>
          </li>
          {{-- <li @if(Request::is('kelolajadwal')) class="active" @endif>
            <a href="{{url('/kelolajadwal')}}">
              <i class="fa fa-calendar-check-o"></i> <span>Kelola Jadwal</span>
            </a>
          </li> --}}
          <li @if(Request::is('verifpembayaran')||Request::is('addsewa')) class="treeview active" @else class="treeview" @endif>
            <a href="#">
              <i class="fa fa-money"></i> <span>Pembayaran</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu ">
              <li @if(Request::is('verifpembayaran')) class="active" @endif><a href="{{url('/verifpembayaran')}}"><i class="fa fa-circle-o"></i> Verifikasi Transaksi</a></li>
              <li @if(Request::is('addsewa')) class="active" @endif><a href="{{url('/addsewa')}}"><i class="fa fa-circle-o"></i> Tambah Transaksi Penyewaan</a></li>
            </ul>
          </li>
          <li @if(Request::is('pendapatan')||Request::is('kritiksaranad')||Request::is('logaktivitas')) class="treeview active" @else class="treeview" @endif>
            <a href="#">
              <i class="fa fa-balance-scale"></i> <span>Keuangan dan Aktivitas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li @if(Request::is('pendapatan')) class="active" @endif><a href="{{url('/pendapatan')}}"><i class="fa fa-circle-o"></i> Pendapatan</a></li>
              <li @if(Request::is('kritiksaranad')) class="active" @endif><a href="{{url('/kritiksaranad')}}"><i class="fa fa-circle-o"></i> Kritik dan Saran</a></li>
              <li @if(Request::is('logaktivitas')) class="active" @endif><a href="{{url('/logaktivitas')}}"><i class="fa fa-circle-o"></i> Aktivitas Penyewaan</a></li>
            </ul>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('judul')
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/homeadmin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          @yield('dimana')
          {{-- <li class="active">Dashboard</li> --}}
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        @yield('content')
        <!-- Info boxes -->
        {{-- <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">90<small>%</small></span>
              </div> --}}
              <!-- /.info-box-content -->
            {{-- </div> --}}
            <!-- /.info-box -->
          {{-- </div> --}}
          <!-- /.col -->
          <!-- fix for small devices only -->
          {{-- <div class="clearfix visible-sm-block"></div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
              </div> --}}
              <!-- /.info-box-content -->
            {{-- </div> --}}
            <!-- /.info-box -->
          {{-- </div> --}}
        {{-- </div> --}}
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; {{date('Y')}}</strong> All rights
        reserved.
    </footer>
  </div>

  <!-- jQuery 3 -->
  <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <!-- jvectormap  -->
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  {{-- <script src="{{asset('dist/js/pages/dashboard2.js')}}"></script> --}}
  <!-- AdminLTE for demo purposes -->
  {{-- <script src="{{asset('dist/js/demo.js')}}"></script> --}}
  @yield('addjs')
</body>
</html>
