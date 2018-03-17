<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class penyewa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) 
        {
            if( Auth::user()->role == 'penyewa')
            {
                return $next($request);
            }
            
        }
        return redirect('/');
    }
}
