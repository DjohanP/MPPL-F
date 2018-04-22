<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lokasi;
use App\jadwal;
use App\transaksi;
use DB;
class PenyewaController extends Controller
{
	public function pesan()
	{
		$all_lapangan=lokasi::get();
		return view('penyewa.pesan',compact('all_lapangan'));
	}

	private function checkjadwal($mulai,$akhir,$tanggal,$lokasi)
	{
		$i=$mulai;
		while($i<$akhir)
		{
			$m=jadwal::where('lokasi_id',$lokasi)->where('tanggal',$tanggal)->where('jam',$i)->where('user_id',0)->count();
			if($m==0)
			{
				return -1;
			}
			$i=strtotime($i)+60*60;
			$i=date('H:i', $i);
		}
		return 1;
	}

	public function addpesan(Request $r)
	{
		return $r;
		if($r->mulai>$r->akhir||$r->lokasi_lapangan==null)
        {
            return redirect('/pemesanan');
        }
		$mulai=substr($r->mulai,0,2).":00";
		$akhir=substr($r->akhir,0,2).":00";
		$cekk=$this->checkjadwal($mulai,$akhir,$r->tanggal,$r->id_lokasi);
		if($cekk==-1)
		{
			return redirect('/pemesanan');
		}
		else
		{
			$trans=new transaksi();
			$trans->lokasi_id=$r->id_lokasi;
			$trans->user_id=Auth::user()->id;
			$trans->status=0;
			$trans->jadwal="";//
			$trans->tgl_pinjam=$r->tanggal;
			$trans->mulai=$r->mulai;
			$trans->akhir=$r->akhir;
			$trans->durasi=9;
			$trans->harga=8;
			//return redirect('/pemesanan');
		}
	}

	public function lapangan()
	{
		return view('penyewa.lapangan');
	}
}