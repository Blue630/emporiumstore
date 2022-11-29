<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class commonmodel extends Model
{
    //
    public static function findvendor($vendor_id)
    {
        return DB::table('vendor_retailer')->where('id',$vendor_id)->first();
    }
    public static function findbuyer($id)
    {
        return DB::table('vendor_retailer')->where('id',$id)->first();
    }
    public static function todaysale($vendor_id)
    {
        $dt=date('Y-m-d');
        return DB::table('order_history')->where(array('vendor_id'=>$vendor_id,'created_date'=>$dt))->count();
    }
    public static function todaybuy($user_id)
    {
        $dt=date('Y-m-d');
        return DB::table('order_history')->where(array('user_id'=>$user_id,'created_date'=>$dt))->count();
    }
    public static function totalsale($vendor_id)
    {
        return DB::table('order_history')->where(array('vendor_id'=>$vendor_id))->count();
    }
    public static function wallet_detail($token)
    {
        return DB::table('buyer_wallet_history')
        ->join('vendor_retailer', 'buyer_wallet_history.userid', '=', 'vendor_retailer.id')
        ->where(array('buyer_wallet_history.token'=>$token,'buyer_wallet_history.status'=>0))
        ->first();
    }
}
