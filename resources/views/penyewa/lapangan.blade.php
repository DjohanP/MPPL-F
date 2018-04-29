@extends('penyewa.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Lapangan
@endsection
@section('dimana')
	<li class="active">Lapangan</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Harga Sewa Lapangan per Jam</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Lokasi</th>
							<th>Harga</th>
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
	                			</tr>
	                		@endforeach
	                	@endif
	                </tbody>
	            </table>
	        </div>
		</div>
	</div>
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Jadwal yang Tersedia</h3>
			</div>
			<div class="box-body">
				<table id="example2" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Lokasi</th>
							<th>Tanggal</th>
							<th>Waktu</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($jadwal)==0)
	                		<td>Tidak Ada Data</td>
	                	@else
	                		@foreach($jadwal as $x)
	                			<tr>
	                				<td>{{App\lokasi::find($x->lokasi_id)->nama_lokasi}}</td>
	                				<td>{{date("d-m-Y",strtotime($x->tanggal))}}</td>
	                				<td>{{date("H:i",strtotime($x->jam))}} - {{date("H:i",strtotime($x->jam)+3600)}}</td>
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
    		$('#example1').DataTable(),
    		$('#example2').DataTable()
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