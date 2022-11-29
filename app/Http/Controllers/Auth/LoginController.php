<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
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
        //return $request->all();
        //$input = $request->all();

        $email = $request->email;
        $password = $request->password;
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $getuser = DB::table('users')->where('email',$email)->whereIn('status', array(1,2))->first();
        if($getuser!='')
        {
            $user_type = $getuser->user_type;
            
            if(auth()->attempt(array('email' => $email, 'password' => $password)))
            {
                if (auth()->user()->user_type == 1) 
                {
                    return redirect('/admin/home');
                }
                elseif (auth()->user()->user_type == 2) 
                {
                    return redirect('/seller/dashboard');
                }
                elseif($user_type==3)
                {
                    return redirect('/seller/dashboard');
                }
                else
                {
                    return redirect('/backend');
                }
            }
        }
        
        $getuserstatus = DB::table('users')->where(array('email'=>$email,'status'=>0))->first();
        if($getuserstatus!='')
        {
            if($getuserstatus->status==0)
            {
            $currentURL = ('/backend');
            echo "<script>alert('Your account is banned')</script>";
            echo "<script>window.location.href='".$currentURL."'</script>";
            exit;    
            }
        }
        else
        {
        $currentURL = ('/backend');
        echo "<script>alert('Please enter correct username & password')</script>";
        echo "<script>window.location.href='".$currentURL."'</script>";
        exit;
        }
    }

    function logout()
    {
        if (auth()->user()->user_type == 2 || auth()->user()->user_type == 3) 
        {
            Auth::logout();
            return redirect('/');
        }
        else
        {
            Auth::logout();
            return redirect('/backend');
        }
    }
}