<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
        $this->middleware('auth')->except('loginx','registerx');
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

    public function registerx(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'email' => 'required|unique:users,email',
            'id' => 'required|numeric',
            'password' => 'required|same:password_confirmation|confirmed|min:8',
        ]);
        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        else
        {
            $usr=new User();
            $usr->name=$r->nama;
            $usr->no_identitas=$r->id;
            $usr->pekerjaan=$r->pekerjaan;
            $usr->nama_instansi=$r->instansi;
            $usr->email=$r->email;
            $usr->role="penyewa";
            $usr->password=bcrypt($r->password);
            $usr->save();
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
        //return $r;
    }

    public function admin()
    {
        return view('admin.home');
    }
    public function penyewa()
    {
        return view('penyewa.home');
    }
}
