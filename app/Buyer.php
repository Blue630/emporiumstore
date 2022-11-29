<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    //
    protected $table='buyers';

    public static function fetchBuyerDetailsOnUID($id)
    {
        return Buyer::where('uid',$id)->first();
    }
    
  
    

}
