<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
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
        $usr=User::where('email',$r->email)->where('verif',1)->first();
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
            'filex' => 'required|mimes:pdf,png,jpg,jpeg|max:1000',
        ]);
        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        else
        {
            $extension = Input::file('filex')->getClientOriginalExtension();
            $now = date("d-M-Y H:i:s", strtotime('+5 hours'));
            $now=str_replace(":","_","$now");
            $fileName = '_'.$now.Input::file('filex')->getClientOriginalName();
            $usr=new User();
            $usr->name=$r->nama;
            $usr->no_identitas=$r->id;
            $usr->pekerjaan=$r->pekerjaan;
            $usr->nama_instansi=$r->instansi;
            $usr->email=$r->email;
            $usr->ktp=$fileName;
            $usr->role="penyewa";
            $usr->verif=0;
            $usr->password=bcrypt($r->password);
            $usr->save();
            $destinationPath = storage_path('app/ktp/');
            Input::file('filex')->move($destinationPath, $fileName);
            return redirect('/login');
            //$usr->save();
            /*if ( Auth::attempt(['email' => $r->email, 'password' => $r->password]) ) 
            {
                if($usr->role=='admin')
                {
                    return redirect('/homeadmin');
                }
                elseif($usr->role=='penyewa')
                {
                    return redirect('/homepenyewa');
                }
            }*/
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
