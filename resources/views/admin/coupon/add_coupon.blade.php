@extends('admin.layout.layout')
@section('content')
<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<!-- Content Wrapper. Contains page content -->
<!-- Google Font: Source Sans Pro -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Discount Coupon Code</h1>
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
<?php
if($errors->first('name')!="")
{
?>
<div class="alert alert-danger">{{$errors->first('name')}}</div>
<?php
}
?>
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<form method="post" action="{{url('admin/addcoupon')}}" enctype="multipart/form-data" onsubmit="onSubmit()">
@csrf
<div class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Coupon</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label>Seller</label>
                    <select type="text" name="seller_id" id="seller_id" class="form-control multi1" required>
                    <option value="">Select Seller</option>
                    <?php 
                    $seller=DB::table('sellers')->orderBy('id','desc')->get();
                    foreach($seller as $seller_result)
                    {
                    ?>
                    <option value="{{$seller_result->user_id}}">{{$seller_result->u_id}}</option>
                    <?php
                    }
                    ?>
                    </select>  
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" id="image" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" id="code" name="code" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Percent</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                                <input type="number" min="1" id="percent" name="percent" class="form-control" placeholder="Amount" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" id="start_date" class="form-control" name="start_date" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" id="end_date" class="form-control" name="end_date" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn_submit btn btn-primary">Submit</button>
                </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
</form>
<script>
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var minDate= year + '-' + month + '-' + day;
    
    $('#start_date').attr('min', minDate);
    $('#end_date').attr('min', minDate);
    
var h11 = new Choices('.multi1', {
removeItemButton: true,
maxItemCount:5,
searchResultLimit:5,
renderChoiceLimit:5
})
});
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
</script>
<!-- REQUIRED SCRIPTS -->
@endsection