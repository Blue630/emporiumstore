<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class IsBuyer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     if(Session()->has('logged_buyer'))
    //     {
    //          return $next($request);
    //     }
    //     else
    //     {
    //         // return view('vendor/vendor-login');
    //         return redirect('/');
            
    //     }
    // }
    
    
     public function handle($request, Closure $next)
    {
        //return $next($request);die;
        if(auth::check())
        {
        //print_r(auth()->user());die;
        if(auth()->user()->user_type == 3){
            return $next($request);
        }
    }
        return redirect('emporium')->with('error',"You don't have admin access.");
    }
    
}
