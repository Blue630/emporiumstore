<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    //
    protected $table='specifications';

    public static function getproduct_specfication($id)
    {
        return Specification::where('id',$id)->first();
    }
    
     public static function getspecifications()
    {
        return Specification::all();
    }
    

}
