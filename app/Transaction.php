<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


    
class Transaction extends Model
{
    protected $table='transaction_history';


    public static function getUserTransaction($id){
        return Transaction::where('user_id',$id)->get();
    }
    
    public static function adminWallet(){
      
      return Transaction::select('*', DB::raw('SUM(admin_amount) as total_amount'))
                ->groupBy('type')
                ->get();
    }
    
    
}
