@extends('admin.layout.layout') @section('content')
@php
use App\Product;
use App\Category;
use App\Subcategory;
use App\Review;
@endphp
<!-- Content Wrapper. Contains page content -->
<style>
.content-header .breadcrumb {
margin-left: 20px;
}
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Ratings & Reviews</h1>
</div>
<!-- /.col -->
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Dashboard</li>
</ol>
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
<div class="container-fluid">
<div class="row">

<div class="col-lg-12">
<div class="card card-default">
<?php
$reviews = Review::fetchReviewsOnly($product_id);
$review_count = count($reviews);
if($review_count>0)
{
foreach($reviews as $review)
{
$created_at = explode(" ",$review->created_at);
$created_at=date_create($created_at[0]);
$final_date = date_format($created_at,"d M Y");
?>
<div class="post">
<div class="user-space">
<div class="paner">{{$review->rating}}<i class="fa fa-star" aria-hidden="true"></i></div>
<?php
$reviewimages = explode(",",$review->images);
foreach($reviewimages as $reviewimage)
{
?>
<div class="post-user-img"> <a href="{{asset('/public/front')}}/img/{{$reviewimage}}" data-lightbox="usersreviewspics1"><img src="{{asset('/public/front')}}/img/{{$reviewimage}}" alt="Product Image" width="150"></a></div>
<?php
}
?>
<div class="descrpt"><p>{{$review->review}}.</p></div>
<p class="">{{$final_date}}</p>
</div>
</div><!-- post-->
<?php 
} 
}
else
{
?>
<div style="text-align:center;" class="alert alert-danger">There is no review for this product</div>
<?php
}
?>
</div>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
@section('script')
<!-- page script -->
<script>
$(document).ready(function() {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
});
$(document).ready(function() {
$('#example1').DataTable();
});
</script>
<script>
$(document).ready(function() {
$('.delete_btn').click(function() {
var id = $(this).attr('id');
if (confirm('Are you sure want to delete ?')) {
document.location.href = '{{url("/seller/deleteproduct")}}' + '/' + id;
} else {
return false;
}
});
});
</script>
<script>
$(function() {
$('input[name="daterange"]').daterangepicker({
opens: 'left'
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
});
</script>
@stop @endsection