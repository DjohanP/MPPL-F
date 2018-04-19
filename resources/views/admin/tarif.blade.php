@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Kelola Tarif Sewa Lapangan
@endsection
@section('dimana')
	<li class="active">Kelola Tarif Sewa Lapangan</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Data Tarif Sewa Lapangan Di ITS</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Lokasi</th>
							<th>Harga</th>
							<th>Action</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($lokasi)==0)
	              			<td>Tidak Ada Data</td>
	              		@else
	              			@foreach($lokasi as $x)
	              				<tr>
	              					<td>{{$x->nama_lokasi}}</td>
	              					<td>Rp. {{number_format($x->harga,0,".",'.')}},-</td>
	              					<td>
	              						<a class="btn btn-primary pull-left" style="margin-bottom: 10px" href="{{ url('/kelolatarif/edit/'.$x->id) }}" ><i class="fa fa-edit"></i>   Edit</a>
	              					</td>
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