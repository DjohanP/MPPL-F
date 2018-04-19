@extends('admin.master')
@section('addcss')
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('judul')
	Kelola Lapangan
@endsection
@section('dimana')
	<li class="active">Kelola Lapangan</li>
@endsection
@section('content')
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Data Lapangan Di ITS</h3>
			</div>
			<div class="box-body">
				<div class="text-right">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
						<i class="fa fa-plus"></i> Tambah Lapangan
					</button>
				</div>
				<br>
				<br>
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Lokasi</th>
							<th>Status</th>
							<th>Action</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($lokasi)==0)
	              			<td>Tidak Ada Data</td>
	              		@else
	              			@foreach($lokasi as $x)
	              				<tr>
	              					<td>{{$x->nama_lokasi}}</td>
	              					<td>
	              						@if($x->status=="Aktif")
	              							<span class="label label-success">Aktif</span>
	              						@else
	              							<span class="label label-danger">Non Aktif</span>
	              						@endif
	              					</td>
	              					<td>
	              						<a class="btn btn-primary" style="margin-bottom: 10px" href="{{ url('/kelolalapangan/edit/'.$x->id) }}" ><i class="fa fa-edit"></i>   Edit</a>
	              						@if($x->status=="Aktif")
	              							<a class="btn btn-danger" style="margin-bottom: 10px" href="{{ url('/nonaktiflapangan/'.$x->id) }}" ><i class="fa fa-warning"></i>  Nonaktifkan</a>
	              						@else
	              							<a class="btn btn-success" style="margin-bottom: 10px" href="{{ url('/aktiflapangan/'.$x->id) }}" ><i class="fa fa-check"></i>   Aktifkan</a>
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
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                	<h4 class="modal-title">Default Modal</h4>
              	</div>
              	<form method="post" action="{{url('/kelolalapangan')}}">
	              	<div class="modal-body">
	                	<div class="form-group">
	                    	<label>Lokasi Lapangan</label>
	                      	<input type="text" class="form-control" name="nama" required />
	                  	</div>
	                  	<div class="form-group">
	                    	<label>Harga Sewa Lapangan per Jam</label>
	                      	<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="harga" required />
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