<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class page_content extends Model
{
    //
    protected $table='page_content';

    public static function getPageContent($id)
    {
        // return page_content::all()->where('page_id',$id);
      return DB::select("SELECT * FROM page_content WHERE `page_id` = '$id'");
    }

}
