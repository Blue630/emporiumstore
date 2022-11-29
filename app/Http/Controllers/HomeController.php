<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome()
    {
        $product_limit = '';
        $new_end_date = '';
        $subscription_name = '';
        $remainingproduct = '';
        $remaining_product_limit = '';
        //$today=date('Y-m-d').' 00:00:00';
        $today=date('Y-m-d');
        $user_id = \Auth::user()->id;
        $neworder=DB::table('orders')->where('created_at',$today)->get()->count();
        $totaloders= DB::table('orders')->get()->count();
        $totaluser=DB::table('users')->where('status',1)->get()->count();
        $totalseller=DB::table('users')->where('user_type',2)->get()->count();
        $totalbuyer=DB::table('users')->where('user_type',3)->get()->count();
        $totalproducts=DB::table('products')->where('status',1)->get()->count();
        $totalsellerproducts=DB::table('products')->where('user_id',$user_id)->get()->count();
        $totalsellerorders = DB::table('order_detail')->where('seller_id',$user_id)->groupBy('order_id')->get()->count();
        
        $newtotalsellerorders = DB::table('order_detail')
                 ->where(array('seller_id'=>$user_id,'created_at'=>$today))
                 ->groupBy('order_id')
                 ->get()->count();
        
        $seller_data=DB::table('sellers')->where('user_id',$user_id)->first();
        if($seller_data!='')
        {
            $seller_data->seller_subscription_id;
            if($seller_data->seller_subscription_id!='')
            {
                $seller_subscription_data=DB::table('seller_subscriptions')->where('seller_id',$user_id)->orderBy('id','desc')->first();
                if($seller_subscription_data!='')
                {
                $seller_subscription_data->subscription_id;
                    $subscription_data=DB::table('subscriptions')->where('id',$seller_subscription_data->subscription_id)->first();
                    $end_date = $seller_subscription_data->end_date;
                    $new_end_date = date('M,j Y', strtotime($end_date)); 
                    $subscription_name = $subscription_data->plan_name;
                    $product_limit = $subscription_data->product_limit;
                    
                    $remainingproduct = DB::table('order_detail')
                     ->where(array('seller_id'=>$user_id,'seller_subscription_id'=>$seller_data->seller_subscription_id))
                     ->groupBy('order_id')
                     ->get()->count();
                    $remaining_product_limit = $product_limit-$remainingproduct;
                }
            }
        }
        //return $neworder;

        return view('adminHome',[
            'neworder'=>$neworder,
            'totaloders'=>$totaloders,
            'totaluser'=>$totaluser,
            'totalvendor'=>$totalseller,
            'totalbuyer'=>$totalbuyer,
            'totalproducts'=>$totalproducts,
            'totalsellerproducts'=>$totalsellerproducts,
            'totalsellerorders'=>$totalsellerorders,
            'newtotalsellerorders'=>$newtotalsellerorders,
            'new_end_date'=>$new_end_date,
            'subscription_name'=>$subscription_name,
            'remaining_product_limit'=>$remaining_product_limit
        ]);

    }

}