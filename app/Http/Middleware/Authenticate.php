<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        /*$data = session()->all();
        echo "<pre>";
        print_r($data);die;*/
        //dd($request);die;
        //echo $user_id = \Auth::user()->id;die;
        if (! $request->expectsJson()) {
            return route('login');
        }   
    }
}
