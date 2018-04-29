@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Pendapatan
@endsection
@section('dimana')
	<li class="active">Pendapatan</li>
@endsection
@section('content')
	<div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          	<div class="info-box">
            	<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
				<div class="info-box-content">
              		<span class="info-box-text">Pendapatan
              			@if($per==-1)
              				Keseluruhan
              			@else
              				{{date("M Y",strtotime($per))}}
              			@endif
              		</span>
              		<span class="info-box-number">Rp. {{number_format($countx,0,".",'.')}},-</span>
            	</div>
          	</div>
        </div>
	</div>
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Pendapatan</h3>
			</div>
			<div class="box-body">
				<form method="POST" action="{{url('/pendapatan')}}">
					<select name="bulan">
						<option value="-1" @if($per==-1) selected @endif>All</option>
						<option value="2018-04" @if($per=="2018-04") selected @endif>April 2018</option>
						<option value="2018-05" @if($per=="2018-05") selected @endif>Mei 2018</option>
						<option value="2018-06" @if($per=="2018-06") selected @endif>Juni 2018</option>
						<option value="2018-07" @if($per=="2018-07") selected @endif>Juli 2018</option>
						<option value="2018-08" @if($per=="2018-08") selected @endif>Agustus 2018</option>
						<option value="2018-09" @if($per=="2018-09") selected @endif>September 2018</option>
						<option value="2018-10" @if($per=="2018-10") selected @endif>Oktober 2018</option>
						<option value="2018-11" @if($per=="2018-11") selected @endif>Nopember 2018</option>
						<option value="2018-12" @if($per=="2018-12") selected @endif>Desember 2018</option>
					</select>
					{{csrf_field()}}
					<button type="submit" class="btn btn-success">Filter</button>
				</form>
				<br><br>
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Nomor Transaksi</th>
							<th>Lokasi</th>
							<th>Tanggal</th>
							<th>Harga</th>
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
	                				<td>{{$x->harga}}</td>
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