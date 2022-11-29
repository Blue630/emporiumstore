<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    //
    protected $table='addresses';

    public static function fetchBuyerPrimaryAddress($id)
    {
        return Addresses::where('user_id',$id)->where('is_main_address',1)->first();
    }
    
  
    

}
