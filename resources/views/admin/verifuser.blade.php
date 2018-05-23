@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Verif User
@endsection
@section('dimana')
	<li class="active">Verifikasi User</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">List User</h3>
			</div>
			<div class="box-body">
				<br>
				<br>
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Email</th>
							<th>Pekerjaan</th>
							<th>Nama Instansi</th>
							<th>Download KTP</th>
							<th>Action</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($usr)==0)
	              			<td>Tidak Ada Data</td>
	              		@else
	              			@foreach($usr as $x)
	              				<tr>
	              					<td>{{$x->name}}</td>
	              					<td>{{$x->email}}</td>
	              					<td>{{$x->pekerjaan}}</td>
	              					<td>{{$x->nama_instansi}}</td>
	              					<td><a href="{{url('/downktp/'.$x->id)}}" target="_blank"><span class="btn btn-info">Download KTP</span></a></td>
	              					<td>
		              					@if($x->verif==0)
		              						<a href="{{url('/verifauser/'.$x->id)}}"><span class="btn btn-success">Verifikasi</span></a>
		              					@else
		              						<a href="{{url('/verifbuser/'.$x->id)}}"><span class="btn btn-danger">Batalkan Verifikasi</span></a>
		              					@endif
	              					</td>
	              					{{-- <td>
	              						@if($x->status=="Aktif")
	              							<span class="label label-success">Aktif</span>
	              						@else
	              							<span class="label label-danger">Non Aktif</span>
	              						@endif
	              					</td>
	              					<td>
	              						<a class="btn btn-primary" style="margin-bottom: 10px" href="{{ url('/kelolalapangan/edit/'.$x->id) }}" ><i class="fa fa-edit"></i>   Edit</a>
	              						@if($x->status=="Aktif")
	              							<a class="btn btn-danger" style="margin-bottom: 10px" href="{{ url('/nonaktiflapangan/'.$x->id) }}" ><i class="fa fa-warning"></i>  Nonaktifkan</a>
	              						@else
	              							<a class="btn btn-success" style="margin-bottom: 10px" href="{{ url('/aktiflapangan/'.$x->id) }}" ><i class="fa fa-check"></i>   Aktifkan</a>
	              						@endif
	              					</td> --}}
	              				</tr>
	              			@endforeach
	              		@endif
	                </tbody>
	            </table>
	        </div>
		</div>
	</div>
@endsection
@section('addjs')
	<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
	<script>
  		$(function () {
    		$('#example1').DataTable()
  		})
	</script>
	<script type="text/javascript">
	    function hanyaAngka(evt) {
	        var charCode = (evt.which) ? evt.which : event.keyCode
	        if (charCode > 31 && (charCode < 48 || charCode > 57))return false;
	        return true;
	    }
	</script>
@endsection