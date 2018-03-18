<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('loginx');
        $this->middleware('admin')->only('admin');
        $this->middleware('penyewa')->only('penyewa');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role=='admin')
        {
            return redirect('/homeadmin');
        }
        elseif(Auth::user()->role=='penyewa')
        {
            return redirect('/homepenyewa');
        }
    }
    public function loginx(Request $r)
    {
        $usr=User::where('email',$r->email)->first();
        if($usr!=null)
        {
            if ( Auth::attempt(['email' => $r->email, 'password' => $r->password]) ) 
            {
                if($usr->role=='admin')
                {
                    return redirect('/homeadmin');
                }
                elseif($usr->role=='penyewa')
                {
                    return redirect('/homepenyewa');
                }
            }
        }
        return redirect('/login');
    }
    public function admin()
    {
        return view('admin.home');
    }
    public function penyewa()
    {
        return "penyewa";
    }
}
