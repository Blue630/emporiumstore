<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsAdmin
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
        if(auth()->user()->is_admin == 1){
            return $next($request);
        }
    }
        return redirect('backend')->with('error',"You don't have admin access.");
    }

}
