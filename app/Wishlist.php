<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $table='wishlist';

     public static function getWishlistProducts($user_id)
    {
        return Wishlist:: join('products', 'wishlist.product_id', '=', 'products.id')->where("wishlist.user_id",$user_id)->get();
    }
}
