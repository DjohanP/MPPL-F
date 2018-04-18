@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Edit Tarif Sewa Lapangan
@endsection
@section('dimana')
	<li class="active">Edit Tarif Sewa Lapangan</li>
@endsection
@section('content')
	<div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Edit Tarif Sewa Lapangan {{$lokasi->nama_lokasi}}</h3>
			</div>
			<form class="form-horizontal" method="post" action="{{url('/kelolatarif/edit')}}">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Harga</label>

						<div class="col-sm-6">
							<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="harga" value="{{$lokasi->harga}}">
							<input type="hidden" name="id" value="{{$lokasi->id}}">
							{{csrf_field()}}
	                  	</div>
	                </div>
	            </div>
				<div class="box-footer">
					<a href="{{url('kelolatarif')}}"><button type="button" class="btn btn-default">Batal</button></a>
	                <button type="submit" class="btn btn-info pull-right">Simpan</button>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('addjs')
	<script type="text/javascript">
	    function hanyaAngka(evt) {
	        var charCode = (evt.which) ? evt.which : event.keyCode
	        if (charCode > 31 && (charCode < 48 || charCode > 57))return false;
	        return true;
	    }
	</script>
@endsection