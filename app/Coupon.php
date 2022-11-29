<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $table='coupons';

     public static function getCoupons()
    {
        return Coupon::limit(4)->get();
    }
}
