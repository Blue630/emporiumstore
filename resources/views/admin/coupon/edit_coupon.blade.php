@extends('admin.layout.layout')
@section('content')
<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Discount Coupon Code</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/managecoupon')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <form method="post" action="{{url('admin/editcoupon')}}/{{$coupondetail->id}}" enctype="multipart/form-data" onsubmit="onSubmit()">
              @csrf
            <div class="content">
            <div class="container-fluid">
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Discount Coupon Code</h3>
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
                foreach($seller as $seller_result){
                ?>
                <option <?php echo ($seller_result->user_id == $coupondetail->seller_id ?'selected="selected"':"") ?>  value="{{$seller_result->user_id}}">{{$seller_result->u_id}}</option>
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
                            <input type="text" value="@if($coupondetail){{$coupondetail->name}}@endif" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label>Image</label><br>
                    <?php if($coupondetail->image!="") 
                    { 
                    ?>
                    <img src="{{asset('public/coupons')}}/{{$coupondetail->image}}" height="100" width="120" alt="Image">
                    <?php
                    }
                    ?>
                    <input type="file" class="form-control" name="image" id="image" value="<?php echo $coupondetail->image;?>"/>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" value="@if($coupondetail){{$coupondetail->code}}@endif" id="code" name="code" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Percent</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                                <input type="number" min="1" id="percent" value="@if($coupondetail){{$coupondetail->percent}}@endif" name="percent" class="form-control" placeholder="Amount" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" id="start_date" value="@if($coupondetail){{$coupondetail->start_date}}@endif" class="form-control" name="start_date" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" id="end_date" value="@if($coupondetail){{$coupondetail->end_date}}@endif" class="form-control" name="end_date" required/>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-12">
                    <div class="form-group">
                    <button type="submit" class="btn_submit btn btn-primary">Submit</button>
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
 $(function(){
    var h11 = new Choices('.multi1', {
    removeItemButton: true,
    maxItemCount:5,
    searchResultLimit:5,
    renderChoiceLimit:5
    })
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
});
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
</script>
@endsection