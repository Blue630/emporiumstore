<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
    protected $table='sub_category';

    public static function getproduct_subcategory($id)
    {
        return Subcategory::where('id',$id)->first();
    }
    
     public static function getSubcategories()
    {
        return Subcategory::all();
    }
}
