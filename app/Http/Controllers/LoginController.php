<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    //
    public function userlogin()
    {
        return view('/front/login');
    }

    public function dologin(Request $req)
    {
        //echo "<pre>";
        //print_r($req->password);die;
        /*$email=strtolower($req->input('email'));
        $password=$req->input('password');
        if($userlog=DB::table('users')->where('email',$email)->where('showpassword',$password)->where('status',1)->first())
        {
            $user_type = $userlog->user_type;
            if($user_type==3)
            {
            session()->put('logged_user',$userlog);
            return redirect('/');
            }
            else
            {
                session()->put('logged_user',$userlog);
                return redirect('/welcome-seller');
            }
        }*/
        $email = strtolower($req->email);
        $password = $req->password;
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $getuser = DB::table('users')->where('email',$email)->whereIn('status', array(1,2))->first();
        if($getuser!='')
        {
            $user_type = $getuser->user_type;
            
            if(auth()->attempt(array('email' => $email, 'password' => $password)))
            {
                if($user_type==3)
                {
                    return redirect('/');
                }
                if($user_type==2)
                {
                    return redirect('/welcome-seller');
                }
                else
                {
                    return back()->with('error','Invalid login id or password');
                    //session()->put('logged_user',$userlog);
                    //return redirect('/welcome-seller');
                }
            }
        }
        return back()->with('error','Invalid login id or password');
        //return back()->with('error','Invalid login id or password');
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
