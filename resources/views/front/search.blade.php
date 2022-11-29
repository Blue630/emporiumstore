@include('front.include.header')
@yield('header')
<?php
use App\Review;
//$category_id = $category->id;
//$category_name = $category->catname;
//$category_slug = $category->slug;
?>
<!-- content area start -->
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
<div class="row">
<div class="col-lg-9 ps-lg-5">
<div class="breadcrumb_box">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
<li class="breadcrumb-item"><a href="#">{{ucfirst($searchdata)}}</a></li>
</ol>
</nav>
</div>
<!-- product listing -->
<div class="product_grid product_wrapper">
<div class="row">
<div id="loadmsgpromo" class="alert alert-primary alert_hideo">
</div>
<?php
$productcount = count($product);
if($productcount>0)
{
foreach($product as $product_result)
{
$product_id = $product_result->id;
?>
<div class="col-lg-3 col-md-4 col-6">
<div class="products_unit">
<div class="image">
<a href="{{url('product-detail/'.$product_result->slug)}}"><img src="{{ asset('public/products/'.$product_result->image) }}" class="img-fluid" alt=""></a>
</div>
<div class="products_desc">

<div class="p_wishlist">
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
<button title="Add to Wish List" data-toggle="tooltip" type="button" class="btn-wishlist" href="javascript:void(0);" onClick="addwishlist('<?php echo $product_result->id; ?>');">
    <?php
    $wishlist = DB::table('wishlist')->where(array('user_id'=>$user_id,'status'=>1,'product_id'=>$product_result->id))->get();
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

<div class="p_name">
<a href="{{url('product-detail/'.$product_result->slug)}}">{{$product_result->name}}</a>
</div>
<div class="p_rating d-flex align-items-center gap-2">
@php
$rating_data = Review::getRatingAverage($product_result->id);
@endphp
<div class="ratingofprod">
<div class="ratinga2">
    <div class="ratinga" data-value="{{$rating_data['rating']}}"></div>
</div>
</div> 
<span>({{$rating_data['reviews']}})</span>
</div>

<div class="p_price">
<i class="fas fa-pound-sign"></i> {{$product_result->price}}
</div>
<?php
$checkCashback = DB::table('cashbacks')->select('*')->whereRaw('FIND_IN_SET('.$product_id.',product_id)')->get();
foreach ($checkCashback as $cashback_res) {
$cashbackpercent = $cashback_res->cashback;
?>
<div class="p_offer">
{{$cashbackpercent}}% Cashback
</div>
<?php
}
?>
</div>
</div>
</div>
<?php
}
}
else
{
?>
<div style="text-align: center;" class="alert alert-danger">No product found.</div>
<?php
}
?>
</div>
</div>
<!-- product listing end -->
<!-- pagination -->
<br>
<br>
<hr>
{{-- Pagination --}}
<div class="d-flex justify-content-center">
{!! $product->links() !!}
</div>
<br>
<br>
<!-- pagination end-->
</div>
</div>
</div>
<style>
select {
    border: none;
}
</style>
<div class="h-50px "></div>
@include('front.include.footer')
@yield('footer')