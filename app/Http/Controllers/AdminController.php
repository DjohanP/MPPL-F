<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lokasi;
use App\jadwal;
use App\transaksi;
use DB;
class AdminController extends Controller
{
    //
    public function lapangan()
    {
    	$lokasi=lokasi::get();
    	return view('admin.lapangan',compact('lokasi'));
    }

    public function addlapangan(Request $r)
    {
    	$lok=new lokasi();
    	$lok->nama_lokasi=$r->nama;
    	$lok->harga=$r->harga;
    	$lok->status="Aktif";
    	$lok->save();
    	return redirect('/kelolalapangan');
    }

    public function view_edit_lapangan($id)
    {
        $lokasi=lokasi::where('id',$id)->where('status','Aktif')->first();
        if($lokasi==null)
        {
            return redirect('/kelolalapangan');
        }
        else
        {
            return view('admin.editlapangan',compact('lokasi'));
        }
    }

    public function save_edit_lapangan(Request $r)
    {
        $lok=lokasi::find($r->id);
        $lok->nama_lokasi=$r->nama;
        $lok->save();
        return redirect('/kelolalapangan');
    }

    public function nonaktiflapangan($id)
    {
    	$lok=lokasi::find($id);
    	$lok->status="Non Aktif";
    	$lok->save();
    	return redirect('/kelolalapangan');
    }

    public function aktiflapangan($id)
    {
    	$lok=lokasi::find($id);
    	$lok->status="Aktif";
    	$lok->save();
    	return redirect('/kelolalapangan');
    }

    public function tarif()
    {
        $lokasi=lokasi::where('status','Aktif')->get();
        return view('admin.tarif',compact('lokasi'));
    }

    public function view_edit_tarif($id)
    {
        $lokasi=lokasi::where('id',$id)->where('status','Aktif')->first();
        if($lokasi==null)
        {
            return redirect('/kelolatarif');
        }
        else
        {
            return view('admin.edittarif',compact('lokasi'));
        }
    }

    public function save_edit_tarif(Request $r)
    {
        $lok=lokasi::find($r->id);
        $lok->harga=$r->harga;
        $lok->save();
        return redirect('/kelolatarif');
    }

    public function jadwal()
    {
        $all_lokasi=lokasi::where('status','Aktif')->get();
         //->select(DB::raw('count(*) as user_count, status'))
        $all_jadwal=jadwal::select('lokasi_id','tanggal',DB::raw('count(*)'),DB::raw('min(jam) as mulai'),DB::raw('max(jam) as akhir'))->groupBy('tanggal','lokasi_id')->get();
        //return $all_jadwal;
        return view('admin.jadwal',compact('all_lokasi','all_jadwal'));
    }

    public function addjadwal(Request $r)
    {
        if($r->lokasi_lapangan==-1||$r->mulai>$r->akhir||$r->lokasi_lapangan==null)
        {
            return redirect('/kelolajadwal');
        }
        else
        {
            DB::table('jadwals')->where('tanggal',$r->tanggal)->where('lokasi_id',$r->lokasi_lapangan)->delete();
            $mulai=substr($r->mulai,0,2).":00";
            $akhir=substr($r->akhir,0,2).":00";
            $i=$mulai;
            while($i<=$akhir)
            {
                $jadwal=new jadwal();
                $jadwal->lokasi_id=$r->lokasi_lapangan;
                $jadwal->tanggal=$r->tanggal;
                $jadwal->user_id=0;
                $jadwal->status=1000;
                $jadwal->jam=$i;
                $jadwal->save();
                //echo $i."\n";
                if($i=="23:00")
                {
                    break;
                    return redirect('/kelolajadwal');
                }
                $i=strtotime($i)+60*60;
                $i=date('H:i', $i);
            }
            return redirect('/kelolajadwal');
        }
    }

    public function verif()
    {
        $all_transaksi=transaksi::get();
        return view('admin.verif',compact('all_transaksi'));
    }

    public function download($id)
    {
        $fl=transaksi::where('id',$id)->first();
        if($fl==null)
        {
            return redirect('/verifpembayaran');
        }
        else
        {
            $pth="app//file//".$fl->file_upload;
            $path = storage_path($pth);
            return response()->download($path);
        }
    }

    public function verirf($id)
    {
        $all_transaksi=transaksi::where('id',$id)->first();
        $all_transaksi->status=2;
        $all_transaksi->save();
        $ss=explode(",", $all_transaksi->jadwal);
        foreach ($ss as $sy) {
            $jadwal=jadwal::where('id',$sy)->first();
            $jadwal->status=2;
            $jadwal->save();
        }
        return redirect('/verifpembayaran');
    }

    public function regis($id)
    {
        $all_transaksi=transaksi::where('id',$id)->first();
        $all_transaksi->status=3;
        $all_transaksi->save();
        $ss=explode(",", $all_transaksi->jadwal);
        foreach ($ss as $sy) {
            $jadwal=jadwal::where('id',$sy)->first();
            $jadwal->status=3;
            $jadwal->save();
        }
        return redirect('/verifpembayaran');
    }
}