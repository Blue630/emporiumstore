@extends('admin.layout.layout')
 @section('content')
@php
use App\Category;
use App\Product;
@endphp
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
  <!-- Content Wrapper. Contains page content -->
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Auction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/manageauction')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-body">
            @if($msg=Session::get('success'))
            <div class="alert alert-success">{{$msg}}</div>
            @endif
            <form method="post" action="{{url('admin/editauction')}}/{{$auctiondetail->id}}" enctype="multipart/form-data">
              @csrf

            <div class="content">
            <div class="container-fluid">
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Select Category</h3>
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
                            <option value="{{$allcate->id}}" @if($auctiondetail->catid==$allcate->id){{"selected"}}@endif>{{$allcate->catname}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Categories</label>
                            <select id="subcat_id" style="width: 100%;" name="subcat_id" class="form-control">
                                <option value="" >Select Category first</option>
                                @if($subcate)
                                @foreach($subcate as $allsubcate)
                                <option value="{{$allsubcate->id}}" @if($auctiondetail->subcat_id==$allsubcate->id){{"selected"}}@endif>{{$allsubcate->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product</label>
                            <select id="product_id" style="width: 100%;" name="product_id" class="form-control">
                                <option value="" >Select Product</option>
                                @if($products)
                                @foreach($products as $allproduct)
                                <option value="{{$allsubcate->id}}" @if($auctiondetail->product_id==$allproduct->id){{"selected"}}@endif>{{$allproduct->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    @php
                    $auction_time = strtotime($auctiondetail->auction_time);
                    $new_date = date('m/d/Y g:i A', $auction_time);
                    @endphp
                    <div class="col-md-6">
                    <div class="form-group">
                    <label>Auction Expiration Time</label>
                    <div class="input-group" id="reservationdatetime1" data-target-input="nearest">
                    <input type="text" name="auction_time" class="form-control" value="<?php echo $new_date;?>"><div class="input-group-append" data-target="#reservationdatetime1" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    </div>
                    <!-- /.input group -->
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Minimum Cost</label>
                            <input type="number" value="@if($auctiondetail){{$auctiondetail->minimum_cost}}@endif" min="1" id="minimum_cost" name="minimum_cost" class="form-control" required>
                        </div>
                    </div>
                    </div>
                    <!--<div class="row">-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <div class="form-check">-->
                    <!--            <input type="checkbox" <?php if($auctiondetail->auto_close_bid==1){?>checked=""<?php }?> class="form-check-input" name="auto_close_bid" id="auto_close_bid">-->
                    <!--            <label class="form-check-label" for="auto_close_bid"><strong>Auto Close Bid</strong></label>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <div class="col-sm-12">
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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
          </div>
        </div>
      </div>
    </section>
  </div>
<script>
$(function() {
//Initialize Select2 Elements
//Date and time picker
// $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
//Date and time picker
$('#reservationdatetime1').datetimepicker({
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