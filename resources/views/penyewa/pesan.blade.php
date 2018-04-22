@extends('penyewa.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Pemesanan
@endsection
@section('dimana')
	<li class="active">Pemesanan</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Data Pemesanan</h3>
			</div>
			<div class="box-body">
				<div class="text-right">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
						<i class="fa fa-plus"></i> Tambah Pemesanan
					</button>
				</div>
				<br>
				<br>
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>No Peminjaman</th>
							<th>Lapangan</th>
							<th>Jam Mulai</th>
							<th>Jam Akhir</th>
							<th>Harga</th>
							<th>Action</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	<tr>
	                		<td>1</td>
	                		<td>1</td>
	                		<td>1</td>
	                		<td>1</td>
	                		<td>1</td>
	                		<td>1</td>
	                	</tr>
	                </tbody>
	            </table>
	        </div>
		</div>
	</div>
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                	<h4 class="modal-title">Default Modal</h4>
              	</div>
              	<form method="post" action="{{url('/addpesan')}}">
	              	<div class="modal-body">
	                	<div class="form-group">
	                    	<label>Lokasi Lapangan</label>
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
	              	</div>
	              	<div class="modal-footer">
	                	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	                	<button type="submit" class="btn btn-primary">Save changes</button>
	              	</div>
              	</form>
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