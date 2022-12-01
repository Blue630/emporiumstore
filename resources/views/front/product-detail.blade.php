@include('front.include.header')
@yield('header')   
<?php
    use App\Review;
    use App\OrderDetail;
    use App\LikeDislikeReview;
    if(Auth::check())
    {
    $user_id = auth()->user()->id;
    }
    else{
        $user_id='';
    }
    $product_id = $productdetail->id;
    $seller_id = $productdetail->user_id;
    $getpincode=DB::table('addresses')->where('user_id',$user_id)->first();
    if(!empty($getpincode))
    {
        $pincode = $getpincode->pincode;
    }
    else
    {
        $pincode = '';
    }
    echo "<script>var pincode = '$pincode' </script>";
    $seller_data_email = DB::table('users')->where('id',$seller_id)->first();
    $seller_email = $seller_data_email->email;
    $checkCashback = DB::table('cashbacks')->select('*')->whereRaw('FIND_IN_SET('.$product_id.',product_id)')->first();
    if(!empty($checkCashback))
    {
    $cashback = $checkCashback->cashback;
    }
    else
    {
    $cashback = 0;
    }
    $is_featured = $productdetail->is_featured;
    $product_name = $productdetail->name;
    $category_id = $productdetail->catid;
    $category = DB::table('category')->where('id',$category_id)->first();
    $cat_name = $category->catname;
    $cat_slug = $category->slug;
    $subcategory_id = $productdetail->subcat_id;
    $subcategory = DB::table('sub_category')->where('id',$subcategory_id)->first();
    if(isset($subcategory))
    {
    $subcat_name = $subcategory->name;
    $subcat_slug = $subcategory->slug;
    }
    else
    {
    $subcat_name = '';
    $subcat_slug = '';
    }
    $postal_code = $productdetail->zipcode;
    //die;
    $discount_code_id = $productdetail->discount_code_id;
    $coupon = DB::table('coupons')->where('id',$discount_code_id)->first();
    if(!$coupon)
    {
    $coupon_end_date = '';    
    }
    else{
    $coupon_end_date = $coupon->end_date;
    $coupon_start_date = $coupon->start_date;
    }
    $currentDate = date('Y-m-d');
    if($coupon_end_date>=$currentDate)
    {
    $coupon_code = $coupon->code;
    $coupon_perecent = $coupon->percent;
    }
    else
    {
    $coupon_code = '';
    $coupon_perecent = '';
    }
?>
<style>
.addon_prod_count .addon, .addon_prod_count .addon_equalto {
white-space: nowrap;
}
.addon_prod_count.d-flex.align-items-center {
    min-width: 100%;
    overflow-x: auto;
}
</style>
<!-- content area start -->
<div class="container">
<div class="breadcrumb_box mt-5">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{url('category/'.$cat_slug)}}">{{$cat_name}}</a></li>
<li class="breadcrumb-item"><a href="{{url('subcategory/'.$subcat_slug)}}">{{$subcat_name}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{$product_name}}</li>
</ol>
</nav>
<div class="h-50px"></div>
<div class="row">
<div class="col-xl-11 mx-auto">
<!-- <span id="frontID"></span> -->
<div id="loadmsgpromo" class="alert alert-primary alert_hideo"></div>
<div class="row">
<div class="col-lg-5 col-xl-6">
<div class="product_main_image" id="galleryvariant">
<!--<div class="big_image position-relative">
<?php
$a = 0;
$additional1=DB::table('additional')->where('product_id',$product_id)->first();
if(!empty($additional1))
{
?>
<img style="height:555px;object-fit: contain" src="{{ asset('public/product_image/'.$additional1->product_image) }}" class="w-100" alt="" data-id="img<?php echo $a;?>"><?php } ?>
<i data-feather="zoom-in"></i>
</div>
<div class="small_images row row-cols-lg-6 row-col-3 gx-2">
<?php
$b = 0;
$additional2=DB::table('additional')->where('product_id',$product_id)->get();
foreach ($additional2 as $alladditional2) {
$b++;
?>
<div class="col">
<div class="smallimage_list" data-id="img<?php echo $b;?>" data-src="{{ asset('public/product_image/'.$alladditional2->product_image) }}">
<img style="height:93px;" src="{{ asset('public/product_image/'.$alladditional2->product_image) }}" class="img-fluid" alt="">
</div>
</div>
<?php
}
?>
</div>
<div class="lightbox_gallery">
<?php
$c = 0;
$additional3=DB::table('additional')->where('product_id',$product_id)->get();
foreach ($additional3 as $alladditional3) {
$c++;
?>
<a href="{{ asset('public/product_image/'.$alladditional3->product_image) }}" data-id="img<?php echo $c;?>" data-lightbox="lightbox">&nbsp;</a>
<?php
}
?>
</div>-->
</div>
</div>
<div class="col-lg-7 col-xl-6 ps-lg-5">
<div class="prod_detail_desc">
<div class="d-flex justify-content-between">
<div class="pname w-100 w-lg-75">
<h1 class="ft-30 lh-45 ft-medium text-black">{{$product_name}} <small class="text-secondary ft-15 align-middle"><?php if($is_featured==1) { ?>(Featured)<?php } else { ?>(New)<?php } ?></small></h1>
<div class="d-flex align-items-center justify-content-between flex-wrap pe-4 pe-md-0">
@php
$rating_data = Review::getRatingAverage($product_id);
@endphp
<div class="p_rating d-flex align-items-center gap-2">
<div class="ratingofprod">
<div class="ratinga2">
<div class="ratinga" data-value="{{number_format($rating_data['rating'],1)}}"></div>
</div>
</div>                  
<span class="align-middle">{{number_format($rating_data['rating'],1)}}</span></div>
<div class="p_reviews text-secondary ft-medium">
<span class="text-navyblue">({{$rating_data['reviews']}})</span> Reviews
</div>

<?php
$product_cart_quantity = DB::table('cart')->where(array('product_id'=>$product_id,'status'=>0))->get();
$product_cart_quantity_count = count($product_cart_quantity);
if($product_cart_quantity_count<$productdetail->quantity)
{
$newstock = $productdetail->quantity - $product_cart_quantity_count;
?>
  <div class="p_stock text-secondary ft-medium">
     Stock: <span class="text-pink">{{$newstock}} Remaining !</span>
  </div>
  <?php
}
else
{
?>
<div class="p_stock text-secondary ft-medium">
     Stock: <span class="text-pink">Out Of Stock !</span>
  </div>
<?php
}
?>
</div>
</div>
<?php $currentURL = URL::current();?>
<div class="p_share position-relative">
<a class="share-btn share-btn-inverse share-btn-more text-black " href="https://www.addtoany.com/share_save?linkurl={{$currentURL}}" title="More share options">
<span data-feather="share-2" class="" style="width: 30px;height: 30px;"></span>
</a>
<?php
if(Auth::check())
{
$user_id = auth()->user()->id;
?>
<style>
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
cursor: pointer;
background-color: #fff;
border: none;
}
.fa{
color:red;
}
</style>
<button title="Add to Wish List" data-toggle="tooltip" type="button" class="btn-wishlist" href="javascript:void(0);" onClick="addwishlist('<?php echo $productdetail->id; ?>');">
<?php
$wishlist = DB::table('wishlist')->where(array('user_id'=>$user_id,'status'=>1,'product_id'=>$productdetail->id))->get();
$countwishlist = count($wishlist);
if($countwishlist>0)
{
?>
<i class="fa fa-heart"></i>
<?php
}
else
{
?>
<i class="far fa-heart"></i>
<?php
}
?>
</button>
<?php
}
else
{
?>
<style>
button.btn-wishlist{
background-color:#fff;
border:none;
}
</style>
<button title="Wish List" data-toggle="tooltip" type="button" class="btn-wishlist" href="javascript:void(0);" onClick="wishlist();"><i class="far fa-heart"></i></button>
<?php
}
?>
</div>
</div>
</div>
<div class="prod_price-details mt-5">
<div class="d-flex align-items-center justify-content-between w-xl-60 w-lg-75">
<div class="p_price m-0">
<i class="fas fa-pound-sign"></i> <span id="priceSpan">{{number_format($productdetail->price * (1 - ($productdetail->discount ?? 0) / 100), 2)}}</span>
</div>
<?php
if($productdetail->discount!='')
{
?>
<div class="prev_price text-light">
<s><i class="fas fa-pound-sign"></i>{{number_format($productdetail->price, 2)}}</s>
</div>
<?php
}
?>
<div class="discounted">
{{$cashback}}% CashBack
</div>
</div>
</div>
<div class="lowest_price_details">
<div class="d-flex align-items-center ft-10">
<span class="text-navyblue ft-medium">Lowest price in the last 45 days </span>
<i class="fas fa-caret-down ms-2 text-pink"></i>
</div>
<a href="javascript:void(0);" class="text-light ft-10" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
<u>Subscribe to get lowest price alerts</u>
</a>
<div class="text-light ft-10">
@if($msg=Session::get('success'))<span style="color:green">{{$msg}}</span>@endif</div>
</div>
<?php
if(Auth::check())
{
$email = '';
$user_id = auth()->user()->id;
$useremail = DB::table('users')->where('id',$user_id)->first();
$email = $useremail->email;
}
else
{
    $email = '';
}
?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="login" method="post" action="{{url('subscribealert')}}">
        @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Subscribe to get lowest price alerts</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="email" value="{{$email}}" placeholder="Email Id" name="email" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="color:#000;" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default" style="color:#000;">Submit</button>
      </div>
    </div>
    </form>
  </div>
</div>
<?php
$productvariantdata=DB::table('product_detail')->where('product_id',$product_id)->get();
$recodCount = count($productvariantdata);
$specdata_tmp = array();
if($recodCount>0)
{
$colorArr=[];
$new_unseriealized_array = '';

$usedCategoryArr = array();
$tempArr = array();
// echo "<pre>";
// print_r($productvariantdata);
// echo "</pre>";
foreach ($productvariantdata as $key => $val ) {
$variant_id = $val->id;
$spec_detail = $val->spec_detail;
$new_unseriealized_array = unserialize($spec_detail);
if(!empty($new_unseriealized_array ?? '')){
// echo "<pre>";
// print_r($new_unseriealized_array);
// echo "</pre>";
foreach($new_unseriealized_array ?? '' as $key=>$value)
{
    if($value)
    {
        if(in_array($key,$usedCategoryArr))
        {
            $tempArr[$key][]=$value;
        }
        else {
            $usedCategoryArr[]=$key;
             $tempArr[$key][]=$value;
         } 
        // echo "<br>Key: ".$key."<pre>";
        // print_r($value);
        // echo "</pre>";
    }
}
}
}

$spec_slug_arr = array();
$spec_slug_arr_temp = array();
$specdata = DB::table('specifications')
->select('*')
->whereRaw('FIND_IN_SET('.$category_id.',cat_id)')
->get();

    
foreach ($specdata as $specvalue) {
$spec_slug_arr[$specvalue->slug] = $specvalue;

}
$spec_slug_arr_temp = $spec_slug_arr;
// echo "<pre>";
// print_r($spec_slug_arr_temp);
// echo "</pre>";
foreach($tempArr as $res=>$res_val){
//$specdata=DB::table('specifications')->where('cat_id',$category_id)->get();

// echo "<pre>";
// print_r($res);
// echo "</pre>";
//if($res==$spec_slug)
    if(array_key_exists($res,$spec_slug_arr_temp))
{
    $specdata_tmp[]=$spec_slug_arr_temp[$res];
    foreach($res_val as $vl){
        array_push($colorArr,strtolower($vl));
        }
}
/*else if($key=='colors')
{
array_push($colorArr,strtolower($value));
}*/
else if(array_key_exists('vprice',$spec_slug_arr_temp))
{
    $specdata_tmp[]=$spec_slug_arr_temp['vprice'];
    foreach($res_val as $vl){
        array_push($colorArr,strtolower($vl));
        }
//array_push($colorArr,strtolower($value));
}

  
}

// echo "<pre>";
// print_r($tempArr);
// echo "</pre>";
}

if(!empty($specdata_tmp))
{
foreach ($specdata_tmp as $value) {
$specs_id = $value->id;
$specs_slug = $value->slug;                        
$newArr = $new_unseriealized_array ?? ''[$specs_slug]; //last array dynamic variant value
$vpriceArr = $new_unseriealized_array ?? ''['vprice']; //last array price variant value
$specs_name = $value->name; //Spec name ex:colors,size
$optiondata=DB::table('options')->where('specs_id',$specs_id)->get();
if(!empty($optiondata))
{
?>
<div class="color_filter my-5">
<p class="p_pt text-secondary">{{$specs_name}}: <!-- <span class="text-black ft-medium">Green</span> --></p>
<div class="d-flex align-items-center gap-3">
<?php
$optionvaluecount = 0;
foreach($optiondata as $key=> $optionvalue)
{
if($optionvalue->image!="")
{
if(in_array(strtolower($optionvalue->name), $colorArr))
{
if($optionvaluecount!=$optionvalue->specs_id)
{
$checked = "selectedvariant";
//print_r($optionvalue);
$spec = $optionvalue->specs_id;
//$specdetail = DB::table('specifications')->where('id',$spec)->first();
//$name = $specdetail->id;
?>
<a class="{{$checked}} cl1" href="javascript:void(0);" onclick="getvariant({{$product_id}}, '{{$optionvalue->name}}',this)" title="{{$optionvalue->name}}"><img title="{{$optionvalue->name}}" style="width: 30px;height: 30px;" class="color_filter" src="{{ asset('public/option/'.$optionvalue->image) }}"></a>
<!-- <input type="text" name="spec_detail" value="<?php //echo $optionvalue->name;?>"> -->
<?php
$optionvaluecount = $optionvalue->specs_id;
}
else{
?>
<a href="javascript:void(0);" title="{{$optionvalue->name}}" onclick="getvariant({{$product_id}},'{{$optionvalue->name}}',this)"><img title="{{$optionvalue->name}}" style="width: 30px;height: 30px;" class="color_filter" src="{{ asset('public/option/'.$optionvalue->image) }}"></a>
<?php
}
}
}
else
{
//jisme image nhi hai
if(in_array(strtolower($optionvalue->name), $colorArr))
{
if($optionvaluecount!=$optionvalue->specs_id)
{
$checked = "selectedvariant";
//print_r($optionvalue);
$spec = $optionvalue->specs_id;
?>
<a style="width: 200px;" class="ovar {{$checked}} cl1" onclick="getvariant({{$product_id}},'{{$optionvalue->name}}',this)" href="javascript:void(0);" title="{{$optionvalue->name}}" title="{{$optionvalue->name}}">{{$optionvalue->name}}</a>
<!-- <input type="text" name="spec_detail" value="<?php //echo $optionvalue->name;?>"> -->
<?php
$optionvaluecount = $optionvalue->specs_id;
}
else
{
?>
<a class="ovar" title="{{$optionvalue->name}}" onclick="getvariant({{$product_id}},'{{$optionvalue->name}}',this)" href="javascript:void(0);" title="{{$optionvalue->name}}">{{$optionvalue->name}}</a>
<?php
}
}
}
}
?>
</div>
</div>
<?php
}
}
}
?>
<?php if($productdetail->quantity>0) { ?>
<div class="p_quantity">
<div class="d-flex align-items-center">
<p class="m-0 ft-medium">Quantity:</p>
<div class="wrap ms-4">
<button type="button" id="sub" class="sub">-</button>
<input class="count quantity" step='1' type="text" readonly min="1" max="{{$productdetail->quantity}}" id="quantity" value="1" name="quantity"/>
<button type="button" id="add" class="add">+</button>
</div>
</div>
</div>
<div class="p_stock ft-10 mt-2 mb-3">
<span class="ft-medium">In Stock.</span> Ships in 24 hours
</div>
<?php
}
else
{
?>
<div class="p_stock ft-10 mt-2 mb-3">
<span class="ft-medium">Out Of Stock.</span>
</div>
<?php
}
?>
<?php
if($coupon_code!="")
{
?>
<div class="p_stock ft-10 mt-2 mb-3">
<span class="ft-medium">Available Coupon</span>
<a style="width:100px;" href="javascript:void(0)" data-coupon="{{$coupon->code}}" class="btn btn-primary py-0 ft-10 d-block mt-2">Copy Code</a>
</div>
<?php
}
?>
<div class="p_checkpincode">
<div class="d-flex ft-10 align-items-center">
<i class="fas fa-map-marker-alt text-navyblue ft-15"></i>
<div><input type="text" name="dilvPinCode" value="{{$pincode}}"> </div> <button
class="btn btn-default border ft-12" style="line-height:0rem"
id="checkPinCode">Check</button>&nbsp;
<p class="m-0">Check Postcode for Shipping & Delivery.</p>
</div>
<!--<span class="ft-10 mt-1 mb-4 d-block"><b>Delivery in</b> <u class="text-pink ft-medium">3
Days</u> if purchsed before <b>15 September</b> | Shipping <u
class="text-pink ft-medium">+£5</u> </span>-->
</div>
<div class="btns mt-5 mb-4">
<?php
if ($productdetail->quantity > 0)
{
    if(Auth::check())
{
    $product_cart_quantity = DB::table('cart')->where(array('product_id'=>$product_id,'status'=>0))->get();
    $product_cart_quantity_count = count($product_cart_quantity);
    if($product_cart_quantity_count<$productdetail->quantity)
    {
?>
<button class="btn_submit btn btn-default border ms-4 ft-bold" id="btnSubmit" type="button" onclick="addtocart()" style="background-color:#000;color:#fff;">Add To Cart</button>
<!-- <a href="{{url('/cart/addtoCart')}}/{{$productdetail->id}}"><button class="btn btn-default border ms-4 ft-bold">ADD TO CART</button></a> -->
<?php
}
else
{
?>
<button class="btn btn-default border ms-4 ft-bold" disabled="">Out Of Stock</button>
<?php
}
}
else
{
?>
<button class="btn btn-primary" type="button" onclick="cart()">Add To Cart</button>
<?php
}
}
?>
</div>
<img src="{{asset('/public/front')}}/img/guarantee.png" class="img-fluid" alt="">
</div>
</div>
<div class="h-50px "></div>
<div class="row pe-lg-5 my-5">
<div class="col-lg-6 pe-lg-5">
<div class="prod_specification">
<h3 class="ft-20 lh-30 ft-medium mb-5 text-black">Product Specification:</h3>
<div class="row ft-500">
<div class="col-md-12 text-secondary">
{!! $productdetail->short_desc !!}
</div>

</div>
</div>
</div>
<div class="col-lg-6 pe-lg-5">
<div class="bought_togther  py-5 px-4 border">
<h3 class="ft-20 lh-30 text-decoration-underline text-black text-center ft-medium">Bought Together</h3>
<div class="owl-carousel boxed_arrow boxed_arrow_black" id="boughtTogther">
<?php
$counttogetherproduct = count($boughttogetherproduct);
if($counttogetherproduct>1)
{
foreach ($boughttogetherproduct as $boughttogetherproductvalue) 
{
?>
<div class="item">
<div class="products_unit">
<input class="cbCheck" type="checkbox"  id="product<?php echo $boughttogetherproductvalue->id;?>" name="product<?php echo $boughttogetherproductvalue->id;?>" value="<?php echo $boughttogetherproductvalue->id;?>">
<div class="image">
<a href="{{url('product-detail/'.$boughttogetherproductvalue->slug)}}"><img style="height: 87px;" src="{{ asset('public/products/'.$boughttogetherproductvalue->image) }}" class="img-fluid" alt="{{$boughttogetherproductvalue->slug}}"></a>
</div>
<div class="products_desc">
<div class="p_name">
<a href="{{url('product-detail/'.$boughttogetherproductvalue->slug)}}">{{$boughttogetherproductvalue->name}}</a>
</div>
<div class="p_rating d-flex align-items-center gap-2">
@php
$boughtrating_data = Review::getRatingAverage($boughttogetherproductvalue->id);
@endphp
<div class="ratingofprod">
<div class="ratinga2">
<div class="ratinga" data-value="{{$boughtrating_data['rating']}}"></div>
</div>
</div> 
<span>({{$boughtrating_data['reviews']}})</span>
</div>
<div class="d-flex align-items-center">
<div class="p_price">
<i class="fas fa-pound-sign"></i> {{$boughttogetherproductvalue->price}}
</div>
<div class="p_offer">
{{$boughttogetherproductvalue->cashback}}% Cashback
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
</div>
<div class="d-flex align-items-center flex-wrap justify-content-center">
<div class="addon_prod_count d-flex align-items-center"></div>
<?php
if ($productdetail->quantity > 0)
{
    if(Auth::check())
{
    $product_cart_quantity = DB::table('cart')->where(array('product_id'=>$product_id,'status'=>0))->get();
    $product_cart_quantity_count = count($product_cart_quantity);
    if($product_cart_quantity_count<$productdetail->quantity)
    {
?>
<div class="addon_cart ms-4 mt-4">
   <a href="#" class="btn-submit btn btn-default border ft-medium ft-bold">ADD TO CART</a>
</div>
<?php
    }
    else
    {
    ?>
    <button disabled class="btn btn-default border ft-medium ft-bold">Out Of Stock</button>
    <?php
    }
    }
}
?>
</div>
</div>
<div class="Questions_Asked  p-5 border mt-4">
<div class="d-flex align-items-center justify-content-between">
<h3 class="ft-20 lh-30 text-black ft-medium">Questions Asked:</h3>
<!--<p class="m-0 ft-10 text-secondary lh-15">(Showing 1-3 of 30)</p>-->
</div>
<!--<div class="QA_helpful mb-4 mt-3">
<select name="" id="" class="border-dark">
<option value="0">Most Helpful</option>
<option value="1">Battery</option>
<option value="2">Camera</option>
<option value="3">Screen</option> 
</select>
</div>-->
<div class="question_answer ft-500 ft-10 lh-15 my-5">
<?php
$product_faq = DB::table('faq')->WhereRaw("product_id=$product_id and status=1")->get();
$faqcount = count($product_faq);
if($faqcount>0)
{
foreach($product_faq as $faqresult)
{
?>
<div class="question_set">
Q- <span class="text-navyblue">{!! strip_tags($faqresult->question) !!}</span>
</div>
<div class="answer_set my-1">A- {!! strip_tags($faqresult->answer) !!}</small>
</div>
<?php
}
}
else
{
?>
<div style="text-align:center;" class="alert alert-danger">No FAQ for this product</div>
<?php
}
?>

</div>
</div>
<br>
<div style="text-align: center;background-color: #fff;color: #000;border-color: #000;text-align:center;" class="alert alert-primary">Have Another Question? <a style="color:#000;" href="mailto:<?php echo $seller_email;?>">Email this seller</a></div>
</div>
</div>

<div class="h-50px "></div>
<div class="prod_detail_desc shadow p-5">
<h3 class="ft-20 lh-30 text-center pb-5 ft-medium">Product Description:</h3>
{!! $productdetail->description !!}
</div>
<div class="prod_ratings_reviews border my-5 p-5">
<h3 class="ft-20 lh-30 pb-5 ft-medium">Product Rating & Reviews:</h3>
@php
$review_data = Review::fetchRatingStats($product_id);
$total_rating = $review_data['totalrating'];
@endphp                    
<div class="row">
<div class="col-lg-11 mx-auto shadow p-5">
<div class="row align-items-center justify-content-center">
<div class="col-3 col-md-2 col-xl-1">
<div class="rating_list">
<div class="d-flex">
<div class="number_rating ft-medium ft-20">
{{number_format($review_data['averagerating'],1)}} <i class="fas fa-star text-yellow "></i><br>
<p class="ft-8 lh-10 text-light mt-3">{{$review_data['totalrating']}} Ratings & {{$review_data['review_count']}} Reviews</p>
</div>
</div>
</div>
</div>
<div class="col-9 col-md-4 col-xl-3">
<div class="pe-lg-5">
@php
foreach($review_data['countperrating'] as $countperrate){
$progress_rating = ($countperrate->countrate * 100) / $total_rating;

@endphp

<div class="d-flex align-items-center gap-2">
<span class="d-flex align-items-end lh-10">{{$countperrate->rating}}<i class="fas fa-star text-yellow ft-10"></i></span>
<div class="progress w-100">
<div class="progress-bar  bg-success" role="progressbar" style="width: {{$progress_rating}}%" aria-valuenow="{{$countperrate->countrate}}" aria-valuemin="0" aria-valuemax="{{$total_rating}}"></div>
</div>
<span>{{$countperrate->countrate}}</span>
</div>
@php
}


@endphp

</div>
</div>
<!--<div class="col-xl-8 px-lg-5 my-5 my-xl-0">-->
<!--    <div class="d-flex justify-content-lg-between justify-content-center flex-wrap">-->
<!--        <div class="number_rating_progress">-->
<!--            <div class="svg_cntr"><svg class="ratings_progress" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34" data-rating="4.5">-->
<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__background" />-->

<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__progress -->
<!--                            js-progress-bar" />-->
<!--                </svg>-->
<!--            </div>-->
<!--            <p>Camera</p>-->
<!--        </div>-->
<!--        <div class="number_rating_progress">-->
<!--            <div class="svg_cntr"><svg class="ratings_progress" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34" data-rating="3.5">-->
<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__background" />-->

<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__progress -->
<!--                            js-progress-bar" />-->
<!--                </svg>-->
<!--            </div>-->
<!--            <p>Battery</p>-->
<!--        </div>-->
<!--        <div class="number_rating_progress">-->
<!--            <div class="svg_cntr"><svg class="ratings_progress" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34" data-rating="2.5">-->
<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__background" />-->

<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__progress -->
<!--                            js-progress-bar" />-->
<!--                </svg>-->
<!--            </div>-->
<!--            <p>Display</p>-->
<!--        </div>-->
<!--        <div class="number_rating_progress">-->
<!--            <div class="svg_cntr"><svg class="ratings_progress" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34" data-rating="4.0">-->
<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__background" />-->

<!--                <circle cx="16" cy="16" r="15.9155"-->
<!--                     class="progress-bar__progress -->
<!--                            js-progress-bar" />-->
<!--                </svg>-->
<!--            </div>-->
<!--            <p>Reasonable</p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
</div>
@php
if(Auth::check())
{
$user_id = auth()->user()->id;
$unrated_product = OrderDetail::checkLoggedNotRated($user_id,$product_id);
if(!empty($unrated_product)){
@endphp
<div class="rate_product_btn mt-5 text-center">
<a href="{{url('/order-detail/')}}/{{$unrated_product->order_id}}" class="btn btn-default ft-medium text-black-btn  border shadow ft-20 py-4 px-5">Rate this Product</a>
</div>
@php } } @endphp                            
</div>
<div class="col-lg-11 mx-auto pt-5 mt-5 px-lg-0">
<div class="sortby_reviews">
<select name="sortbyreview" class="shadow sortbyreview">
<option value="">Sort By</option>
<option value="1">Positive</option>
<option value="2">Negative</option>
<option value="3">Helpful</option>
<option value="4">Latest</option>
</select>
</div>
<div class="users_reviews my-5">
@php                                
$reviews = Review::fetchReviews($product_id);
foreach($reviews as $review){
$rateuser = DB::table('users')->where('id',$review->user_id)->first();
@endphp                               
<div class="users_reviews_list py-5">
<div class="title d-flex align-items-end">
<h3 class="ft-20 lh-30 ft-medium m-0">“{{$review->title}}”</h3>
<p class="ft-10 mb-md-0 ms-4"><b>{{$rateuser->name}}</b> rated &nbsp;&nbsp; {{$review->rating}}<i class="fas fa-star text-yellow "></i></p>
</div>
<div class="users_reviews_pics d-flex flex-wrap gap-5 my-5">
@php
$reviewimages = explode(",",$review->images);
foreach($reviewimages as $reviewimage){
@endphp
<a href="{{asset('/public/front')}}/img/{{$reviewimage}}" data-lightbox="usersreviewspics1">
<img src="{{asset('/public/front')}}/img/{{$reviewimage}}" class="img-fluid" alt="">
</a>

@php
}
@endphp

</div>
<div class="users_reviews_desc ft-medium text-black">
{{$review->review}}
</div>
@php                                    
if(Auth::check())
{
$responses = LikeDislikeReview::fetchlikeDislike($review->id);
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
$userresponses = LikeDislikeReview::fetchUserResponse($review->id,$user_id);
if(empty($userresponses)){
$userresponse = 0;
}else{
$userresponse = $userresponses->response;
}
@endphp

<div class="users_reviews_likebox ft-medium text-black d-flex align-items-center mt-5">
<div class="r_likebox d-flex align-items-center">

<label class="likebox_radio" onclick="likeReview(1,{{$review->id}})" >
<input type="radio" name="likeboxradio" @php echo($userresponse == 1)? "disabled":"" @endphp>
<i class="fa fa-thumbs-up" style="color:black" aria-hidden="true" ></i></label>
<p class="m-0 text-secondary ms-3">{{$likecount}}</p>
</div>
<div class="r_likebox d-flex align-items-center ms-5">
<label class="likebox_radio" onclick="likeReview(2,{{$review->id}})">
<input type="radio" name="likeboxradio" @php echo($userresponse == 2)? "disabled":"" @endphp>
<i class="fa fa-thumbs-down " aria-hidden="true" style="color:black"></i></label>
<p class="m-0 text-secondary ms-3">{{$dislikecount}}</p>
</div>

</div>
@php } @endphp                                    
</div>

@php
}
@endphp                                


</div>
<div class="sell_all_reviews text-center">
<button type="button" value='2' class="btn btn-large btn-default shadow border ft-20 text-black-btn border-dark ft-medium loadmorereview">
See All Reviews <i class="fa fa-caret-down"></i>
</button>
</div>
</div>
</div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<section id="" class="slider_sec shadow-set px-30 mb-4 py-20 pb-4">
<div class="row align-items-center">
<div class="col-lg-3 pb-5 pb-lg-0">
<h3 class="ft-25 text-black m-0">Similar<br> Products for you</h3>
</div>
<div class="col-lg-9">
<div class="owl-carousel boxed_arrow boxed_arrow_black product_slider" id="similarProd">
<?php
foreach($similarproduct as $relatedproduct)
{
?>
<div class="item">
<div class="products_unit">
<div class="image">
<a href="{{url('product-detail/'.$relatedproduct->slug)}}"><img src="{{ asset('public/products/'.$relatedproduct->image) }}" class="img-fluid" alt=""></a>
</div>
<div class="products_desc">
<div class="p_price">
<i class="fas fa-pound-sign"></i>{{$relatedproduct->price}}
</div>
<div class="p_offer ft-10-important lh-12-important">
{{$relatedproduct->cashback}}% Cashback
</div>
<div class="p_name mt-2">
<a href="{{url('product-detail/'.$relatedproduct->slug)}}" class="ft-10 text-secondary">{{$relatedproduct->name}}</a>
</div>
<div class="p_rating d-flex align-items-center gap-2">
@php
$relatedrating_data = Review::getRatingAverage($relatedproduct->id);
@endphp
<div class="ratingofprod">
<div class="ratinga2">
<div class="ratinga" data-value="{{$relatedrating_data['rating']}}"></div>
</div>
</div> 
<span>({{$relatedrating_data['reviews']}})</span>
</div>
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>
</section>
<?php if(!empty($recentlyViewedProducts)){ ?>
<section id="" class="slider_sec shadow-set px-30 mb-4 py-20 pb-4">
<div class="row align-items-center">
<div class="col-lg-3 pb-5 pb-lg-0">
<h3 class="ft-25 text-black m-0">Recently<br> Viewed</h3>
</div>
<div class="col-lg-9">
<div class="owl-carousel boxed_arrow boxed_arrow_black product_slider" id="similarProd">
<?php
foreach ($recentlyViewedProducts as $leftproduct) 
{
?>
<div class="item">
<div class="products_unit">
<div class="image">
<a href="{{url('product-detail/'.$leftproduct->slug)}}"><img src="{{ asset('public/products/'.$leftproduct->image) }}" class="img-fluid" alt=""></a>
</div>
<div class="products_desc">
<div class="p_price">
<i class="fas fa-pound-sign"></i>{{$leftproduct->price}}
</div>
<div class="p_offer ft-10-important lh-12-important">
{{$leftproduct->cashback}}% Cashback
</div>
<div class="p_name mt-2">
<a href="{{url('product-detail/'.$leftproduct->slug)}}" class="ft-10 text-secondary">{{$leftproduct->name}}</a>
</div>
@php
$recentProductReview = Review::getRatingAverage($leftproduct->id);
@endphp                
<div class="p_rating d-flex align-items-center gap-2">
<div class="ratingofprod">
<div class="ratinga2">
<div class="ratinga" data-value="{{$recentProductReview['rating']}}"></div>
</div>
</div> 
<span>({{$recentProductReview['reviews']}})</span>
</div>
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>
</section>
<?php
}
?>
<div class="h-50px d-none d-lg-block"></div>

</div>
</div>
</div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px "></div>
<style type="text/css">
img.color_filter {
border-radius: 5px;
display: block;
width: 30px;
height: 30px;
box-shadow: 0px 0px 8px rgb(0 0 0 / 25%);
}
a.ovar {
font-size: 1rem;
text-align: center;
border-radius: 5px;
line-height: 30px;
padding: 0 10px;
width: 200px;
border: 1px solid #ccc;
margin: 1px;
}
.selectedvariant img{
border: 2px solid #000;
}
a.ovar.selectedvariant{
border: 2px solid #000;   
}
a.ovar.disabled {
pointer-events: none;
color: #ccc;
}
input[type="button"] { border: none; }
input[type="button"].is-disabled { background: red; }
#loadmsgpromo{
text-align: center;
}
[name="sortbyreview"]{
    background: url(data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0Ljk1IDEwIj48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2ZmZjt9LmNscy0ye2ZpbGw6IzQ0NDt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPmFycm93czwvdGl0bGU+PHJlY3QgY2xhc3M9ImNscy0xIiB3aWR0aD0iNC45NSIgaGVpZ2h0PSIxMCIvPjxwb2x5Z29uIGNsYXNzPSJjbHMtMiIgcG9pbnRzPSIxLjQxIDQuNjcgMi40OCAzLjE4IDMuNTQgNC42NyAxLjQxIDQuNjciLz48cG9seWdvbiBjbGFzcz0iY2xzLTIiIHBvaW50cz0iMy41NCA1LjMzIDIuNDggNi44MiAxLjQxIDUuMzMgMy41NCA1LjMzIi8+PC9zdmc+) no-repeat 100% 50%;
    -moz-appearance: none;
    -webkit-appearance: none; 
    appearance: none;
    padding-right: 50px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$("#checkPinCode").click(function() {
$("#checkProdDel").remove();
var product_id = '{{$productdetail->id}}';
var dilvPinCode = $("input[name=dilvPinCode]").val();
if (dilvPinCode == '') {
alert('Please enter postcode');
} else {
$.ajax({
type: "post",
url: "{{url('/checkpincode')}}",
data: {
"product_id": product_id,
"pincode": dilvPinCode,
_token: '{{csrf_token()}}'
},
success: function(data) {
    //alert(data);
$("#checkProdDel").remove();
pd = JSON.parse(data);
var delCost = pd[1];
if(delCost!='')
{
    delCost=' | Cost: <b>£'+delCost+'</b>';
}
else
{
    delCost='';
}
if (data != 0) {
$(".p_checkpincode").after(
'<div id="checkProdDel" class="ft-12" style="color:green">We can delivered in this area.</span><br><span class="ft-10 mt-1 mb-4 d-block">Delivery in <u class="text-pink ft-medium">5-7 Days</u> '+delCost+'  </div>'
);
} else {
$('.btn_submit').attr('disabled', true);
$(".p_checkpincode").after(
'<span id="checkProdDel" class="ft-12" style="color:red">“ Sorry, we are currently not serving your area. You can try another Postcode ”</span>'
);
}
}
/*success: function(data) {
$("#checkProdDel").remove();
if (data == 1) {
$("#checkPinCode").after(
'<span id="checkProdDel" class="ft-12" style="color:green">We can delivered in this area.</span>'
);
} else {
$("#checkPinCode").after(
'<span id="checkProdDel" class="ft-12" style="color:red">We can not delivered in this area.</span>'
);
}
}*/
});
}
})
$("[type='number']").keypress(function (evt) {
evt.preventDefault();
});
//$("div.p_quantity:not(.buttons_added), td.p_quantity:not(.buttons_added)").addClass('buttons_added').append('<button type="button" class="add">+</button>').prepend('<button type="button" id="sub" class="sub">-</button>');
$("input.count:not(.product-quantity input.count)").each(function() {
var min = parseFloat($(this).attr('min'));
if (min && min > 0 && parseFloat($(this).val()) < min) {
$(this).val(min);
}
});
$(document).on('click', '.add, .sub', function() {
var qty = $(this).closest('.p_quantity').find(".count");
var currentVal = parseFloat($qty.val());
//alert(currentVal);
var max = parseFloat($qty.attr('max'));
var min = parseFloat($qty.attr('min'));
var step = $qty.attr('step');
if (!currentVal || currentVal == "" || currentVal == "NaN") currentVal = 0;
if (max == "" || max == "NaN") max = '';
if (min == "" || min == "NaN") min = 0;
if (step == 'any' || step == "" || step == undefined || parseFloat(step) == "NaN") step = 1;
if ($(this).is('.add')) {
if (max && (max == currentVal || currentVal > max)) {
$qty.val(max);
} else {
$qty.val(currentVal + parseFloat(step));
}
} else {
if (min && (min == currentVal || currentVal < min)) {
$qty.val(min);
} else if (currentVal > 0) {
$qty.val(currentVal - parseFloat(step));
}
}
$qty.trigger('change');
});
//
// My JS
// 
$.fn.disableNumberButtons = function() {
var value = this.val();
var sub = this.prev();
var minAttr = this.attr('min');
var min = (minAttr) ? minAttr : 0;
(value > min) ? sub.removeClass('is-disabled'): sub.addClass('is-disabled');
var add = this.next();
var maxAttr = this.attr('max');
var max = (maxAttr) ? maxAttr : 999;
(value < max) ? add.removeClass('is-disabled'): add.addClass('is-disabled');
}
$('input.count').each(function() {
$(this).disableNumberButtons();
});
$('input.count').change(function() {
$(this).disableNumberButtons();
});
$(document).ready(function() {
// alert($('.cl1').attr('class'));
$('.cl1').trigger('click');
});
var pricevalue = 0;
function getvariant(product_id,optionvalue,param){
//alert(optionvalue);
var thatis = $(param);
$(thatis).parent().find('.selectedvariant').removeClass('selectedvariant');
$(thatis).addClass('selectedvariant');
$.ajax({
type: "post",
url: "{{url('/product-varient-data')}}",
data:{"product_id":product_id, _token: '{{csrf_token()}}',"optionvalue":optionvalue},
success: function(data){
var dataprice = data.toString().split('-'); 
// $("#priceSpan").text(dataprice[0]); 
priceSpan = dataprice[0];
variantId = dataprice[1];
//Product Gallery Image Start
$.ajax({
    url:'{{url("/getvariantimage")}}',
    type:"post",
    data:{'product_id':product_id,'variantId':variantId,_token: '{{csrf_token()}}'},
    success:function(data)
    {
        //alert(data);
        $('#galleryvariant').html(data);
    }
});
//Product Gallery Image End

}
})
}
@php
if(Auth::check())
{
$user_id = auth()->user()->id;
}
else
{
$user_id = "";
}
@endphp
function addtocart(){
    if(!pincode) {
        alert('Please fill your profile informations!');
        window.location.href = '/update-profile';
        return;
    } 
    var user_id = '{{$user_id}}';
    var quantity = $('.quantity').val();
    var price = priceSpan;
    var variantIds = variantId;
    var cashback = '{{$cashback}}';
    //alert(variantIds);
    //alert(price);
    var product_id = '{{$productdetail->id}}';
    var variantarray = [];
    $('.selectedvariant').attr('title');
    $('.selectedvariant').each(function(){
    variantarray.push($(this).attr('title'));
    });
    //alert(variantarray);
    $.ajax({
    type: "post",
    url: "{{url('/cart/addtoCart')}}",
    data:{"product_id":product_id, pincode: pincode, _token: '{{csrf_token()}}',"variantarray":variantarray,"quantity":quantity,"price":price,"user_id":user_id,"variantIds":variantIds,"cashback":cashback},
    success: function(data){
      if(data=='no')
      {
        //$('#frontID').text('No Variant For This Product')
        alert("No Variant for this product");
        location.reload();
      }
      else{
        window.location.href='{{url("/cart")}}';
      }
    }
    })
    $("#btnSubmit").attr("disabled", true);
}
$(".loadmorereview").click(function(){

let clickcount = $(this).val();
let product_id = '{{$product_id}}';
let sortby = $(".sortbyreview").val();

$.ajax({
type: "post",
url: "{{url('load-more-reviews')}}",
data:{"click":clickcount,"product_id":product_id,"sortby":sortby, _token: '{{csrf_token()}}'},
success: function(data){
let nextcount = parseInt(clickcount) + 1;
document.querySelector(".loadmorereview").value = nextcount;

$(".users_reviews").append(data);

}
})

})
$(".sortbyreview").change(function(){
let sortby = $(this).val();
let product_id = '{{$product_id}}';


$.ajax({
type: "post",
url: "{{url('/sortby-review')}}",
data:{"product_id":product_id,"sortby":sortby, _token: '{{csrf_token()}}'},
success: function(data){


$(".users_reviews").html(data);

}
})
})
function likeReview(res,review_id){
var user_id = '{{$user_id}}';

$.ajax({
type: "post",
url: "{{url('/like-dislike-review')}}",
data:{"user_id":user_id,"response":res,"review_id":review_id, _token: '{{csrf_token()}}'},
success: function(data){
window.location.reload();
}
})
}
</script>
<script>
$("[data-coupon]").click(function(event) {
var $tempElement = $("<input>");
$("body").append($tempElement);
$tempElement.val($(this).attr('data-coupon')).select();
document.execCommand("Copy");
$tempElement.remove();
$(this).text($(this).attr('data-coupon'));
alert("Copied successfully");
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$(".btn-submit").click(function(){
$('.cbCheck:checkbox:checked').each(function(){
var product_id = $(this).val();
//alert(product_id);
var quantity = 1;
var user_id = '{{$user_id}}';
//alert(user_id);
$.ajax({
type: "post",
url: "{{url('/cart/boughtaddtoCart')}}",
data:{"product_id":product_id, _token: '{{csrf_token()}}',"quantity":quantity,"user_id":user_id},
success: function(data){
window.location.href='{{url("/cart")}}';
}
})
});
});            
});
$('body').on('click','.smallimage_list',function() {
var datasrc = $(this).attr('data-src');
var dataid = $(this).attr('data-id');
$('.big_image img').attr('src', datasrc).attr('data-id', dataid);
});
$('body').on('click','.big_image',function() {
var dataid = $(this).find('img').attr('data-id');
$('.lightbox_gallery a[data-id="' + dataid + '"]').trigger('click');
});
</script>
<script>
    $('.cbCheck').on('click',function(){
   // $('.addon_prod_count').animate({scrollLeft: $('.addon_prod_count').position().left}, 500);
    
    var adwidth = $('.addon_prod_count').width();
     $('.addon_prod_count').animate({scrollLeft: adwidth}, 500);
   });
</script>    
@include('front.include.footer')
@yield('footer')