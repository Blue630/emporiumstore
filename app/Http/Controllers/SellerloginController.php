<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SellerloginController extends Controller
{
    function sellerlogin(Request $req)
    {
        if($req->isMethod('post'))
        {
            $email=strtolower($req->input('email'));
            $password=md5($req->input('password'));  
            //return $email;
            $userlog=DB::table('users')->where(array('email'=>$email,'password'=>$password))->first();
        //return [$userlog];
    // return $userlog->status;
        if(!empty($userlog))
        {
            if($userlog->status==1 && $userlog->user_type==2)
                {
                    session()->put('logged_seller',$userlog);
                    return redirect('seller/dashboard');
                }
                elseif($userlog->status==2 && $userlog->user_type==2)
                {
                    return back()->with('error','Adminstartor of website not accepted your request');   
                }
                elseif($userlog->status==0 && $userlog->user_type==2)
                {
                    return back()->with('error','Your account has been deleted by Adminstartor'); 
                }
        }

        return back()->with('error','Invalid login id or password');
        }
        if(Session()->has('logged_seller'))
        {
            return redirect('seller/dashboard');
        }
        return view('seller/seller-login');
    } 

    public function sellerlogout(Request $req)
    {
        $req->session()->flush();
        return redirect('/');
    }
}
