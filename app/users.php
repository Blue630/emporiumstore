<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
    
class users extends Model
{
    //
    protected $table='users';


    public static function getUserDetails($id){
        return users::where('id',$id)->first();
    }
    
    
}
