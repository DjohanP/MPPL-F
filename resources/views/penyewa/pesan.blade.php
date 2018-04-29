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
							<th width="10%">No Peminjaman</th>
							<th width="15%">Lapangan</th>
							<th width="15%">Tanggal</th>
							<th width="10%">Jam Mulai</th>
							<th width="10%">Jam Akhir</th>
							<th width="6%">Durasi</th>
							<th>Harga</th>
							<th>Status</th>
							<th>Action</th>
	                	</tr>
	                </thead>
	                <tbody>
	                	@if(count($all_transaksi)!=0)
	                		@foreach($all_transaksi as $x)
	                			<tr>
	                				<td width="10%">{{$x->id}}</td>
	                				<td width="15%">{{App\lokasi::find($x->lokasi_id)->nama_lokasi}}</td>
	                				<td width="10%">{{date("d-m-Y",strtotime($x->tgl_pinjam))}}</td>
	                				<td width="10%">{{$x->mulai}}</td>
	                				<td width="10%">{{$x->akhir}}</td>
	                				<td width="6%">{{$x->durasi}}</td>
	                				<td>Rp. {{number_format($x->harga,0,".",'.')}},-</td>
	                				<td>
	                					@if($x->status==0)
	                						<span class="label label-danger">Belum Upload Bukti Pembayaran</span>
	                					@elseif($x->status==1)
	                						<span class="label label-primary">Menunggu Persetujuan Admin</span>
	                					@elseif($x->status==2)
	                						<span class="label label-info">Pembayaran Diterima Admin</span>
	                					@elseif($x->status==3)
	                						<span class="label label-warning">Belum Mengisi Kritik dan Saran</span>
	                					@elseif($x->status==4)
	                						<span class="label label-success">Selesai</span>
	                					@endif
	                				</td>
	                				<td>
	                					@if($x->status==0)
	                						<a href="{{url('/upload/'.$x->id)}}"><button class="btn btn-primary">Upload Bukti Pembayaran</button></a>
	                					@elseif($x->status==1)
	                						<a href="{{url('/upload/'.$x->id)}}"><button class="btn btn-primary">Upload Bukti Pembayaran</button></a>
	                						<br><br>
	                						<a href="{{url('/download/'.$x->id)}}"><button class="btn btn-success">Download Bukti Pembayaran</button></a>
	                					@elseif($x->status==2)
	                						<a href="{{url('/notatransaksi/'.$x->id)}}" target="_blank"><button class="btn btn-success">Download Nota Transaksi</button></a>
	                					@elseif($x->status==3)
	                						<a href=""><button>Mengisi Kritik dan Saran</button></a>
	                						<a href=""><button>Download Nota Transaksi</button></a>
	                					@elseif($x->status==4)
	                						<a href=""><button>Download Nota Transaksi</button></a>
	                					@endif
	                				</td>
	                			</tr>
	                		@endforeach
	                	@else

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