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
<li class="breadcrumb-item active" aria-current="page">All Categories</li>
</ol>
</nav>
</div>

<!-- product listing -->
<div class="product_grid product_wrapper">
<div class="row">
<?php
$categoriescount = count($categories);
if($categoriescount>0)
{
foreach ($categories as $categories_value) 
{
?>
<div class="col-lg-4 col-md-4 col-8">
<div class="products_unit">
<div class="image">
<a href="{{url('category/'.$categories_value->slug)}}"><img src="{{ asset('public/category/'.$categories_value->categoryimg) }}" class="img-fluid" alt=""></a>
</div>
<div class="products_desc">
<div class="p_name">
<a href="{{url('category/'.$categories_value->slug)}}">{{$categories_value->catname}}</a>
</div>
</div>
</div>
</div>
<?php
}
}
else
{
?>
<div style="text-align: center;" class="alert alert-danger">No Category found.</div>
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
{!! $categories->links() !!}
</div>
<br>
<br>
<!-- pagination end-->
</div>
</div>
</div>
<div class="h-50px "></div>
@include('front.include.footer')
@yield('footer')