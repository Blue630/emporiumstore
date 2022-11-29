@extends('admin.layout.layout')
@section('content')
@php
use App\Category;
use App\Subcategory;
use App\Product;
@endphp
<script type="text/javascript">
$(document).ready(function(){
    /* Populate data to subcategory dropdown */
    $('#catid').on('change',function(){
        var catId = $(this).val();
        //alert(catId);
        $.ajax({
                url:'{{ url('admin/getsubcat') }}',
                method:'get',
                type:'html',
                data:{catId:catId},
                success:function(data){
                   //alert(data); //return false;	
                   $('#reset_multiselect').empty().html(data);
                   var h12 = new Choices('.multi2', {
					removeItemButton: true,
					//maxItemCount:5,
					searchResultLimit:5,
					renderChoiceLimit:5
					});

                }
        }); 
    });
   
    $('body').on('change','#subcat_id', function(){
        //$('#subcat_id').val();
        var subcatId = $(this).val();
        //console.log($(this));
        //alert(subcatId);
        $.ajax({
                url:'{{ url('admin/getproduct') }}',
                method:'get',
                type:'html',
                data:{subcatId:subcatId},
                success:function(data){
                   //alert(data); //return false;
                   //$('#product_id').html(data);
                    $('#reset_multiselect_product').empty().html(data);
                    var h13 = new Choices('.multi3', {
					removeItemButton: true,
					//maxItemCount:5,
					searchResultLimit:5,
					renderChoiceLimit:5
					});
                }
        }); 
    });
});
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Cashback</h1>
</div>
<!-- /.col -->
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="{{url('/admin/home')}}">Home</a></li>
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
<?php
if($errors->first('catid')!="")
{
?>
<div class="alert alert-danger">{{$errors->first('catid')}}</div><br>
<?php
}
?>
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<form method="post" action="{{url('admin/addcashback')}}" enctype="multipart/form-data" onsubmit="onSubmit()">
@csrf
<div class="content">
<div class="container-fluid">
<div class="card card-default">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Sellers </label>
<select class="multi1" id="user_id" name="user_id[]" placeholder="Select values" multiple style="width:100%;">
<option value="">Select Seller</option>
@if($seller)
@foreach($seller as $allseller)
<option value="{{$allseller->id}}">{{$allseller->u_id}}</option>
@endforeach
@endif
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Cateogry </label>
<select id="catid" name="catid" class="form-control select2" style="width: 100%;">
<option value="">Select Category</option>
@if($cate)
@foreach($cate as $allcate)
<option value="{{$allcate->id}}">{{$allcate->catname}}</option>
@endforeach
@endif
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Sub Cateogry </label>
<div id="reset_multiselect">
<select class="multi2" id="subcat_id" multiple style="width:100%;" name="subcat_id[]" >
</select>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Product </label>
<div id="reset_multiselect_product">
<select class="multi3" id="product_id" style="width: 100%;" name="product_id" multiple="">
<option value="">Select Subcategory first</option>
</select>
</div>
</div>
</div>
</div>

<!-- /.form-group -->
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Cashback Percentage (%) </label>
<input class="form-control select2" type="text" id="cashback" name="cashback" placeholder="Cashback" required>
</div>
<!-- /.form-group -->
</div>
<!-- /.col -->


</div>
<!-- /.form-group -->

<div class="row">

</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<input type="submit" value="Submit" class="btn_submit btn btn-primary">
</div></div>

<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
</div>
</form>
<!-- REQUIRED SCRIPTS -->
<script>
$(function() {
//Initialize Select2 Elements
//Date and time picker
// $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
//Date and time picker
$('#reservationdatetime').datetimepicker({
icons: {
time: 'far fa-clock'
}
});
//Timepicker
$('#timepicker').datetimepicker({
format: 'LT'
});
//Date range picker
$('#date-ankur').daterangepicker();

//Multiselect dropdown---
var h11 = new Choices('.multi1', {
removeItemButton: true,
//maxItemCount:5,
searchResultLimit:5,
renderChoiceLimit:5
})
var h12 = new Choices('.multi2', {
removeItemButton: true,
//maxItemCount:5,
searchResultLimit:5,
renderChoiceLimit:5
})

var h13 = new Choices('.multi3', {
removeItemButton: true,
//maxItemCount:5,
searchResultLimit:5,
renderChoiceLimit:5
})
});
</script>
<script>
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
</script>
@endsection