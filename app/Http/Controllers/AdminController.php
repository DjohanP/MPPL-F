<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lokasi;
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
}