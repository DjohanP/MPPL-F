@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Tambah Jadwal Lapangan
@endsection
@section('dimana')
	<li class="active">Tambah Jadwal Lapangan</li>
@endsection
@section('content')
	<div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tambah Jadwal Lapangan {{$lokasi->nama_lokasi}}</h3>
			</div>
			<form class="form-horizontal" method="post" action="{{url('/kelolatarifbul')}}">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Bulan</label>

						<div class="col-sm-6">
							<select class="form-control" name="bulan">
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">Nopember</option>
								<option value="12">Desember</option>
							</select>
							<input type="hidden" name="id" value="{{$lokasi->id}}">
							{{csrf_field()}}
	                  	</div>
	                </div>
	                <div class="form-group">
						<label class="col-sm-2 control-label">Tahun</label>
						<div class="col-sm-6">
							<select class="form-control" name="tahun">
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
							</select>
						</div>
					</div>
	            </div>

				<div class="box-footer">
					<a href="{{url('kelolalapangan')}}"><button type="button" class="btn btn-default">Batal</button></a>
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