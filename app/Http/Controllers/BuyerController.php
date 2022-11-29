<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\IndexController;
use DB;
use Illuminate\Support\Facades\Auth;
use App\LikeDislikeReview;
class BuyerController extends Controller
{
//
function buyerprofile()
{   
if(session()->has('logged_buyer'))
{
$id=session()->get('logged_buyer')->id;
$buyerdetail=DB::table('vendor_retailer')->where('id',$id)->first();
$order_detail=DB::table('order_history')->where(array('user_id'=>$id,'usertype'=>'buyer'))->orderBy('id','desc')->get();
$wallet_his=DB::table('buyer_wallet_history')->where(array('userid'=>$id))->get();
return view('front/buyer/buyerprofile',['buyerdetail'=>$buyerdetail,'order_detail'=>$order_detail,'wallet_his'=>$wallet_his]);
}
return back();
}

function buyprofileupdate(Request $req)
{
$updateData=array('storedetail'=>$req->storedetail);
$buyer_id=$req->buyer_id;
if($req->hasFile('profile_img'))
{
$imagename=time().'_'.$req->profile_img->getClientOriginalName();
//echo $imagename;
$req->profile_img->move(public_path('uploads/buyer/'),$imagename);
$updateData['profile_img']=$imagename;
}
DB::table('vendor_retailer')->where('id',$buyer_id)->update($updateData);
return back();
}
function wallet_request(Request $req)
{
// return $req->all();
$paymentcount=$req->payment;
$amount=$req->wallet_redmee;
$token=time();
$id=session()->get('logged_buyer')->id;
for($i=0;$i<count($paymentcount);$i++)
{

$addData=array('amount'=>$amount,'token'=>$token,'userid'=>$id,'payment_id'=>$req->payment[$i],'created_date'=>date('Y-m-d'));
DB::table('buyer_wallet_history')->insert($addData);
}
return back()->with('success','Send Wallet Request'); 
}
function lazor_report(Request $req)
{
if($req->isMethod('post'))
{
}
else
{
// $report=DB::table('buyer_wallet_history')->where(array('status'=>0))->get()->groupBy('user_id'); 
$report= DB::table('buyer_wallet_history')
->where('status',0)
->select('token')
->groupBy('token')
->get();

// echo "<pre>";print_r($report);die; 
return view('admin/lazorreport',['report'=>$report]);
}
}
function walletupdate($token)
{
DB::table('buyer_wallet_history')->where('token',$token)->update(array('status'=>1));
return back();
}


function buyerProfileUpdatePage(Request $request){
$user = Auth::check();
if(Auth::check())
{
$user_type = auth()->user()->user_type;
if($user_type == '3' || $user_type == '2'){
return view('front/update-profile',['user'=>$user]);
}
else{
return view('front/my-account',['user'=>$user]);
}
}
else
{
return redirect('/login');
}


}

function UpdateUserDetais(Request $req){
$seller_id = $req->input('seller_id');
$buyer_id = $req->input('buyer_id');
//die;
if($buyer_id!='')
{
$data = [
"dob"=>$req->input('dob'),
"gender"=>$req->input('gender'),
"phone"=>$req->input('phone'),
];
DB::table('buyers')->where('id',$req->input('buyer_id'))->update($data);
DB::table('users')->where('id',$req->input('user_id'))->update(["name"=>$req->input('fullname')]);
return back()->with('success','Details Updated Successfully');
}
else
{
$data = [
//"dob"=>$req->input('dob'),
//"gender"=>$req->input('gender'),
"phone"=>$req->input('phone'),
];
DB::table('sellers')->where('id',$req->input('seller_id'))->update($data);
DB::table('users')->where('id',$req->input('user_id'))->update(["name"=>$req->input('fullname')]);
return back()->with('success','Details Updated Successfully');
}
}

function UpdateUserImage(Request $req){
$seller_id = $req->input('img_seller_id');
$buyer_id = $req->input('img_buyer_id');
//die;
if($buyer_id!='')
{
if($req->hasFile('image'))
{
$imagename=time().'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('front/img/'),$imagename);
$updateData['profile_img']=$imagename;
$data = [
"image"=>$imagename,
];
}
DB::table('buyers')->where('id',$req->input('img_buyer_id'))->update($data);
return back()->with('success','Image Updated Successfully');
}
else
{
if($req->hasFile('image'))
{
$imagename=time().'_'.$req->image->getClientOriginalName();
$req->image->move(public_path('front/img/'),$imagename);
$updateData['profile_img']=$imagename;
$data = [
"image"=>$imagename,
];
}
DB::table('sellers')->where('id',$req->input('img_seller_id'))->update($data);
return back()->with('success','Image Updated Successfully');
}
}


function UpdatePrimaryAddress(Request $req){
$user_id = $req->input('user_id');
$exist =  DB::table('addresses')->where('user_id',$user_id)->where('is_main_address',1)->count();
$data = [
"address"=>$req->input('full_address'),
"country"=>$req->input('country'),
"pincode"=>$req->input('pincode'),
"city"=>$req->input('city'),
"state"=>$req->input('state'),
];
if($exist != 0){
DB::table('addresses')->where('user_id',$user_id)->where('is_main_address',1)->update($data);
}
else
{
$data['user_id'] = $user_id;
$data['is_main_address'] = 1;
DB::table('addresses')->insert($data);
}
return back()->with('success','Address Updated Successfully');
}

public function RemoveProductFromWishlist($id){

$exist =  DB::table('wishlist')->where('product_id',$id)->delete();
return back();
}

public function fetchWishlist(Request $request){
//$user_id = auth()->user()->id;	
$user = Auth::check();
if(Auth::check())
{
$user_type = auth()->user()->user_type;
if($user_type == '3' || $user_type == '2'){
return view('front/wishlist',['user'=>$user]);
}
else{
return view('front/my-account',['user'=>$user]);	
}
}
else
{
return redirect('/login');
}
}


public function myOrders(Request $request){
$user = Auth::check();
/*echo "<pre>";
print_r($user);
echo "</pre>";die;*/
//$user = $request->session()->all();
if(Auth::check())
{
$user_id = auth()->user()->id;
$user_type = auth()->user()->user_type;
if($user_type == '3' || $user_type == '2'){
return view("front/myorders",['user'=>$user]);
}
}
else
{
return redirect('/login');
}
}

public function cancelOrder(Request $request){
$data = [];
$data['cancel_reason'] = $request->reason;
$data['status'] = 4;
if(!empty($request->description)){
$data['cancel_description'] = $request->description;
}
DB::table('orders')->where('id',$request->cancel_order_id)->update($data);
return back()->with('success','Order Cancelled Successfully');
}

public function orderDetail(Request $request,$id){
$user = Auth::check();
if(Auth::check())
{
$user_id = auth()->user()->id;
$user_type = auth()->user()->user_type;
}

if($user_type == '3' || $user_type == '2'){
return view('front/order-details',["order_id"=>$id,"user"=>$user]);
}else{
return redirect('/login');
}
}

public function rateProduct(Request $request){

$detail_id = $request->input('detail_id');
/*$user = $request->session()->all();
$user_id = $user['logged_user']->id;*/

$user = Auth::check();
if(Auth::check())
{
$user_id = auth()->user()->id;
}

$data = [
"product_id"=>$request->input('product_id'),
"user_id"=>$user_id,
"rating"=>$request->input('rating'),
"title"=>$request->input('title'),
"review"=>$request->input('review'),
];

if($request->hasFile('images'))
{
$image=[];    
foreach($request->images as $img){

$imagename=time().'_'.$img->getClientOriginalName();

$img->move(public_path('front/img/'),$imagename);
$image[] = $imagename;
}

$data['images']=implode(",",$image);


}

$updatedata = [
'is_rated' => 1
];

DB::table('review')->insert($data);
DB::table('order_detail')->where('id',$detail_id)->update($updatedata); 
return back()->with('success','Rated Successfully');
}



public function rateUnratedProduct(Request $request){
if($request->input('starrating'))
{
$get_keys = array_keys($request->input('starrating'));

$data = [
"product_id"=>$request->input('unrated_product_id'),
"user_id"=>$request->input('unrated_user_id'),
"rating"=>$get_keys[0],
];
DB::table('review')->insert($data);
DB::table('order_detail')->where('id',$request->input('unrated_orderdetail_id'))->update(['is_rated' => 1]); 

return back();
}
else{
return back()->with('success','Please select rating');        
}
}





public function loadMoreReviews(Request $request){

$product_id =  $request->product_id;
$click =  $request->click;
$sortby = $request->sortby;

if(empty($click)){
$click = 1;
}

$limit = 10;
$offset = ($click - 1) * $limit;

if(!empty($sortby)){
if($sortby == 1){

$reviews = DB::table('review')->select('*','users.name as uname','users.id as user_id','review.id as rid')->join('users','users.id','review.user_id')->where('rating', '>=', 3)->where('product_id',$product_id)->offset($offset)->limit($limit)->get();

}else if($sortby == 2){

$reviews = DB::table('review')->select('*','users.name as uname','review.id as rid')->join('users','users.id','review.user_id')->where('rating', '<', 3)->where('product_id',$product_id)->offset($offset)->limit($limit)->get();

}else if($sortby == 3){

$reviews = DB::table('review')->select('*','users.name as uname','review.id as rid')->join('users','users.id','review.user_id')->where('rating', '>=', 4)->where('product_id',$product_id)->offset($offset)->limit($limit)->get();

}else if($sortby == 4){

$reviews = DB::table('review')->select('*','users.name as uname','review.id as rid')->join('users','users.id','review.user_id')->where('product_id',$product_id)->latest('review.id')->offset($offset)->limit($limit)->get();

}
}
else{
$reviews = DB::table('review')->select('*','users.name as uname','review.id as rid')->join('users','users.id','review.user_id')->where('product_id',$product_id)->offset($offset)->limit($limit)->get();
}




foreach($reviews as $review){

?>    
<div class="users_reviews_list py-5">
<div class="title d-flex align-items-end">
<h3 class="ft-20 lh-30 ft-medium m-0">“<?php echo $review->title ?>”</h3>
<p class="ft-10 mb-md-0 ms-4"><b><?php echo $review->uname ?></b> rated &nbsp;&nbsp; <?php echo $review->rating ?><i class="fas fa-star text-yellow "></i></p>
</div>
<div class="users_reviews_pics d-flex flex-wrap gap-5 my-5">
<?php 
$reviewimages = explode(",",$review->images);
foreach($reviewimages as $reviewimage){
?>

<a href="<?php echo asset('/public/front') ?>/img/<?php echo $reviewimage ?>" data-lightbox="usersreviewspics1">
<img src="<?php echo asset('/public/front') ?>/img/<?php echo $reviewimage ?>" class="img-fluid" alt="">
</a>

<?php 
}
?>

</div>
<div class="users_reviews_desc ft-medium text-black">
<?php echo $review->review ?>
</div>
<?php
//$user = Auth::check();
if(Auth::check())
{
$responses = LikeDislikeReview::fetchlikeDislike($review->rid);
$likecount=0;
$dislikecount=0;
foreach($responses as $response){
if($response->response == 1){
$likecount = $response->responsecount;
}
if($response->response == 2){
$dislikecount = $response->responsecount;
}
}
$userresponses = LikeDislikeReview::fetchUserResponse($review->rid,$review->user_id);
if(empty($userresponses)){
$userresponse = 0;
}else{
$userresponse = $userresponses->response;
}
?>                                    

<div class="users_reviews_likebox ft-medium text-black d-flex align-items-center mt-5">
<div class="r_likebox d-flex align-items-center">
<label class="likebox_radio" onclick="likeReview(1,<?php echo $review->rid ?>)">
<input type="radio" name="likeboxradio" <?php echo($userresponse == 1)? "disabled":"" ?>>
<i class="fa fa-thumbs-up" aria-hidden="true" style="color:black"></i></label>
<p class="m-0 text-secondary ms-3"><?php echo $likecount ?></p>
</div>


<div class="r_likebox d-flex align-items-center ms-5">
<label class="likebox_radio" onclick="likeReview(2,<?php echo $review->rid ?>)">
<input type="radio" name="likeboxradio" <?php echo($userresponse == 2)? "disabled":"" ?>>
<i class="fa fa-thumbs-down" aria-hidden="true" style="color:black"></i></label>
<p class="m-0 text-secondary ms-3"><?php echo $dislikecount ?></p>
</div>
</div>

<?php } ?>                                   
</div>


<?php } 



}


function sortByReview(Request $request){


$product_id =  $request->product_id;
$sortby = $request->sortby;

if($sortby == 1){

$reviews = DB::table('review')->select('*','users.name as uname','users.id as user_id','review.id as rid')->join('users','users.id','review.user_id')->where('rating', '>=', 3)->where('product_id',$product_id)->limit(10)->get();

}else if($sortby == 2){

$reviews = DB::table('review')->select('*','users.name as uname','users.id as user_id','review.id as rid')->join('users','users.id','review.user_id')->where('rating', '<', 3)->where('product_id',$product_id)->limit(10)->get();

}else if($sortby == 3){

$reviews = DB::table('review')->select('*','users.name as uname','users.id as user_id','review.id as rid')->join('users','users.id','review.user_id')->where('rating', '>=', 4)->where('product_id',$product_id)->limit(10)->get();

}else if($sortby == 4){

$reviews = DB::table('review')->select('*','users.name as uname','users.id as user_id','review.id as rid')->join('users','users.id','review.user_id')->where('product_id',$product_id)->latest('review.id')->limit(10)->get();

}




foreach($reviews as $review){
?>    
<div class="users_reviews_list py-5">
<div class="title d-flex align-items-end">
<h3 class="ft-20 lh-30 ft-medium m-0">“<?php echo $review->title ?>”</h3>
<p class="ft-10 mb-md-0 ms-4"><b><?php echo $review->uname ?></b> rated &nbsp;&nbsp; <?php echo $review->rating ?><i class="fas fa-star text-yellow "></i></p>
</div>
<div class="users_reviews_pics d-flex flex-wrap gap-5 my-5">
<?php 
$reviewimages = explode(",",$review->images);
foreach($reviewimages as $reviewimage){
?>

<a href="<?php echo asset('/public/front') ?>/img/<?php echo $reviewimage ?>" data-lightbox="usersreviewspics1">
<img src="<?php echo asset('/public/front') ?>/img/<?php echo $reviewimage ?>" class="img-fluid" alt="">
</a>

<?php 
}
?>

</div>
<div class="users_reviews_desc ft-medium text-black">
<?php echo $review->review ?>
</div>
<?php
//$user = Auth::check();
if(Auth::check())
{
$responses = LikeDislikeReview::fetchlikeDislike($review->rid);
$likecount=0;
$dislikecount=0;
foreach($responses as $response){
if($response->response == 1){
$likecount = $response->responsecount;
}
if($response->response == 2){
$dislikecount = $response->responsecount;
}
}
$userresponses = LikeDislikeReview::fetchUserResponse($review->rid,$review->user_id);
if(empty($userresponses)){
$userresponse = 0;
}else{
$userresponse = $userresponses->response;
}
?>                                                                        

<div class="users_reviews_likebox ft-medium text-black d-flex align-items-center mt-5">
<div class="r_likebox d-flex align-items-center">
<label class="likebox_radio" onclick="likeReview(1,<?php echo $review->rid ?>)">
<input type="radio" name="likeboxradio" <?php echo($userresponse == 1)? "disabled":"" ?>>
<i class="fa fa-thumbs-up" aria-hidden="true" style="color:black"></i></label>
<p class="m-0 text-secondary ms-3"><?php echo $likecount ?></p>
</div>


<div class="r_likebox d-flex align-items-center ms-5">
<label class="likebox_radio" onclick="likeReview(2,<?php echo $review->rid ?>)">
<input type="radio" name="likeboxradio" <?php echo($userresponse == 2)? "disabled":"" ?>>
<i class="fa fa-thumbs-down" aria-hidden="true" style="color:black"></i></label>
<p class="m-0 text-secondary ms-3"><?php echo $dislikecount ?></p>
</div>
</div>
<?php } ?>     
</div>


<?php 
}   
}        
function likeDislkeReview(Request $request){
$exist = DB::table('review_like_dislike')->where("user_id",$request->user_id)->where("review_id",$request->review_id)->count();        
if($exist == 1)
{
$data = [
"response"=>$request->response,
];            
DB::table('review_like_dislike')->where("user_id",$request->user_id)->where("review_id",$request->review_id)->update($data);
}
else if($exist == 0)
{            
$data = [
"response"=>$request->response,
"review_id"=>$request->review_id,
"user_id"=>$request->user_id,
];           
DB::table('review_like_dislike')->insert($data);
}   
}   
}