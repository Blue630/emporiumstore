<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    //
    public function userlogin()
    {
        return view('/front/login');
    }

    public function dologin(Request $req)
    {
        $email=strtolower($req->input('email'));
        $password=md5($req->input('password'));  
        if($userlog=DB::table('users')->where('email',$email)->where('password',$password)->where('status',1)->where('user_type',3)->first())
        {
            session()->put('logged_user',$userlog);
            return redirect('/');
        }
        return back()->with('error','Invalid login id or password');
    }
    public function userlogout(Request $req)
    {
        $req->session()->flush();
        return redirect('/');
    }

    public function forget_password()
    {
        return view('/front/forget_password');
        // DB::table('registeruser')->where('email',$req->input('email'))->first();  
    }

    public function forget_password_mail(Request $req)
    {
        $email=$req->input('email');
        //return view('/front/forget_password');
        $check=DB::table('userregister')->where('email',$email)->first();
        
        if(!empty($check))
        {
            $this->email=$check->email;
            $this->name=$check->name;
            $res=  Mail::send('front/sendmail/forgetpassword',$data =
        [
           'password'=>$check->cpassword 
        ],function($message){
            // return $data;
            $message->from('djsaluja18@gmail.com');
             $message->to($this->email,$this->name);
             $message->subject('Forget Password');
         });
         return back()->with('error','Your password has been sent on your registerd email');
        }
        else
        {
            return back()->with('error','Email id no registerd.');
        }  
    }
}
