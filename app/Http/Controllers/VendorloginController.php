<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class VendorloginController extends Controller
{
    function vendorlogin(Request $req)
    {
        if($req->isMethod('post'))
        {
            $email=strtolower($req->input('email'));
            $password=md5($req->input('password'));  
            //return $email;
            $userlog=DB::table('vendor_retailer')->where(array('email'=>$email,'password'=>$password))->first();
        //return [$userlog];
    // return $userlog->status;
        if(!empty($userlog))
        {
            if($userlog->status==1 && $userlog->user_type==1)
                {
                    session()->put('logged_vendor',$userlog);
                    return redirect('vendor/dashboard');
                }
                elseif($userlog->status==2 && $userlog->user_type==1)
                {
                    return back()->with('error','Adminstartor of website not accepted your request');   
                }
                elseif($userlog->status==0 && $userlog->user_type==1)
                {
                    return back()->with('error','Your account has been deleted by Adminstartor'); 
                }
        }

        return back()->with('error','Invalid login id or password');
        }
        if(Session()->has('logged_vendor'))
        {
            return redirect('vendor/dashboard');
        }
        return view('vendor/vendor-login');
    } 

    public function vendorlogout(Request $req)
    {
        $req->session()->flush();
        return redirect('/');
    }
}
