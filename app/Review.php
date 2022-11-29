<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{
    
    protected $table='review';

    public static function getRatingAverage($productid)
    {
        $ratings = Review::where('product_id',$productid)->get();
        $ratecount = $ratings->count();
        $ratingsum = 0;
        if($ratecount != 0){
        foreach($ratings as $rating){
            $ratingsum += $rating->rating;
        }
        $average_rating = $ratingsum/$ratecount;
        }else{
        $average_rating=0;
        }
        
        $data=[
            "reviews"=>$ratecount,
            "rating"=>$average_rating,
            ];
            
        
        return $data; 
    }
    
    
     public static function fetchRatingStats($productid)
    {
        
        $countperrating = Review:: selectRaw('count(rating) as countrate,rating')->where('product_id',$productid)->groupBy('rating')->orderByDesc('rating')->get();
        
        $ratings = Review::where('product_id',$productid)->get();
        
        
        $review_count = Review::where('product_id',$productid)->whereNotNull('review')->count();
        
        $ratecount = $ratings->count();
        $ratingsum = 0;
        if($ratecount != 0){
        foreach($ratings as $rating){
            $ratingsum += $rating->rating;
        }
        $average_rating = $ratingsum/$ratecount;
        }else{
        $average_rating=0;
        }
        
        $data=[
            "averagerating"=>$average_rating,
            "review_count"=>$review_count,
            "countperrating"=>$countperrating,
            "totalrating"=>$ratecount
            ];
            
        
        return $data; 
    }
    
    
    
public static function getRatingAverageHTML($productid)
{
$ratings = Review::where('product_id',$productid)->get();
$ratecount = $ratings->count();
$ratingsum = 0;
if($ratecount != 0){
foreach($ratings as $rating){
$ratingsum += $rating->rating;
}
$average_rating = $ratingsum/$ratecount;
}else{
$average_rating=0;
}



$data = '';    
$rating =  $average_rating;
$reviews = $ratecount;
for($i=0;$i<5;$i++){
if($rating > $i){
$half = $i + 0.5;
if($rating < $half){

$data .= '<i class="fas fa-star blackstar"></i>';
}else if($rating == $half || ($rating > $half && $rating < $i+1)){

$data .= '<i class="fas fa-star-half-alt"></i>';

} else{ 
$data .= '<i class="fas fa-star"></i>';
}
}
else{ 

$data .= '<i class="fas fa-star blackstar"></i>';
} } 
$data .= '<span>('.$reviews.')</span>';
return $data; 
}
    
public static function getRatingAverageHTML2($productid)
{
$ratings = Review::where('product_id',$productid)->get();
$ratecount = $ratings->count();
$ratingsum = 0;
if($ratecount != 0){
foreach($ratings as $rating){
$ratingsum += $rating->rating;
}
$average_rating = $ratingsum/$ratecount;
}else{
$average_rating=0;
}
        
        
$data = '<div class="p_rating d-flex align-items-center gap-2">';    
$rating =  $average_rating;
$reviews = $ratecount;
for($i=0;$i<5;$i++){
if($rating > $i){
$half = $i + 0.5;
if($rating < $half){

$data .= '<i class="fas fa-star blackstar"></i>';
}else if($rating == $half || ($rating > $half && $rating < $i+1)){

$data .= '<i class="fas fa-star-half-alt"></i>';
  
 } else{ 
$data .= '<i class="fas fa-star"></i>';
 }
}
else{ 

$data .= '<i class="fas fa-star blackstar"></i>';
 } }
 
$data .= '<span class="align-middle">'.$rating.'</span></div><div class="p_reviews text-secondary ft-medium">
        <span class="text-navyblue">('.$reviews.')</span> Reviews
    </div>';
        return $data; 
    }
    
    public static function fetchReviews($productid){
        return Review::where('product_id',$productid)->limit(10)->get();
        
    }
    
     public static function fetchReviewsOnly($productid){
        return Review::where('product_id',$productid)->whereNotNull('review')->limit(10)->get();
        
    }
    

}
