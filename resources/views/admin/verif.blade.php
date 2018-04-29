@extends('admin.master')
@section('judul')
	Verifikasi Pembayaran
@endsection
@section('dimana')
	<li class="active">Verifikasi Pembayaran</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Data Pemesanan Lapangan</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>No Transaksi</th>
							<th>Nama Peminjam</th>
							<th>Lokasi</th>
							<th>Tanggal</th>
							<th>Waktu</th>
							<th>Durasi</th>
							<th>Harga</th>
							<th>Status</th>
							<th>Action</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($all_transaksi)==0)
	              			<td>Tidak Ada Data</td>
	              		@else
	              			@foreach($all_transaksi as $x)
	              				<tr>
	              					<td>{{$x->id}}</td>
	              					<td>{{App\User::find($x->user_id)->name}}</td>
	              					<td>{{App\lokasi::find($x->lokasi_id)->nama_lokasi}}</td>
	              					<td>{{$x->tgl_pinjam}}</td>
	              					<td>{{$x->mulai}} - {{$x->akhir}}</td>
	              					<td>{{$x->durasi}}</td>
	              					<td>Rp. {{number_format($x->harga,0,".",'.')}},-</td>
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
	              					<td>
	              						@if($x->status==1)
		              						<a href="{{url('/downloadad/'.$x->id)}}"><button class="btn btn-success">Download Bukti Pembayaran</button></a>
		              						<br><br>
		              						<a class="btn btn-primary pull-left" style="margin-bottom: 10px" href="{{ url('/verifpembayarann/'.$x->id) }}" ><i class="fa fa-edit"></i>  Verifikasi</a>
		              					@elseif($x->status==2)
		              						<a class="btn btn-primary pull-left" style="margin-bottom: 10px" href="{{ url('/regisulang/'.$x->id) }}" ><i class="fa fa-edit"></i>  Regis Ulang</a>
		              					@else
		              						No Action
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