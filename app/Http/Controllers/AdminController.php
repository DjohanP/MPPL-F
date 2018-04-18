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
}
