@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Aktivitas Penyewaan
@endsection
@section('dimana')
	<li class="active">Aktivitas Penyewaan</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Rekap Aktivitas Penyewaan</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Nomor Transaksi</th>
							<th>Lokasi</th>
							<th>Tanggal</th>
							<th>Waktu</th>
							<th>Durasi</th>
							<th>Status</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($all_transaksi)==0)
	                		<td>Tidak Ada Data</td>
	                	@else
	                		@foreach($all_transaksi as $x)
	                			<tr>
	                				<td>{{$x->id}}</td>
	                				<td>{{App\lokasi::find($x->lokasi_id)->nama_lokasi}}</td>
	                				<td>{{date("d-m-Y",strtotime($x->tgl_pinjam))}}</td>
	                				<td>{{$x->mulai}} - {{$x->akhir}}</td>
	                				<td>{{$x->durasi}}</td>
	                				<td>
	                					@if($x->status==0)
	                						<span class="label label-danger">Belum Upload Bukti Pembayaran</span>
	                					@elseif($x->status==1)
	                						<span class="label label-primary">Menunggu Persetujuan Admin</span>
	                					@elseif($x->status==2)
	                						<span class="label label-info">Pembayaran Diterima Admin</span>
	                					@elseif($x->status==3)
	                						<span class="label label-warning">Belum Mengisi Kritik dan Saran</span>
	                					@elseif($x->status==4)
	                						<span class="label label-success">Selesai</span>
	                					@endif
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