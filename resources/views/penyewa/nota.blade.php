<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
	<style>
        .card {
            width: 94%;
            height: 96%;
            margin: auto;
        }

        hr {
            display: block;
            height: 2px;
            border: 0;
            border-top: 3px solid black;
            padding: 0;
        }
        .offset-9 {
            margin-left: 65%;
        }
        .col-md-6 {
          float: left;
          width: 50%;
        }

        .text-center {
          text-align: center;
        }

        .ttd p {
          margin-top: 0px;
          margin-bottom: 0px;
        }

        table, th {
            text-align: center;
        }

        td {
            text-align: left;
            font-size: 12pt;
        }

        thead {
            border-bottom: 2px solid black;
        }

        tbody tr {
            align-content: center;
        }

        th h1 {
            margin: 0;
            font-weight: normal;
        }

        #th1 {
            font-size: 13pt;
        }

        #th2 {
            font-size: 17pt;
            font-weight: bold;
        }

        #th3 {
            font-size: 12pt;
            margin-bottom: 10px
        }

        h3 {
            text-align: center;
            margin-bottom: 7px;
            padding-top: 15px;
        }

        .difTable {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        .difTD, .difTH {
            border: 1px solid black;
            text-align: center;
            height: 25px;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
	<div class="card">
		<table style="text-align: center" width="100%">
	        <thead>
	            <tr>
	                <th><img class="pict" src="{{asset('Badge_ITS.png')}}" width="80px"></th>
	                <th>
	                    <h1 id="th2">UPT Fasilitas Olahraga ITS</h1>
                    	<h1 id="th3"> Jl. ITS Raya, Keputih, Sukolilo, Kota SBY, Jawa Timur 60117</h1>
	                </th>
	                <th><img class="pict" src="" height="85"></th>
	            </tr>
	        </thead>
	    </table>
	    <hr style="color:black; height: 2px; margin-bottom:15px;"/>
	    <div style="page-break-inside: avoid;">
	      	<div class="text-center">
	        	<p style="margin-top: 10px">Nomor Transaksi : {{$transaksi->id}}</p>
	      	</div>
	    </div>
	    <table class="difTable">
	        <tbody>
	        	<tr>
	                <td class="difTD"><b>Nama Peminjam</b></td>
	                <td class="difTD">{{Auth::user()->name}}</td>
	            </tr>
	            <tr>
	                <td class="difTD"><b>Lapangan</b></td>
	                <td class="difTD">{{App\lokasi::find($transaksi->lokasi_id)->nama_lokasi}}</td>
	            </tr>
	            <tr>
	                <td class="difTD"><b>Tanggal Pinjam</b></td>
	                <td class="difTD">{{date("d-m-Y",strtotime($transaksi->tgl_pinjam))}}</td>
	            </tr>
	            <tr>
	                <td class="difTD"><b>Jam Mulai</b></td>
	                <td class="difTD">{{$transaksi->mulai}}</td>
	            </tr>
	            <tr>
	                <td class="difTD"><b>Jam Akhir</b></td>
	                <td class="difTD">{{$transaksi->akhir}}</td>
	            </tr>
	            <tr>
	                <td class="difTD"><b>Durasi</b></td>
	                <td class="difTD">{{$transaksi->durasi}}</td>
	            </tr>
	            <tr>
	                <td class="difTD"><b>Harga</b></td>
	                <td class="difTD">Rp. {{number_format($transaksi->harga,0,".",'.')}},-</td>
	            </tr>
	        </tbody>
	    </table>
	</div>
</body>
<script type="text/javascript">
    function openWin()
    {
      window.print();
      window.close();
    }
    window.onload = openWin;
</script>
</html>