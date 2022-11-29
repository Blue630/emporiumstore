<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class additional extends Model
{
    protected $table='additional';
    public static function getProductImages($vid)
    {
        return additional::where('option_id',$vid)->get();
    }
}
