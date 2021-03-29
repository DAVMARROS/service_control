<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(Auth::check() && Auth::user()->status == 1 && Role::find(Auth::user()->rol)->rol == 'user'){
            return $next($request);
        }
        if(Auth::check() && Auth::user()->status == 1 && Role::find(Auth::user()->rol)->rol == 'admin'){
            return redirect('/admin');
        }
        else{
            $request->session()->flush();
            return redirect('/login')->with('status', "You don't have permission to access");

        }
    }
}
