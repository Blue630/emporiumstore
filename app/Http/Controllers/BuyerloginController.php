<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class BuyerloginController extends Controller
{
    function buyerlogin(Request $req)
    {
        if($req->isMethod('post'))
        {
            $email=strtolower($req->input('email'));
            $password=md5($req->input('password'));  
            ///return $email;
            $userlog=DB::table('vendor_retailer')->where(array('email'=>$email,'password'=>$password,'user_type'=>0))->first();
        if(!empty($userlog))
        {
            if($userlog)
                {
                    session()->put('logged_buyer',$userlog);
                    return redirect('buyer-profile');
                }
                elseif($userlog->status==2)
                {
                    return back()->with('error','Your Email id not verified');   
                }
                elseif($userlog->status==0)
                {
                    return back()->with('error','Your account has been deleted by Adminstartor'); 
                }
        }

        return back()->with('error','Invalid login id or password');
        }
        
        return view('front/buyer/buyerlogin');
    } 

    public function buyerlogout(Request $req)
    {
        $req->session()->flush();
        return redirect('/');
    }
}
