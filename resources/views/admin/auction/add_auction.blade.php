@extends('admin.layout.layout')
@section('content')
@php
use App\Category;
use App\Product;
@endphp
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<!-- Content Wrapper. Contains page content -->
<!-- Google Font: Source Sans Pro -->
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
                   $('#subcat_id').html(data);
                }
        }); 
    });
    $('#subcat_id').on('change',function(){
        var subcatId = $(this).val();
        alert(subcatId);
        $.ajax({
                url:'{{ url('admin/getproduct') }}',
                method:'get',
                type:'html',
                data:{subcatId:subcatId},
                success:function(data){
                   //alert(data); //return false;
                   $('#product_id').html(data);
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
                <h1 class="m-0">Add Auction</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
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
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<form method="post" action="{{url('admin/addauction')}}" enctype="multipart/form-data">
@csrf
<div class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Auction</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categories</label>
                            <select name="catid" id="catid" class="form-control" required>
                            <option value="">Select Category</option>
                            @if($cate)
                              @foreach($cate as $allcate)
                                <option value="{{$allcate->id}}">{{$allcate->catname}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Categories</label>
                            <select id="subcat_id" style="width: 100%;" name="subcat_id" class="form-control" required>
                                <option value="">Select Category first</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Name</label>
                            <select id="product_id" style="width: 100%;" name="product_id" class="form-control" required>
                                <option value="">Select Subcategory first</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label>Auction Expiration Time</label>
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" name="auction_time" class="form-control datetimepicker-input" data-target="#reservationdatetime">
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <!-- <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="datetime-local" name="auction_time" class="form-control">
                    </div> -->
                    <!-- /.input group -->
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Minimum Cost</label>
                            <input type="number" min="1" id="minimum_cost" name="minimum_cost" class="form-control" required>
                        </div>
                    </div>
                    </div>
                    <!--<div class="row">-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <div class="form-check">-->
                    <!--            <input type="checkbox" class="form-check-input" name="auto_close_bid" id="auto_close_bid">-->
                    <!--            <label class="form-check-label" for="auto_close_bid"><strong>Auto Close Bid</strong></label>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--</div>-->
                </div>
                <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
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

});
</script>
@endsection  