@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
<div class="row">
<div class="col-lg-3" id="product_aside_bar">
<aside id="product_aside">
<div class="close_aside_toggle cusror-pointers float-end d-lg-none my-4">
<i data-feather="x-circle"></i>
</div>
<div class="w-100 clearfix"></div>
<div class="related_cat d-none d-lg-block text-black">
<h3 class="ft-20 lh-30 text-black">Related Categories</h3>
<div class="parent_submenu text-black">
<ul class="list-unstyled ft-15 lh-22 text-secondary">
<?php
$subcategorycount = count($subcategory);
if($subcategorycount>0)
{
foreach ($subcategory as $subcategory_value) 
{
?>
<li><a href="{{url('subcategory/'.$subcategory_value->slug)}}" class="ft-bold active">{{$subcategory_value->name}}</a></li>
<?php
}
}
?>

</ul>
</div>
</div>


<div id="filters">
<form name="sortbyfrm" id="sortbyfrm" method="get">
<div class="accordion" id="accordion_prod">
<?php
$a = 0;
$specifications = DB::table('specifications')->get();
/*$specdata = DB::table('specifications')
->select('*')
->whereRaw('FIND_IN_SET('.$parent_id.',cat_id)')
->get();*/
foreach ($specifications as $allspecifications) 
{
$a++;
$spec_id = $allspecifications->id;
?>
<div class="accordion-item  border-0 OperatingSystem_filter checkbox_filter">
<h2 class="accordion-header" id="heading<?php echo $a;?>">
<button class="accordion-button collapsed ft-20 lh-30 ft-500" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $a;?>" aria-expanded="false" aria-controls="collapse<?php echo $a;?>">
{{$allspecifications->name}}
<i data-feather="minus"></i>
<i data-feather="plus"></i>
</button>
</h2>
<div id="collapse<?php echo $a;?>" class="accordion-collapse collapse ps-4 text-secondary" aria-labelledby="heading<?php echo $a;?>">
<div class="accordion-body">
<div class="checkbox_filter_listing">
<?php
$aa="";
$aas = array();
if(isset($_REQUEST['sortby'])){


foreach ($_REQUEST as $key => $value) {
foreach ($value as $k => $val) {
$aas[] = $val;  
}
}
}
$options = DB::table('options')->where('specs_id',$spec_id)->get();
foreach ($options as $key => $alloptions) 
{
$option_name = $alloptions->name;
if(in_array($option_name,$aas))
{
$checked ="checked ";
}
else
{
$checked ="";
}
?>
<div class="checkbox">
<label for="{{$option_name}}">
<input type="checkbox" <?php echo $checked;?> onchange="javascript:document.getElementById('sortbyfrm').submit();" id="{{$option_name}}" name="{{$allspecifications->name}}[]" value="{{$option_name}}">
<span>{{$option_name}}</span>
</label>
</div>
<?php
}
?>
</div>
</div>
</div>
</div>
<?php
}
?>

</div>
</form>
</div>


</aside>
</div>


<div class="col-lg-9 ps-lg-5 bg-Heart">
<div class="aside_toggle cursor-pointer my-4 d-lg-none">
<i data-feather="arrow-right-circle"></i> Advance Filter
</div>

<div class="breadcrumb_box">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{url('/auction-listing')}}">Current Auctions</a></li>
<li class="breadcrumb-item active" aria-current="page">Current Auctions Details</li>
</ol>
</nav>
</div>
<h1 class="mt-5">Current Auctions</h1>
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<!-- product listing -->

<div class="product_wrapper">
<div class="Auct_img mb-5 shadow bg-white">
<img src="{{ asset('public/products/'.$auctiondetail->image) }}" class="img-fluid d-block mx-auto" style="width:35%" alt="">
</div>
<div class="row gx-5">
<div class="col-lg-8">
<h3 class="ft-26 ft-medium text-grey mb-4">{{$auctiondetail->name}}</h3>
<div class="gx-5 row gap-2 gap-md-0">
<div class="col-md-3 col-lg-3">
<div class="text-center p-4 radius-5 border border-grey shadow-sm  bg-white">
<h4 class="ft-15 ft-500 text-grey mb-3">Starting Bid</h4>
<p class="ft-25 ft-medium m-0 text-black">£ {{$auctiondetail->minimum_cost}}</p>
</div>
</div>
<div class="col-md-9 col-lg-9">
<div class="d-flex justify-content-center align-items-center h-100 radius-5 border border-grey shadow-sm overflow-hidden  bg-white">
<span id="future_datep"></span>
</div>

<script type="text/javascript ">
$(function() {
$('#future_datep').countdowntimer({
dateAndTime: '{{date_format(date_create($auctiondetail->auction_time),"Y/m/d H:i:s")}}',
labelsFormat: true,
displayFormat: "DHMS "
});

});
</script>
</div>
@php 
$auction_end =  date_create($auctiondetail->auction_time);
$auction_end = date_format($auction_end,"F d, Y  h:iA");
@endphp
<div class="col-12">
<p class="ft-12 ft-medium text-grey ft-300 my-3">Auction ends on  <strong class="text-black">{{$auction_end}} ,</strong> Timezone <strong class="text-black">{{date_default_timezone_get()}}</strong></p>
<div class="alert alert-success d-inline-block px-4 py-3 ft-12 text-black">
Reserve price has not been met
</div>
</div>
</div>
<style>

</style>
<div class="row gx-5 align-items-center mt-4  gap-3 gap-md-0">
@php
$already_bid = false;
//if(Session()->has('logged_user')){
//$user_session = session('logged_user');
//$user_id = $user_session->id;
if(Auth::check())
{
$user_id = auth()->user()->id;
$existbid = DB::table('biddings')->where(array('user_id'=>$user_id,'auction_id'=>$auctiondetail->aid))->count();

if($existbid != 0){
$already_bid = true;
}
}
@endphp
<div class="col-md-8">
<form method="post" action="{{url('/add-bid')}}">
@csrf
<div class="d-flex  gap-5">
<div class="p_quantity">
<div class="d-flex align-items-center h-100">
<div class="wrap2 p-0 h-100 ft-25-important align-items-center">
<input type="hidden" name="auction_id" value="{{$auctiondetail->aid}}">
<input type="hidden" name="product_id" value="{{$auctiondetail->pid}}">
<button type="button" id="sub" class="sub">-</button>
<span style="width: 10px;" class="ft-medium ms-2 ft-25">£</span>
<input class="count ft-medium ft-25-important border-0 text-center bg-transparent" type="text" id="1" value="{{$auctiondetail->minimum_cost}}" min="{{$auctiondetail->minimum_cost}}" style="width:75px" name="bid_amount">
<button type="button" id="add" class="add">+</button>
</div>
</div>
</div>
<div class="btns">
@php if($already_bid == false){ @endphp
<button type="submit" class=" btn btn-primary ">Submit Bid</button>
@php    }else{ @endphp
<span style="color:red">You have already added bid for this auction</span>
@php } @endphp
</div>
</div>
</form>
</div>
<div class="col-md-4">
<?php
if(Auth::check())
{
$user_id = auth()->user()->id;
?>
<style>
.btn-wishlist:not(:disabled) {
cursor: pointer;
background-color: #fff;
border: none;
}
.fa{
color:red;
}
.fa-heart{
font-size:25px;
}
</style>
<button title="Add to Wish List" data-toggle="tooltip" type="button" class="btn-wishlist" href="javascript:void(0);" onClick="addwishlist('<?php echo $auctiondetail->pid; ?>');">
<?php
$wishlist = DB::table('wishlist')->where(array('user_id'=>$user_id,'status'=>1,'product_id'=>$auctiondetail->pid))->get();
$countwishlist = count($wishlist);
if($countwishlist>0)
{
?>
<div class="p_wishlist position-relative d-flex align-items-center justify-content-md-center justify-content-end gap-3">
<i class="fa fa-heart"></i> <span class="ft-15-important ft-500 d-lg-none d-xl-block">Wishlisted</span>
</div>
<?php
}
else
{
?>
<div class="p_wishlist position-relative d-flex align-items-center justify-content-md-center justify-content-end gap-3">
<i class="far fa-heart"></i> <span class="ft-15-important ft-500 d-lg-none d-xl-block">Add to Wishlist</span>
</div>
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
<!--<div class="p_wishlist position-relative d-flex align-items-center justify-content-md-center justify-content-end gap-3">-->
<!--    <label for="">-->
<!--        <input type="checkbox" id="">-->
<!--        <i class="far fa-heart text-danger"></i>-->
<!--        <i class="fas fa-heart"></i>-->
<!--    </label> <span class="ft-15-important ft-500 d-lg-none d-xl-block">Add to Wishlist</span>-->
<!--</div>-->
</div>
</div>

<div class="border py-4 shadow-sm my-5  bg-white">
<div class="row g-0">
<div class="col-lg-4 bg-grey ft-12 p-4 text-end">
ITEM DESCRIPTION
</div>
</div>
<div class="px-4">
<div class="pt-4 px-5 text-grey ft-12">
{!! $auctiondetail->description !!}

<!--<div class="item-condition border-bottom py-2 d-inline-block">-->
<!--    Item Condition : <strong class="text-secondary">NEW</strong>-->
<!--</div>-->
<!--<p class="lh-30 my-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled-->
<!--    it to make a type specimen book. </p>-->
</div>
</div>
</div>


</div>
<div class="col-lg-4 ">
<div class="border py-4 shadow-sm  bg-white">
<div class="row g-0">
<div class="col-lg-12 text-grey bg-grey ft-15 ft-medium p-3 text-center">
Specifications
</div>
</div>
<div class="px-4">
{!! $auctiondetail->short_desc !!}

</div>
</div>
@php 
$auction_start =  date_create($auctiondetail->acreated_at);
$auction_start_date = date_format($auction_start,"d F Y");
$auction_start_time = date_format($auction_start,"h:i A");
@endphp
<div class="text-end ft-12 mt-4">
Auction History: <strong class="text-black">Started {{$auction_start_date}}</strong><br> <strong class="text-black">{{$auction_start_time}}</strong>
</div>
</div>


</div>

</div>
<!-- product listing end -->

<!-- pagination -->
<br>
<br>
<!-- pagination end-->


</div>
</div>
</div>
<div class="h-50px "></div>
<script>
var min_cost =  '{{$auctiondetail->minimum_cost}}';
$('.add').click(function() {
var th = $(this).closest('.wrap2').find('.count');
th.val(+th.val() + 1);
});
$('.sub').click(function() {
var th = $(this).closest('.wrap2').find('.count');
if (th.val() > min_cost) th.val(+th.val() - 1);
});
</script>
<!-- content area End -->
@include('front.include.footer')
@yield('footer')