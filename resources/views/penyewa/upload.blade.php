@extends('penyewa.master')
@section('judul')
	Upload Bukti Pembayaran
@endsection
@section('dimana')
	<li>Pemesanan</li>
	<li class="active">Bukti Pembayaran</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Upload</h3>
			</div>
			<div class="box-body">
				<form method="POST" action="{{url('/upload')}}" enctype="multipart/form-data">
					<input type="hidden" name="id"  value="{{$id}}">
					<input type="file" name="filex" accept=".pdf,.jpg,.jpeg,.png" required>
					<br>
					{{csrf_field()}}
					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
@endsection