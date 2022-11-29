<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table='category';

    public static function getproduct_category($id)
    {
        return Category::where('id',$id)->first();
    }
    
     public static function getCategories()
    {
        return Category::all();
    }
    

}
