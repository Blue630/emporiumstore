<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class VendorMiddleware
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
        //return Session()->get('logged_vendor');
        if(Session()->has('logged_vendor'))
        {
             return $next($request);
        }
        else
        {
            // return view('vendor/vendor-login');
            return redirect('vendor-login');
            
        }
        
        //return 
        
    }
}
