@extends('penyewa.master')
@section('judul')
	Kritik dan Saran
@endsection
@section('dimana')
	<li>Pemesanan</li>
	<li class="active">Kritik dan Saran</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Form Kritik dan Saran</h3>
			</div>
			<div class="box-body">
				<form method="POST" action="{{url('/kritiksaran')}}">
					<input type="hidden" name="id"  value="{{$id}}">
					<textarea class="form-control" rows="3" name="kritiksaranx" required placeholder="Tuliskan Kritik dan Saran Anda"></textarea>
					<br>
					<br>
					{{csrf_field()}}
					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
@endsection