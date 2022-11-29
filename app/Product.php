<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='products';

    public static function getproduct($id)
    {
        return Product::where('id',$id)->first();
    }
    
     public static function getProducts()
    {
        return Product::all();
    }
    
    public static function fetchNewlyAddProducts(){
        return Product::where('status',1)->orderBy('id','desc')->limit(10)->get();
    }
    
}
