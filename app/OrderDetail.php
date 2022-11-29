<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    
    protected $table='order_detail';

    public static function GetUnratedProduct($user_id)
    {
        $unrated_product = OrderDetail:: select('*','order_detail.id as order_detail_id')->join('orders','orders.id','order_detail.order_id')->join('products','order_detail.product_id','products.id','order_detail.order_id')->where('order_detail.is_rated',0)->where('orders.buyer_id',$user_id)->get();
        
        return $unrated_product;
    }
    
    public static function checkLoggedNotRated($user_id,$product_id)
    {
        $loggeduser_unrated_product = OrderDetail:: select('order_detail.order_id as order_id')->join('orders','orders.id','order_detail.order_id')->join('products','order_detail.product_id','products.id','order_detail.order_id')->where('order_detail.is_rated',0)->where('orders.buyer_id',$user_id)->where('order_detail.product_id',$product_id)->first();
        
        return $loggeduser_unrated_product;
    }
    
    
    


}
