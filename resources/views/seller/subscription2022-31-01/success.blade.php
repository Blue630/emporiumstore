@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<?php
$Msg = "";

if(isset($_REQUEST['custom']) && $_REQUEST['custom']!="")
{
  $transaction_id = $_REQUEST['custom'];
  $amount = $_REQUEST['payment_gross'];
  $payment_status = $_REQUEST['payment_status'];
  $get_seller_subscription = DB::table('seller_subscriptions')->where(array('transaction_id'=>$transaction_id))->first();
  $seller_id = $get_seller_subscription->seller_id;
  $subscription_auto_id = $get_seller_subscription->id;
  $get_seller_name = DB::table('users')->where(array('id'=>$seller_id))->first();
  $name = $get_seller_name->name;
  $addData = array(
    'payment_method'=>'Paypal',
    'amount'=>$amount,
    'user_id'=>$seller_id,
    'admin_amount'=>$amount,
    'seller_amount'=>0,
    'buyer_amount'=>0,
    'status'=>$payment_status,
    'type'=>3,
    'transaction_id'=>$transaction_id,
    //'created_at'=>date('Y-m-d H:i:s')
  );
  DB::table('transaction_history')->insert($addData);
  $id = DB::getPdo()->lastInsertId();
  $payment_response = DB::table('payment_response')->where(array('custom'=>$transaction_id))->first();
  $orderid = $payment_response->orderid;

  
  $updateData=array(
  'payment_status'=>$payment_status,
  );
  DB::table('seller_subscriptions')->where(array('id'=>$subscription_auto_id))->update($updateData);

  if($payment_status=='Pending')
  {
    $updateSellersData=array(
    'is_subscription'=>1,
    );
    DB::table('sellers')->where(array('user_id'=>$seller_id))->update($updateSellersData);
  }
}
/*
if(isset($_REQUEST['custom']) && $_REQUEST['custom']!="")
{
  $custom = $_REQUEST['custom'];
  $payment_response = DB::table('payment_response')->where(array('custom'=>$custom))->first();
  $orderid = $payment_response->orderid;
  $payment_history = DB::table('payment_history')->where(array('transaction_id'=>$custom))->first();
  //$order_result = DB::table('orders')->where(array('id'=>$orderid))->first();
  //$oid = $order_result->oid;
  $seller_id = $payment_history->user_id;
  $user_result = DB::table('users')->where(array('id'=>$seller_id))->first();
  $name = $user_result->name;
  $payment_status = $payment_response->payment_status;
  $updateData=array(
  'payment_status'=>$payment_status,
  );
  DB::table('payment_history')->where(array('transaction_id'=>$custom))->update($updateData);
}*/
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Manage Subscription</h1>
    </div>
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
        <div class="card">
                <div class="card-body">
                <div class="">
                    <section class="pricing-section">
        <div class="container">
            <div class="sec-title text-center">
                <span class="title">Get subscription</span>
                <h2>Choose a Subscription</h2>
            </div>
            <!-- <form name="subscribenow" id="subscribenow" method="post" action="{{url('seller/subscribenow')}}">
            @csrf -->
            <div class="outer-box">
                <div class="row">
                    <div class="container" style="margin-top:30px;">
                    <div class="row">
                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="check-out" style="text-align:center; color:red; font-size:20px;">Payment Status</div>
                        <br/>
                          <center><span style="font-size: 18px;text-align:center;">Hi, {{$name}}</span></center>
                          <center><span style="font-size: 18px;text-align:center;">Your Order No: {{$orderid}}</span></center>
                          <center><span style="font-size: 18px;text-align:center;">Your Payment Status is <strong>{{$payment_status}}</strong></span></center>
                          <center><span style="font-size: 18px;text-align:center;"> THANKS FOR YOUR PURCHASE.<br> YOU WILL RECEIVE AN INVOICE BY EMAIL SHORTLY.</span></center>
                      </div>
                    </div>   
                  </div>
                </div>
            </div>
        <!-- </form> -->
        </div>
    </section>
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
@section('script')
@stop @endsection