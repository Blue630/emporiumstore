<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsSeller
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
        //return $next($request);die;
        if(auth::check())
        {
        //print_r(auth()->user());die;
        if(auth()->user()->user_type == 2 || auth()->user()->user_type == 3){
            return $next($request);
        }
    }
        return redirect('backend')->with('error',"You don't have seller access.");
    }
}