@extends('admin.master')
@section('judul')
	Kritik dan Saran
@endsection
@section('dimana')
	<li class="active">Kritik dan Saran</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Kritik dan Saran</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Lokasi</th>
							<th>Isi Transaksi</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($kritiksaran)==0)
	              			<td>Tidak Ada Data</td>
	              		@else
	              			@foreach($kritiksaran as $x)
	              				<tr>
	              					<td>{{App\lokasi::find($x->lokasi_id)->nama_lokasi}}</td>
	              					<td>{{$x->isi}}</td>
	              				</tr>
	              			@endforeach
	              		@endif
	                </tbody>
	            </table>
	        </div>
		</div>
	</div>
@endsection