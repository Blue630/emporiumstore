@include('front.include.header')
@yield('header')   
<?php
use App\Review;
?>
<!-- content area start -->
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
<div class="row">
<div class="col-lg-12 ps-lg-5">
<div class="breadcrumb_box">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">All Best Sellers</li>
</ol>
</nav>
</div>

<!-- product listing -->
<div class="product_grid product_wrapper">
<div class="row">
<?php
$paginationorders = '';
$allsellers = DB::table('sellers')->orderBy('id','desc')->get();
foreach($allsellers as $seller_result)
{
$seller_id = $seller_result->user_id;
$seller_store_name = $seller_result->storename;
$newseller_id = implode(",",(array)$seller_id);
$x = explode(",",$newseller_id);
$seller_data = DB::table('users')->where('id',$x)->get();
foreach($seller_data as $seller_result1)
{
$seller_name = strtolower($seller_result1->name);
$seller_u_id = $seller_result1->u_id;
$seller_business_type = $seller_result->business_type;
$paginationorders = DB::table('order_detail')->where('seller_id',$x)->groupBy('order_id')->paginate(12);
$totalsellerorders = DB::table('order_detail')->where('seller_id',$x)->groupBy('order_id')->get()->count();
if($totalsellerorders>5)
{
?>
<div class="col-lg-4 col-md-4 col-8">
<div class="products_unit">
<div class="image">
<a href="{{url('best-seller-product/'.$seller_result1->u_id)}}">
    <?php
    if($seller_business_type=='Individual')
    {
    ?>
    <img src="{{asset('/public/front')}}/img/businessemporium.jpg" class="img-fluid" alt="{{$seller_name}}">
    <?php
    }
    else
    {
    ?>
    <img src="{{asset('/public/front')}}/img/businessemporium.jpg" class="img-fluid" alt="{{$seller_name}}" />
    <?php
    }
    ?>
</a>
</div>
<div class="products_desc">
<div class="p_name">
<a href="{{url('best-seller-product/'.$seller_result1->u_id)}}">{{$seller_store_name}}</a>
</div>
</div>
</div>
</div>
<?php
}
}
}
?>
</div>
</div>
<!-- product listing end -->
<!-- pagination -->
<br>
<br>
<hr>

<br>
<br>
<!-- pagination end-->
</div>
</div>
</div>
<div class="h-50px "></div>
@include('front.include.footer')
@yield('footer')