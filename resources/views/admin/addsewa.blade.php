@extends('admin.master')
@section('judul')
	Tambah Penyewaan
@endsection
@section('dimana')
	<li>Pemesanan</li>
	<li class="active">Tambah Penyewaan</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Form Tambah Penyewaan</h3>
			</div>
			<div class="box-body">
				<form method="POST" action="{{url('/addsewa')}}" role="form">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama</label>
							<input class="form-control" type="text" name="nama" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">No Identitas</label>
							<input class="form-control" onkeypress="return hanyaAngka(event)" type="text" name="id" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Pekerjaan</label>
							<input class="form-control" type="text" name="pekerjaan" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Instansi</label>
							<input class="form-control" type="text" name="instansi" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input class="form-control" type="email" name="email" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Lapangan</label>
							<select class="form-control" name="id_lokasi" required>
			                	@foreach($all_lapangan as $x)
		                			<option value="{{$x->id}}">{{$x->nama_lokasi}}</option>
		                		@endforeach
		                	</select>
	                	</div>
	                	<div class="form-group">
	                    	<label>Tanggal Peminjaman</label>
	                    	<input type="date" name="tanggal" class="form-control" required>
	                  	</div>
	                  	<div class="form-group">
	                    	<label>Jam Mulai</label>
	                    	<input type="time" name="mulai" class="form-control" required>
	                  	</div>
	                  	<div class="form-group">
	                    	<label>Jam Akhir</label>
	                    	<input type="time" name="akhir" class="form-control" required>
	                  	</div>
	                  	{{csrf_field()}}
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div>
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