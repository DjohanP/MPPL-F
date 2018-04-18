@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Edit Lapangan
@endsection
@section('dimana')
	<li class="active">Edit Lapangan</li>
@endsection
@section('content')
	<div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Edit Lapangan {{$lokasi->nama_lokasi}}</h3>
			</div>
			<form class="form-horizontal" method="post" action="{{url('/kelolalapangan/edit')}}">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama</label>

						<div class="col-sm-6">
							<input type="text" class="form-control" name="nama" value="{{$lokasi->nama_lokasi}}">
							<input type="hidden" name="id" value="{{$lokasi->id}}">
							{{csrf_field()}}
	                  	</div>
	                </div>
	            </div>
				<div class="box-footer">
					<a href="{{url('/kelolalapangan')}}"><button type="button" class="btn btn-default">Batal</button></a>
	                <button type="submit" class="btn btn-info pull-right">Simpan</button>
				</div>
			</form>
		</div>
	</div>
@endsection