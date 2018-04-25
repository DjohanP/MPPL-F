<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\lokasi;
use App\jadwal;
use App\transaksi;
use Storage;
use DB;
use Auth;
class PenyewaController extends Controller
{
	public function pesan()
	{
		$all_lapangan=lokasi::get();
		$all_transaksi=transaksi::where('user_id',Auth::user()->id)->get();
		return view('penyewa.pesan',compact('all_lapangan','all_transaksi'));
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

	private function isijadwal($mulai,$akhir,$tanggal,$lokasi)
	{
		$jdww="";
		$i=$mulai;
		while($i<$akhir)
		{
			$m=jadwal::where('lokasi_id',$lokasi)->where('tanggal',$tanggal)->where('jam',$i)->where('user_id',0)->first();
			if($jdww=="")
			{
				$jdww=$m->id;
			}
			else
			{
				$jdww=$jdww.",".$m->id;
			}
			$m->user_id=Auth::user()->id;
			$m->save();
			$i=strtotime($i)+60*60;
			$i=date('H:i', $i);
		}
		return $jdww;
	}

	public function addpesan(Request $r)
	{
		if($r->mulai>$r->akhir||$r->id_lokasi==null)
        {
            return redirect('/pemesanan');
        }
        $cekadajadwal=jadwal::where('tanggal',$r->tanggal)->where('lokasi_id',$r->id_lokasi)->count();
        if($cekadajadwal==0)
        {
        	//belum ada jadwal
        	return redirect('/pemesanan');
        }
		$mulai=substr($r->mulai,0,2).":00";
		$akhir=substr($r->akhir,0,2).":00";
		$cekk=$this->checkjadwal($mulai,$akhir,$r->tanggal,$r->id_lokasi);
		if($cekk==-1)//penuh
		{
			return redirect('/pemesanan');
		}
		else
		{
			$trans=new transaksi();
			$trans->lokasi_id=$r->id_lokasi;
			$trans->user_id=Auth::user()->id;
			$trans->status=0;
			$trans->file_upload=0;
			$trans->jadwal=$this->isijadwal($mulai,$akhir,$r->tanggal,$r->id_lokasi);//

			$trans->tgl_pinjam=$r->tanggal;
			$trans->mulai=$r->mulai;
			$trans->akhir=$r->akhir;
			$trans->durasi=(strtotime($akhir)-strtotime($mulai))/3600;
			$hrg=lokasi::where('id',$r->id_lokasi)->first();
			$trans->harga=$trans->durasi*$hrg->harga;
			$trans->save();
			return redirect('/pemesanan');
		}
	}

	public function upload($id)
	{
		return view('penyewa.upload',compact('id'));
	}

	public function saveupload(Request $r)
	{
		$validation = Validator::make($r->all(),[
            'filex' => 'required|mimes:pdf,png,jpg,jpeg|max:10120',
        ]);
        if($validation->fails())
        {
        	return redirect('/pemesanan');
        }
        else
        {
        	$fileName = Auth::user()->id.$r->id.'fdax_'.Input::file('filex')->getClientOriginalName();
        	$trans=transaksi::find($r->id);
        	$trans->file_upload=$fileName;
        	$trans->status=1;
        	$trans->save();
        	$destinationPath = storage_path('app/file');
        	Input::file('filex')->move($destinationPath, $fileName);
        	return redirect('/pemesanan');
        }
	}

	public function down($id)
    {
    	$fl=transaksi::where('id',$id)->first();
    	if($fl==null)
    	{
    		return redirect('/pemesanan');
    	}
    	else
    	{
    		$pth="app//file//".$fl->file_upload;
	        $path = storage_path($pth);
	        return response()->download($path);
    	}
    }

	public function lapangan()
	{
		return view('penyewa.lapangan');
	}
}