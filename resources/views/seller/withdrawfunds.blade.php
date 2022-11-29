@extends('admin/layout/layout')
@section('content')
<?php
error_reporting(0);
$user_id = \Auth::user()->id;
$get_user_data = DB::table('users')->where('id',$user_id)->first();
$get_seller_data = DB::table('sellers')->where('user_id',$user_id)->first();
$name = $get_user_data->name;
$email = $get_user_data->email;
$wallet = $get_user_data->wallet;
$state = $get_seller_data->state;
$pincode = $get_seller_data->pincode;
/*if($wallet<=1)
{
    $currentURL = URL::to('/seller/dashboard');
    echo "<script>alert('Your wallet amount is less than 1!')</script>";
    echo "<script>window.location.href='".$currentURL."'</script>";
    exit;
}*/
?>
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="content-wrapper">
<div class="container-fluid">
<br>
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<br>
<form action="{{url('seller/submitwithdrawrequest')}}" method="post" class="" onsubmit="onSubmit()">
    @csrf
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-md-6 col-lg-4 mx-auto my-2">
        <div class="small-box bg-success p-4 rounded shadow  text-white">

            <div class="inner">
                <p class="h6">Available Funds</p>
                <h3>£ {{$wallet}}</h3>
            </div>
        </div>
    </div>
    


    <div class="col-md-6 col-lg-4 mx-auto my-2">
        <div class="form-group">
            <label for="">Enter Amount</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">£</span>
                </div>
                <input type="number" min="1" id="req_amount" name="req_amount" max="{{$wallet}}" class="form-control" placeholder="Enter Amount" aria-label="Enter Amount" aria-describedby="basic-addon1" readonly>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div class="radio-inline">
                <label for="paypal_withdraw">
                    <input type="radio" class="methodtype" value="Paypal" id="paypal_withdraw" name="payment_gateway_type" checked>
                    <img src="{{asset('/public')}}/image/paypal.png" alt="">
                </label>
            </div>
            <div class="radio-inline">
                <label for="stripe_withdraw">
                    <input type="radio" class="methodtype" value="Stripe" id="stripe_withdraw" name="payment_gateway_type">
                    <img src="{{asset('/public')}}/image/stripe.png" alt="">
                </label>
            </div>
        </div>

    </div>
    <div class="col-lg-2"></div>
</div>
<div class="row">
    <div class="w-100"></div>
    <div class="col-lg-8 mx-auto">
        <div class=" p-4 border rounded mb-4">
            <h5 class="mb-4">Withdraw method: <strong id="methodName">Paypal</strong></h5>
            
                <div class="row">
                    <div class="col-lg-6">
                    <label>Select Orders</label>
                    <select class="form-control" name="order_id" id="order_id" required>
                    <option value="">Select Order</option>
                        <?php
                        $get_order_detail = DB::table('transaction_history')->where(array('seller_paid'=>0,'user_id'=>$user_id))->get();
                        foreach($get_order_detail as $get_order_detail_result)
                        {
                            $order_detail_id = $get_order_detail_result->order_detail_id;
                        
                        $get_order_details = DB::table('order_detail')->where('id',$order_detail_id)->get();
                        foreach($get_order_details as $orders)
                        {
                        $oids = $orders->order_id;
                        $get_orders = DB::table('orders')->where('id',$oids)->get();
                        foreach($get_orders as $order_res)
                        {
                            $orderoid = $order_res->oid;
                        $get_withdrawl_request = DB::table('withdrawl_request')->where(array('order_detail_id'=>$order_detail_id,'payment_status'=>1))->get();
                        $count = count($get_withdrawl_request);
                        if($count==0)
                        {
                        ?>
                        <option data-value="{{$order_detail_id}}" value="{{$oids}}" >{{$orderoid}}-{{$order_detail_id}}</option>
                        <?php
                        }
                        }
                        }
                        }
                        ?>
                    </select>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Select Product</label>
                            <select class="form-control" id="product_id" multiple name="product_id[]" id="product_id" required>
                                <option value="">Select Order First</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="col-lg-6">
                        <input type="text" id="email" name="email" value="{{$email}}" class="form-control mb-4" placeholder="Registered email" required>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="name" name="name" value="{{$name}}" class="form-control mb-4" placeholder="Name and Surname" required>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="country" name="country" class="form-control mb-4" placeholder="Country" required>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="state" name="state" value="{{$state}}" class="form-control mb-4" placeholder="region" required>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="city" name="city" class="form-control mb-4" placeholder="City" required>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="pincode" name="pincode" value="{{$pincode}}" class="form-control mb-4" placeholder="Postcode" required>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="address" name="address" class="form-control mb-4" placeholder="Address" required>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-lg-6 mx-auto">
                        <input type="hidden" name="wallet" id="wallet" value="{{$wallet}}">
                        <input type="hidden" name="orderdetailid" id="orderdetailid" value="{{$order_detail_id}}">
                        <button type="submit" value="Withdraw Funds" class="btn_submit btn btn-warning w-100">Withdraw Funds</button>
                        <div class="text-success text-center mt-2" style="font-size: 12px;"><i class="fa fa-lock" aria-hidden="true"></i> Secure Connection. Your data are secured.</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px "></div>
<!-- content area End -->
</div>
<script>
/* Populate data to product dropdown */
$('#order_id').on('change',function(){
    var order_id = $(this).val();
    var order_data_id = $(this).find('option:selected').attr('data-value');
    //alert(order_data_id);
    $("#orderdetailid").val(order_data_id);
    //alert(orderdetailid);
    $.ajax({
            url:'{{ url('seller/getorderproduct') }}',
            method:'get',
            type:'html',
            data:{order_id:order_id,order_data_id:order_data_id},
            success:function(data){
               //alert(data); //return false;
               $('#product_id').html(data);
            }
    }); 
});

    $('#product_id').change(function(){ 
        $('#getValues').remove();
        $('body').append('<div id="getValues" style="position:fixed;left:-10000px;"></div>');
         $.each($(this).val(), function(i, val){ 
         getprice(val);
        });
    });
function getprice(id)
{
    var product_id = id;
    var orderdetailid = $("#orderdetailid").val();
    //alert(orderdetailid);
    var a = 0;
    $.ajax({
        type: "post",
        url: "{{ url('seller/fetchprice') }}",
        data: {
            _token: '{{csrf_token()}}',
            "product_id": product_id,
            "orderdetailid": orderdetailid
        },
        success: function(data) { 
            //alert(data);
            $('#getValues').append('<span>'+data+'</span>');
            $('#getValues span').each(function(){
          a += parseFloat($(this).text());
    });
    
    $('#req_amount').val(a.toFixed(2));
        }
    });
}
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
$(function() {
    $('.methodtype').on('change', function() {
        var saveValue = $(this).val();
        $('#methodName').text(saveValue);
    });
});
</script>
@endsection