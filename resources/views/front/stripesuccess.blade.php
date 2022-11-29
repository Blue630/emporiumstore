@include('front.stripe.Stripe')
<?php
if(isset($_REQUEST['wallet_amount']))
{
    $wallet_amount = $_REQUEST['wallet_amount'];
}
else
{
    $wallet_amount = '';
}
if($_REQUEST['walletamounthidden']!='')
{
    $walletamounthidden = $_REQUEST['walletamounthidden'];
}
else
{
    $walletamounthidden = 0;
}
$totalamount = number_format($_REQUEST['totalamount'],2);
$params = array(
        "testmode"   => "on",
        //"private_live_key" => "sk_live_UUCOI2p5f6ye9oqmIPKgohSW",
        //"public_live_key"  => "pk_live_NM71jfG5jXk2ChKV4PnBW6Uw",
        "private_live_key" => "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",
	    "public_live_key"  => "pk_live_51JX5TNGXLUn7XVFqQLGZQapiH7yBGBhLByOSThmeSaG1xmkZl9uAu4uejbXWKm7pxZFEik0vrU3m8tcQkwCTdLzQ00m1bTCxVN",
        "private_test_key" => "sk_test_51JX5TNGXLUn7XVFqQBfnTV6rErv1estkRcRqmUDhiN5ks9hRmeJJEv7jvKtFBMcnDfDvfusxbCoDTTI0xeBo5dr100itAeFXYw",
        "public_test_key"  => "pk_test_51JX5TNGXLUn7XVFqCbINRWKVDexvu2XWvGMcpOD3fugDi9Yb1YYfYj5yO2P0T6N9oSPs4eHYHFk0Ae9S1hmJClJv00qNvTWw3t"
);

/*if ($params['testmode'] == "on") 
{
    Stripe::setApiKey($params['private_test_key']);
    $pubkey = $params['public_test_key'];
} 
else 
{*/
    Stripe::setApiKey($params['private_live_key']);
    $pubkey = $params['public_live_key'];
/*}*/
if(isset($_POST['stripeToken']))
{
    $random_str = '1234567890';
    $shuffle_str = str_shuffle($random_str);
    $invoiceid = substr($shuffle_str,0,8); // Invoice ID
    $amount_cents = str_replace(",", "", $totalamount)*100; // Chargeble amount
    $description = "Invoice #" . $invoiceid . " - " . $invoiceid;
    try
    {
        $charge = Stripe_Charge::create(array(
                        "amount" => $amount_cents,
                        "currency" => "gbp",
                        "source" => $_POST['stripeToken'],
                        "description" => $description)
        );
/*        echo "<pre>";
        print_r($charge);die;*/
        /*if ($charge->card->address_zip_check == "fail") 
        {
            echo "Zip Check Invalid";
            throw new Exception("zip_check_invalid");
        }
        else if ($charge->card->address_line1_check == "fail") 
        {
            echo "Address Check Invalid";
            throw new Exception("address_check_invalid");
        } 
        else if ($charge->card->cvc_check == "fail") 
        {
            echo "CVC Check Invalid";
            throw new Exception("cvc_check_invalid");
        }die;*/
        // Payment has succeeded, no exceptions were thrown or otherwise caught
        $result = "success";
    }
    catch(Stripe_CardError $e) 
    {
        $error = $e->getMessage();
        $result = "declined";

    }
    catch (Stripe_InvalidRequestError $e) 
    {
        $result = "declined";
    }
    catch (Stripe_AuthenticationError $e) 
    {
        $result = "declined";
    }
    catch (Stripe_ApiConnectionError $e) 
    {
        $result = "declined";
    } 
    catch (Stripe_Error $e) 
    {
        $result = "declined";
    }
    catch (Exception $e) 
    {
        if ($e->getMessage() == "zip_check_invalid") 
        {
            $result = "declined";
        } 
        else if ($e->getMessage() == "address_check_invalid") 
        {
            $result = "declined";
        } 
        else if ($e->getMessage() == "cvc_check_invalid") 
        {
            $result = "declined";
        } 
        else 
        {
            $result = "declined";
        }
    }//die;
if($result=="success")
{
$cartid = explode(',',$_REQUEST['cartid']);
$gross_amount = $_REQUEST['totalamount'];
if(isset($_REQUEST['cashback_amount']) && $_REQUEST['cashback_amount']!="")
{
    $cashback_amount = $_REQUEST['cashback_amount'];
}
else
{
    $cashback_amount = 0;
}
$buyer_id = $_REQUEST['buyer_id'];
if(isset($_REQUEST['discountprice']) && $_REQUEST['discountprice']!="")
{
    $discountprice = $_REQUEST['discountprice'];
}
else
{
    $discountprice = 0;
}
$totDelCharge = $_REQUEST['totDelCharge'];
$buyer_wallet_amount = $_REQUEST['walletamounthidden'];
//$payment_method = $_REQUEST['payment_method'];
$stripeToken = $_REQUEST['stripeToken'];

$orderidarray= array();
$transaction_id = $_REQUEST['custom'];
$getorderid = DB::table('orders')->where(array('transaction_id'=>$transaction_id))->first();

$oids = $getorderid->id;

$getorderdetailid = DB::table('order_detail')->where(array('order_id'=>$oids))->get();
foreach ($getorderdetailid as $getorderdetailid_value) {
	$orderidarray[] = $getorderdetailid_value->id;
}

$new_gross_amount = $gross_amount ;
$commission_res = DB::table('commissions')->first();
$commission_percent = $commission_res->commission;
$subscription_commission_percent = $commission_res->subscription_commission;
$netcommission = $commission_percent + $subscription_commission_percent;
$user_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
$uid = $user_data->u_id;
$user_address_data = DB::table('addresses')->where(array('user_id'=>$buyer_id))->first();
$address_id = $user_address_data->id;

$random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$shuffle_str = str_shuffle($random_str);
$transaction_id = substr($shuffle_str,0,10);

$random_str1 = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$shuffle_str1 = str_shuffle($random_str1);
$oid = substr($shuffle_str1,0,5);

$addData=array(
    'oid'=>$oid,
    'walletamount'=>$walletamounthidden,
    'totalamount'=>$new_gross_amount,
    'discount_amount' => $discountprice,
    'cashback_amount'=>$cashback_amount,
    'delivery_charges'=>$totDelCharge,
    'buyer_id'=>$buyer_id,
    'transaction_id'=>$stripeToken,
    'is_paid'=>1,
    'uid'=>$uid,
    'payment_method'=>'Stripe',
    'address_id'=>$address_id,
    'payment_status'=>'Success',
    'status'=>1,
    'created_at'=>date('Y-m-d')
);
DB::table('orders')->insert($addData);
$orderid = DB::getPdo()->lastInsertId();
foreach ($cartid as $key=>$cart_idvalue) 
{
    $cartdata = DB::table('cart')->where(array('id'=>$cart_idvalue))->first();
    $product_id = $cartdata->product_id;
    $ord_id = $cartdata->orderid;
    $delivery_charges = $cartdata->delivery_charges;
    $discount_amount = $cartdata->discount_amount;
    $productdata = DB::table('products')->where(array('id'=>$product_id))->first();
    $seller_id = $productdata->user_id;
    $sellerdata = DB::table('sellers')->where(array('user_id'=>$seller_id))->first();
    if($sellerdata->seller_subscription_id!='')
    {
        $seller_subscription_id = $sellerdata->seller_subscription_id;
    }
    else
    {
        $seller_subscription_id = 0;
    }
    /*$is_subscribed = $sellerdata->is_subscription;*/
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
        $sellerwalletamount = $producttotalamount - $commission - $discount_amount;
        $buyer_user_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
        $last_buyer_wallet_amount = $buyer_user_data->wallet;
        $buyer_name = $buyer_user_data->name;


        $seller_user_data = DB::table('users')->where(array('id'=>$seller_id))->first();
        $last_seller_wallet_amount = $seller_user_data->wallet;
        $seller_updated_wallet_amount = $last_seller_wallet_amount + $sellerwalletamount;

        $updatesellerData=array(
        'wallet'=>$seller_updated_wallet_amount,
        );
        DB::table('users')->where(array('id'=>$seller_id))->update($updatesellerData);
    }
    else
    {
        $commission = $producttotalamount*($netcommission/100);
        $sellerwalletamount = $producttotalamount - $commission - $discount_amount;

        $buyer_user_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
        $last_buyer_wallet_amount = $buyer_user_data->wallet;
        $buyer_name = $buyer_user_data->name;
        
        $seller_user_data = DB::table('users')->where(array('id'=>$seller_id))->first();
        $last_seller_wallet_amount = $seller_user_data->wallet;
        $seller_updated_wallet_amount = $last_seller_wallet_amount + $sellerwalletamount;

        $updatesellerData=array(
        'wallet'=>$seller_updated_wallet_amount,
        );
        DB::table('users')->where(array('id'=>$seller_id))->update($updatesellerData);
    }
    $addData1=array(
    'order_id'=>$orderid,
    'product_id' => $cartdata->product_id,
    'variant_id'=>$cartdata->variant_id,
    'quantity'=>$cartdata->quantity,
    'spec_detail'=>$cartdata->spec_detail,
    'seller_id'=>$seller_id,
    'seller_subscription_id'=>$seller_subscription_id,
    'product_amount'=>$cartdata->totalamount,
    'discount_amount'=>$cartdata->discount_amount,
    'delivery_charges'=>$delivery_charges,
    'created_at'=>date('Y-m-d')
    );
    //Coder::insert($addData1);
    DB::table('order_detail')->insert($addData1);
    $orderdetailid = DB::getPdo()->lastInsertId();
    // $payment_response = DB::table('payment_response')->where(array('orderid'=>$orderdetailid))->first();
    // $payment_status = $payment_response->payment_status;
    
    $order_detail_id = $orderidarray[$key];
    $addData22 = array(
    'payment_method'=>'Stripe',
    'amount'=>$producttotalamount,
    'user_id'=>$seller_id,
    'admin_amount'=>$commission,
    'seller_amount'=>$sellerwalletamount,
    'buyer_amount'=>0,
    'status'=>'Success',
    'type'=>1,
    'transaction_id'=>$stripeToken,
    'product_id'=>$product_id,
    'order_detail_id'=>$order_detail_id,
    //'created_at'=>date('Y-m-d H:i:s')
    );
    DB::table('transaction_history')->insert($addData22);
    $id = DB::getPdo()->lastInsertId();
}
$buyer_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
$last_wallet_balance = $buyer_data->wallet;
$user_updated_balace = $last_wallet_balance;
$buyer_email = $buyer_data->email;
if($walletamounthidden=='')
{
    $buyer_updated_wallet_amount = $cashback_amount + $user_updated_balace;
}
else
{   
    $buyer_updated_wallet_amount = $cashback_amount+$user_updated_balace-$walletamounthidden;   
}
/*$updatebuyerData=array(
'wallet'=>$buyer_updated_wallet_amount,
);
DB::table('users')->where(array('id'=>$buyer_id))->update($updatebuyerData);*/

$updateData=array(
'orderid'=>$orderid,
);
DB::table('cart')->where(array('user_id'=>$buyer_id,'movetocheckout'=>1,'status'=>1))->update($updateData);

$updateData1=array(
'status'=>0,
);
DB::table('cart')->where(array('orderid'=>$orderid,'movetocheckout'=>1))->update($updateData1);


$this->from=strtolower($buyer_email);
$dataset=array(
'email'=>strtolower($buyer_email),
//'sellerid'=>$order_seller_id
);
$res=  Mail::send('front/sendmail/ordermail',
$data =
[
'dataset'=>$dataset,
'orderid'=>$orderid,
//'sellerids'=>$sellerids
],function($message){
//return $message;
$message->from('support@emporiumstore.co.uk','Order Success');
$message->to($this->from,'Order Success');
$message->subject('Order Success');
});

$order_data = DB::table('orders')->where(array('id'=>$orderid))->first();
$payment_status = $order_data->payment_status;
$orderid = $order_data->id;
?>
@include('front.include.header')
@yield('header')
<div class="container" style="margin-top:30px;">
<div class="row">
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="check-out" style="text-align:center; color:red; font-size:20px;">Payment Status</div>
    <br/>
        <center><span style="font-size: 18px;text-align:center;">Hi, {{$buyer_name}}</span></center>
        <center><span style="font-size: 18px;text-align:center;">Your Order No: {{$orderid}}</span></center>
        <center><span style="font-size: 18px;text-align:center;">Your Payment Status is <strong>{{$payment_status}}</strong></span></center>
        <center><span style="font-size: 18px;text-align:center;"> THANKS FOR YOUR PURCHASE.<br> YOU WILL RECEIVE AN INVOICE BY EMAIL SHORTLY.</span></center>
</div>
</div>   
</div>
@include('front.include.footer')
@yield('footer')
<?php
} 
else
{
    echo $response = "<div class='text-danger'>Stripe Payment Status : \".$result.</div>";
}
}
?>