<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class SuperAdmin
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
        //return $next($request);
        if(auth::check())
        {
        if(auth()->user()->is_admin == 2){
            return $next($request);
        }
        
    }
        return redirect('home')->with('error',"You don't have admin access.");
    }
}
