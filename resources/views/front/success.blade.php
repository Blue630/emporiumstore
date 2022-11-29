@include('front.include.header')
@yield('header')
<?php

$Msg = "";
if(isset($_REQUEST['custom']) && $_REQUEST['custom']!="")
{
    $orderidarray= array();
    $transaction_id = $_REQUEST['custom'];
    $getorderid = DB::table('orders')->where(array('transaction_id'=>$transaction_id))->first();
	
	$oids = $getorderid->id;
	
	$getorderdetailid = DB::table('order_detail')->where(array('order_id'=>$oids))->get();
	foreach ($getorderdetailid as $getorderdetailid_value) {
		$orderidarray[] = $getorderdetailid_value->id;
	}
    $payment_response = DB::table('payment_response')->where(array('custom'=>$transaction_id))->first();
    $orderid = $payment_response->orderid;
    $order_result = DB::table('orders')->where(array('id'=>$orderid))->first();
    $oid = $order_result->oid;
    $discount_amount = $order_result->discount_amount;
    $cashback_amount = $order_result->cashback_amount;
    //$orderamount = $order_result->amount;
    $buyer_id = $order_result->buyer_id;
    $user_order_wallet_amount = $order_result->walletamount; 
    $user_result = DB::table('users')->where(array('id'=>$buyer_id))->first();
    $name = $user_result->name;
    $buyer_wallet_amount = $user_result->wallet;
    $updated_buyer_wallet = $buyer_wallet_amount-$user_order_wallet_amount+$cashback_amount;
    $payment_status = $payment_response->payment_status;
    if($payment_status=='Pending')
    {
        $commission_res = DB::table('commissions')->first();
        $commission_percent = $commission_res->commission;
        $subscription_commission_percent = $commission_res->subscription_commission;
        $netcommission = $commission_percent + $subscription_commission_percent;
        $cartdetail = DB::table('cart')->where(array('orderid'=>$orderid))->get();
        //print_r($cartdetail);die;
        foreach ($cartdetail as $key=>$cartdata) {            
            $product_id = $cartdata->product_id;
            $ord_id = $cartdata->orderid;
            /*$orderdetaildata=DB::table('order_detail')->where('order_id',$ord_id)->get();*/
            $discount_amount = $cartdata->discount_amount;
            $productdata = DB::table('products')->where(array('id'=>$product_id))->first();
            $seller_id = $productdata->user_id;
            $sellerdata = DB::table('sellers')->where(array('user_id'=>$seller_id))->first();
            //$is_subscribed = $sellerdata->is_subscription;
            if($sellerdata->seller_subscription_id!='')
            {
                $seller_subscription_id = $sellerdata->seller_subscription_id;
            }
            else
            {
                $seller_subscription_id = 0;
            }
            
            $order_detail = DB::table('order_detail')->where('order_id',$seller_id)->get();
            
            $subscribed_seller_orders = DB::table('order_detail')->where('seller_id',$seller_id)->Where('seller_subscription_id',$seller_subscription_id)->get();
            $totalorderswithsub = count($subscribed_seller_orders);
            $seller_subscription_data = DB::table('seller_subscriptions')->where('seller_id',$seller_id)->orderBy('id','desc')->first();
            if(!empty($seller_subscription_data))
            {
            $subscription_id = $seller_subscription_data->subscription_id;
            $end_date = $seller_subscription_data->end_date;
            $subscription_res = DB::table('subscriptions')->where(array('id'=>$subscription_id))->first();
            $product_limit = $subscription_res->product_limit;
            $currentDate = date('Y-m-d');
            if($product_limit<$totalorderswithsub || $currentDate>$end_date)
            {
            $updatesellerSubscribeData=array(
            'is_subscription'=>0,
            );
            DB::table('sellers')->where(array('user_id'=>$seller_id))->update($updatesellerSubscribeData);
            }
            else
            {
                $updatesellerSubscribeData=array(
                'is_subscription'=>1,
                );
                DB::table('sellers')->where(array('user_id'=>$seller_id))->update($updatesellerSubscribeData);
            }
            }
            $is_seller_subscribed = DB::table('sellers')->where('user_id',$seller_id)->first();
            $is_subscribed = $is_seller_subscribed->is_subscription;
            $producttotalamount = $cartdata->totalamount + $discount_amount;
            if($is_subscribed==1)
            {
                $commission = $producttotalamount*($subscription_commission_percent/100);
                $walletamount = $producttotalamount - $commission - $discount_amount;
                $userdata = DB::table('users')->where(array('id'=>$seller_id))->first();
                $previous_wallet_amount = $userdata->wallet;
                $updated_wallet_amount = $walletamount + $previous_wallet_amount;
                $updateData=array(
                'wallet'=>$updated_wallet_amount,
                );
                DB::table('users')->where(array('id'=>$seller_id))->update($updateData);
            }
            else
            {
                $commission = $producttotalamount*($netcommission/100);
                $walletamount = $producttotalamount - $commission - $discount_amount;
                $userdata = DB::table('users')->where(array('id'=>$seller_id))->first();
                $previous_wallet_amount = $userdata->wallet;
                $updated_wallet_amount = $walletamount + $previous_wallet_amount;
                $updateData=array(
                'wallet'=>$updated_wallet_amount,
                );
                DB::table('users')->where(array('id'=>$seller_id))->update($updateData);
            }
            /*$updateData=array(
            'wallet'=>$updated_buyer_wallet,
            );
            DB::table('users')->where(array('id'=>$buyer_id))->update($updateData);*/
            
            $order_detail_id = $orderidarray[$key];

            $addData = array(
            'payment_method'=>'Paypal',
            'amount'=>$producttotalamount,
            'user_id'=>$seller_id,
            'admin_amount'=>$commission,
            'seller_amount'=>$walletamount,
            'buyer_amount'=>0,
            'status'=>$payment_status,
            'type'=>1,
            'transaction_id'=>$transaction_id,
            'product_id'=>$product_id,
            'order_detail_id'=>$order_detail_id
            //'created_at'=>date('Y-m-d H:i:s')
            );
            DB::table('transaction_history')->insert($addData);
            $id = DB::getPdo()->lastInsertId();
        }
    }
}
?>
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
@include('front.include.footer')
@yield('footer')