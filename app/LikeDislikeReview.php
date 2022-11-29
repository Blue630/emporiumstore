<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class LikeDislikeReview extends Model
{
    
    protected $table='review_like_dislike';

   
    
     public static function fetchlikeDislike($review_id)
    {
        
        $countPerResponse = LikeDislikeReview:: selectRaw('count(response) as responsecount,response')->where('review_id',$review_id)->groupBy('response')->orderByDesc('response')->get();
        
        return $countPerResponse; 
    }
    
    
    public static function fetchUserResponse($review_id,$user_id){
        $Response = LikeDislikeReview:: select('response')->where('review_id',$review_id)->where('user_id',$user_id)->first();
        
        return $Response; 
    }
    
    
}
