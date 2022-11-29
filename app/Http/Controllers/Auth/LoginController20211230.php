<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
       // return $request->all();
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->user_type == 1) {
                return redirect('/admin/home');
                //return redirect()->route('home');
            }
            /*else  if (auth()->user()->is_admin == 2) {
                return redirect('/admin/dashboard');
                //return redirect()->route('home');
            }*/
            else  if (auth()->user()->user_type == 2) {
                return redirect('/seller/dashboard');
                //return redirect()->route('home');
            }
            else
            {
                return redirect('/backend');
            }
        }
        else
        {
            //return redirect('/admin');
                //->with('error','Email-Address And Password Are Wrong.');
        }          
    }

    function logout()
    {
        Auth::logout();
        return redirect('/backend');
    }
}