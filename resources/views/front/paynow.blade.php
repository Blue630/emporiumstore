<?php
$payment_method = $_REQUEST['pay'];
$totDelCharge = $_REQUEST['totDelCharge'];

if(isset($_POST['paypal_amount']))
{
if($_REQUEST['paypal_amount']=="Stripe" && isset($_REQUEST['wallet_amount']))
{
	$cartid = implode(',',$_REQUEST['cartid']);
	$cashback_amt = str_replace(",", "", $_REQUEST['cashback_amt']);
	$totalamount = str_replace(",", "", $_REQUEST['amount']);
	$wallet_amount = str_replace(',', '', $_REQUEST['wallet_amount']);
	$user_id = $_REQUEST['user_id'];
	if($_REQUEST['discountprice']!='')
	{
		$discountprice = str_replace(",", "", $_REQUEST['discountprice']);
	}
	else
	{
		$discountprice = 0;
	}
	$totDelCharge = str_replace(",", "", $_REQUEST['totDelCharge']);
	$walletamounthidden = str_replace(",", "", $_REQUEST['walletamounthidden']);
	/*if($wallet_amount<=$totalamount)
	{*/
	$final_amount = $totalamount-$wallet_amount;
	/*}
	else
	{
	echo $final_amount = $wallet_amount - $totalamount - $discountprice;die;
	}*/
	?>

	
	<?php
}
}




else if(isset($_REQUEST['wallet_amount']) && $_REQUEST['wallet_amount']!="")
{
$amount = str_replace(",", "", $_REQUEST['amount']);
if($_REQUEST['wallet_amount'] >= $amount)
{
//echo "WALLET";
$gross_amount = str_replace(",", "", $_REQUEST['amount']);
$buyer_id = $_REQUEST['user_id'];
$discountprice = str_replace(",", "", $_REQUEST['discountprice']);
$totDelCharge = $_REQUEST['totDelCharge'];
$buyer_wallet_amount = $_REQUEST['wallet_amount'];
$payment_method = $_REQUEST['pay'];
$cart_id = $_REQUEST['cartid'];

$new_gross_amount = $gross_amount - $discountprice;
$commission_res = DB::table('commissions')->first();
$commission_percent = $commission_res->commission;
$subscription_commission_percent = $commission_res->subscription_commission;
$netcommission = $commission_percent + $subscription_commission_percent;
$cashback_amount = 0;
/*$user_session = session('logged_user');
$user_id = $user_session->id;*/
if(Auth::check())
{
$user_id = auth()->user()->id;
}
$user_data = DB::table('users')->where(array('id'=>$user_id))->first();
$uid = $user_data->u_id;

$user_address_data = DB::table('addresses')->where(array('user_id'=>$user_id))->first();
$address_id = $user_address_data->id;

$newtotalamount = (floatval($buyer_wallet_amount) - floatval($gross_amount) - floatval($discountprice));

if(isset($_REQUEST['cashback_amt']) && $_REQUEST['cashback_amt']!="")
{
$cashback_amount = $_REQUEST['cashback_amt'];
}
$random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$shuffle_str = str_shuffle($random_str);
$transaction_id = substr($shuffle_str,0,10);

$random_str1 = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$shuffle_str1 = str_shuffle($random_str1);
$oid = substr($shuffle_str1,0,5);



$addData=array(
    'oid'=>$oid,
    'walletamount'=>$new_gross_amount,
    'totalamount'=>$new_gross_amount,
    'discount_amount' => $discountprice,
    'cashback_amount'=>$cashback_amount,
    'delivery_charges'=>$totDelCharge,
    'buyer_id'=>$user_id,
    'transaction_id'=>$transaction_id,
    'is_paid'=>1,
    'uid'=>$uid,
    'payment_method'=>'Emporium Wallet',
    'address_id'=>$address_id,
    'payment_status'=>'Success',
    'status'=>1,
    'created_at'=>date('Y-m-d H:i:s')
);
DB::table('orders')->insert($addData);
$orderid = DB::getPdo()->lastInsertId();

$orderidarray= array();

$getorderidwallet = DB::table('orders')->where(array('id'=>$orderid))->first();


$oidss = $getorderidwallet->id;




foreach ($cart_id as $key=>$cart_idvalue) 
{
	$cartdata = DB::table('cart')->where(array('id'=>$cart_idvalue))->first();
	$product_id = $cartdata->product_id;
	$ord_id = $cartdata->orderid;
	$discount_amount = $cartdata->discount_amount;
	$delivery_charges = $cartdata->delivery_charges;
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
	//$is_subscribed = $sellerdata->is_subscription;
	//$producttotalamount = $cartdata->totalamount + $discount_amount;
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
		$sellerwalletamount = $producttotalamount - $commission -$discount_amount;
		$buyer_id = $_REQUEST['user_id'];
		$buyer_user_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
		$buyer_wallet_amount = $buyer_user_data->wallet;
		$buyer_name = $buyer_user_data->name;
		$buyer_updated_wallet_amount = $buyer_wallet_amount - $new_gross_amount;
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
		$commission = $producttotalamount*($commission_percent/100);
		$sellerwalletamount = $producttotalamount - $commission - $discount_amount;
		$buyer_id = $_REQUEST['user_id'];
		$buyer_user_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
		$buyer_wallet_amount = $buyer_user_data->wallet;
		$buyer_name = $buyer_user_data->name;
		$buyer_updated_wallet_amount = $buyer_wallet_amount - $new_gross_amount;
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
    'discount_amount'=>$discount_amount,
    'spec_detail'=>$cartdata->spec_detail,
    'seller_id'=>$seller_id,
    'product_amount'=>$cartdata->totalamount,
    'delivery_charges'=>$delivery_charges,
    'created_at'=>date('Y-m-d')
	);
	//Coder::insert($addData1);
	DB::table('order_detail')->insert($addData1);
	$orderdetailid = DB::getPdo()->lastInsertId();
	// $payment_response = DB::table('payment_response')->where(array('orderid'=>$orderdetailid))->first();
	// $payment_status = $payment_response->payment_status;
    
    
    $buyer_id = $_REQUEST['user_id'];
    $buyer_user_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
    $buyer_wallet_amount = $buyer_user_data->wallet;
    $buyer_name = $buyer_user_data->name;
    $buyer_updated_wallet_amount = $buyer_wallet_amount - $new_gross_amount+$cashback_amount;
    $seller_user_data = DB::table('users')->where(array('id'=>$seller_id))->first();
    $last_seller_wallet_amount = $seller_user_data->wallet;
    $seller_updated_wallet_amount = $last_seller_wallet_amount + $sellerwalletamount;

    $updatesellerData=array(
    'wallet'=>$seller_updated_wallet_amount,
    );
    DB::table('users')->where(array('id'=>$seller_id))->update($updatesellerData);
    //echo $producttotalamount;die;
    //$order_detail_id = $orderidarray[$key];
    //echo $order_detail_id;die;
	$addData22 = array(
	'payment_method'=>'Emporium Wallet',
	'amount'=>$producttotalamount,
	'user_id'=>$seller_id,
	'admin_amount'=>$commission,
	'seller_amount'=>$sellerwalletamount,
	'buyer_amount'=>0,
	'status'=>'Success',
	'type'=>1,
	//'seller_subscription_id'=>$seller_subscription_id,
	'transaction_id'=>$transaction_id,
    'product_id'=>$product_id,
    'order_detail_id'=>$orderdetailid
	//'created_at'=>date('Y-m-d H:i:s')
	);
	DB::table('transaction_history')->insert($addData22);
	$id = DB::getPdo()->lastInsertId();
}
$updatebuyerData=array(
'wallet'=>$buyer_updated_wallet_amount,
);
DB::table('users')->where(array('id'=>$buyer_id))->update($updatebuyerData);

$updateData=array(
'orderid'=>$orderid,
);
DB::table('cart')->where(array('user_id'=>$user_id,'movetocheckout'=>1,'status'=>1))->update($updateData);

$updateData1=array(
'status'=>0,
);
DB::table('cart')->where(array('orderid'=>$orderid,'movetocheckout'=>1))->update($updateData1);


$buyer_data = DB::table('users')->where(array('id'=>$buyer_id))->first();
$buyer_email = $buyer_data->email;
$order_data = DB::table('orders')->where(array('id'=>$orderid))->first();
$payment_status = $order_data->payment_status;
$orderid = $order_data->id;
if($payment_status=='Success')
{
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
$message->from('djsaluja18@gmail.com','Order Success');
$message->to($this->from,'Order Success');
$message->subject('Order Success');
});
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
<?php
}
}
else
{
$currentURL = URL::to('/checkout');
echo "<script>alert('Please add money or select another method!')</script>";
echo "<script>window.location.href='".$currentURL."'</script>";
exit;
}
}


if(isset($_REQUEST['paypal_amount']) && $_REQUEST['paypal_amount']=="Paypal")
{

//echo "PAYPAL";
$cart_id = $_REQUEST['cartid'];
//$discountprice = $_REQUEST['discountprice'];
$commission_res = DB::table('commissions')->first();
$commission_percent = $commission_res->commission;
$cashback_amount = 0;
/*$user_session = session('logged_user');
$user_id = $user_session->id;*/
if(Auth::check())
{
$user_id = auth()->user()->id;
}
$user_data = DB::table('users')->where(array('id'=>$user_id))->first();
$uid = $user_data->u_id;

$user_address_data = DB::table('addresses')->where(array('user_id'=>$user_id))->first();
$address_id = $user_address_data->id;

$totalamount = str_replace(",", "", $_REQUEST['amount']);
if(isset($_REQUEST['discountprice']) && $_REQUEST['discountprice']!="")
{
$discountprice = str_replace(",", "", $_REQUEST['discountprice']);
}
else
{
$discountprice = 0;
}

if(isset($_REQUEST['walletamounthidden']) && isset($_REQUEST['wallet_amount']))
{
	$wallet_amount = $_REQUEST['wallet_amount'];
	$newtotalamount = (floatval($totalamount)) - $wallet_amount;	
}
else
{
	$wallet_amount = 0;
	$newtotalamount = (floatval($totalamount));	
}
//$newtotalamount = (floatval($totalamount) - floatval($discount_amount)) - $wallet_amount;
//$newtotalamount = (floatval($totalamount) - floatval($discount_amount)) - $wallet_amount;
if(isset($_REQUEST['cashback_amt']) && $_REQUEST['cashback_amt']!="")
{
$cashback_amount = $_REQUEST['cashback_amt'];
}
else
{
$cashback_amount = 0;
}
$random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$shuffle_str = str_shuffle($random_str);
$transaction_id = substr($shuffle_str,0,10);

$random_str1 = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$shuffle_str1 = str_shuffle($random_str1);
$oid = substr($shuffle_str1,0,5);

$addData=array(
    'oid'=>$oid,
    'walletamount'=>$wallet_amount,
    'totalamount'=>$newtotalamount,
    'discount_amount' => $discountprice,
    'cashback_amount'=>$cashback_amount,
    'delivery_charges'=>$totDelCharge,
    'buyer_id'=>$user_id,
    'transaction_id'=>$transaction_id,
    'is_paid'=>1,
    'uid'=>$uid,
    'payment_method'=>'Paypal',
    'address_id'=>$address_id,
    'payment_status'=>'Success',
    'status'=>1,
    'created_at'=>date('Y-m-d H:i:s')
);
DB::table('orders')->insert($addData);
$orderid = DB::getPdo()->lastInsertId();
foreach ($cart_id as $key=>$cart_idvalue) 
{
	$cartdata = DB::table('cart')->where(array('id'=>$cart_idvalue))->first();
	$product_id = $cartdata->product_id;
	$delivery_charges = $cartdata->delivery_charges;
	$discount_amount = $cartdata->discount_amount;
	$producttotalamount = $cartdata->totalamount;
	$commission = $producttotalamount*($commission_percent/100);
	$walletamount = $producttotalamount - $commission;
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
	//$is_subscription=$sellerdata->is_subscription;
	$addData1=array(
    'order_id'=>$orderid,
    'product_id' => $cartdata->product_id,
    'variant_id'=>$cartdata->variant_id,
    'quantity'=>$cartdata->quantity,
    'discount_amount'=>$discount_amount,
    'spec_detail'=>$cartdata->spec_detail,
    'seller_id'=>$seller_id,
    'seller_subscription_id'=>$seller_subscription_id,
    'product_amount'=>$cartdata->totalamount,
    'delivery_charges'=>$delivery_charges,
    'created_at'=>date('Y-m-d')
);
	//Coder::insert($addData1);
	DB::table('order_detail')->insert($addData1);
    $userdata = DB::table('users')->where(array('id'=>$seller_id))->first();
    $previous_wallet_amount = $userdata->wallet;
    $updated_wallet_amount = $walletamount + $previous_wallet_amount;
    $order_data = DB::table('orders')->where(array('id'=>$orderid))->first();
}
$updateData=array(
'orderid'=>$orderid,
);
DB::table('cart')->where(array('user_id'=>$user_id,'movetocheckout'=>1,'status'=>1))->update($updateData);
$updateData1=array(
'status'=>0,
);
DB::table('cart')->where(array('orderid'=>$orderid,'movetocheckout'=>1))->update($updateData1);
?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="paypalfrm2" id="paypalfrm2" method="post" target="_top">
	<center><h1>Please Wait While You Are Redirecting To Pay Pal...</h1></center>
	<center><h2>Please Do Not Refresh The Page</h2></center>
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="ledbltd@gmail.com">
	<input type="hidden" name="lc" value="GBP">
	<?php
	$srl = 0;
	$cartres = DB::table('cart')->where(array('orderid'=>$orderid,'user_id'=>$user_id))->get();
	foreach ($cartres as $cartresvalue) {
	$srl++;
	$product_id = $cartresvalue->product_id;
	$quantity = $cartresvalue->quantity;
	$productres = DB::table('products')->where(array('id'=>$product_id))->first();
	?>
	<input type="hidden" name="item_name_<?php echo $srl;?>" value="{{$productres->name}}">
	<input type="hidden" name="quantity_<?php echo $srl;?>" value="{{$quantity}}">
	<?php
	}
	?>
	<input type="hidden" name="custom" value="<?php echo $transaction_id;?>">
	<input type="hidden" name="amount" value="<?php echo $newtotalamount;?>">
	<input type="hidden" name="currency_code" value="GBP">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="0">
	<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
	<input type="hidden" name="return" value="{{url('/success')}}">
	<input type="hidden" name="notify_url" value="{{url('/response')}}">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="bn" value="incalllondon">
	<input type="hidden" name="image_url" value="https://development-review.net/emporium/public/front/img/LOGO-seller.jpg" style="hidden-align:center;">
</form>
<script type="text/javascript">
	document.paypalfrm2.submit();
</script>
<?php
}




if(isset($_REQUEST['paypal_amount']) && $_REQUEST['paypal_amount']=="Stripe")
{
	$walletamounthidden="";
	$cartid = implode(',',$_REQUEST['cartid']);
	$cashback_amt = str_replace(",", "", $_REQUEST['cashback_amt']);
	$totalamount = str_replace(",", "", $_REQUEST['amount']);
	$user_id = $_REQUEST['user_id'];
	if($_REQUEST['discountprice']!='')
	{
		$discountprice = str_replace(",", "", $_REQUEST['discountprice']);
	}
	else
	{
		$discountprice = 0;
	}
	if(isset($_REQUEST['wallet_amount']))
	{
	$totDelCharge = str_replace(",", "", $_REQUEST['totDelCharge']);
	$walletamounthidden = str_replace(",", "", $_REQUEST['walletamounthidden']);
	if($walletamounthidden>$totalamount)
	{
	$final_amount = $walletamounthidden-$totalamount;
	}
	else
	{
	$final_amount = $totalamount-$walletamounthidden;
	}
	}
	else
	{
		$final_amount = $totalamount;
	}
	?>
	@include('front.stripe.Stripe')
	<?php
	$params = array(
	"testmode"   => "on",
	"private_live_key" => "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",
	"public_live_key"  => "pk_live_51JX5TNGXLUn7XVFqQLGZQapiH7yBGBhLByOSThmeSaG1xmkZl9uAu4uejbXWKm7pxZFEik0vrU3m8tcQkwCTdLzQ00m1bTCxVN",
	"private_test_key" => "sk_test_51JX5TNGXLUn7XVFqQBfnTV6rErv1estkRcRqmUDhiN5ks9hRmeJJEv7jvKtFBMcnDfDvfusxbCoDTTI0xeBo5dr100itAeFXYw",
	"public_test_key"  => "pk_test_51JX5TNGXLUn7XVFqCbINRWKVDexvu2XWvGMcpOD3fugDi9Yb1YYfYj5yO2P0T6N9oSPs4eHYHFk0Ae9S1hmJClJv00qNvTWw3t"
	);


	Stripe::setApiKey($params['private_live_key']);
	$pubkey = $params['public_live_key'];

	?>
	@include('front.include.header')
	@yield('header')
	<div class="container">
	<div style="margin-top:20px;"></div>
	<div class="row">
	<div class="col-lg-8 mx-auto">
	<form action="{{url('stripesuccess')}}" onsubmit="onSubmit()" class="form-horizontal" method="POST" id="payment-form">
	<div class="mb-4 pb-3">
	<label for="" class="d-block ft-10 text-grey ft-medium">Payment Amount</label>
	<input type="text" class="form-control" name="name" value="£{{$final_amount}}" disabled>
	</div>

	<div class="mb-4 pb-3">
	<label for="accountNumber" class="d-block ft-10 text-grey ft-medium">CARD NUMBER</label>
	<!-- <input type="text" class="form-control" size="20" data-stripe="number" value="4111111111111111" required> -->
	<input type="text" class="form-control" size="20" data-stripe="number" value="" required>
	</div>

	<div class="row">
	<div class="col-md-6 mb-4">
	<label for="" class="d-block ft-10 text-grey ft-medium">Expiration Date</label>
	<select class="form-control col-sm-3" data-stripe="exp_month" required>
	<option>Month</option>
	<option value="01">Jan (01)</option>
	<option value="02">Feb (02)</option>
	<option value="03">Mar (03)</option>
	<option value="04">Apr (04)</option>
	<option value="05">May (05)</option>
	<option value="06">June (06)</option>
	<option value="07">July (07)</option>
	<option value="08">Aug (08)</option>
	<option value="09">Sep (09)</option>
	<option value="10">Oct (10)</option>
	<option value="11">Nov (11)</option>
	<!-- <option value="12" selected="">Dec (12)</option> -->
	<option value="12">Dec (12)</option>
	</select>
	</div>

	<div class="col-md-6 mb-4">
	<label></label>
	<select class="form-control" data-stripe="exp_year">
	<option value="22">2022</option>
	<!-- <option value="23" selected="">2023</option> -->
	<option value="23">2023</option>
	<option value="24">2024</option>
	<option value="25">2025</option>
	<option value="26">2026</option>
	<option value="27">2027</option>
	<option value="28">2028</option>
	<option value="29">2029</option>
	<option value="30">2030</option>
	</select>
	</div> 
	<div class="col-md-6 mb-4">
	<label for="" class="d-block ft-10 text-grey ft-medium">CVC CODE</label>
	<!-- <input type="text" class="form-control" data-stripe="cvc" value="123"> -->
	<input type="text" class="form-control" data-stripe="cvc" value="">
	</div>
	</div>

	<div class='my-4 alert  alert-danger payment-errors' style="display:none;"></div>
	<div class="text-center">
	<input type="hidden" name="totalamount" id="totalamount" value="{{$final_amount}}">
	<input type="hidden" name="cartid" id="cartid" value="{{$cartid}}">
	<input type="hidden" name="cashback_amount" id="cashback_amount" value="{{$cashback_amt}}">
	<input type="hidden" name="buyer_id" id="buyer_id" value="{{$user_id}}">
	<input type="hidden" name="discountprice" id="discountprice" value="{{$discountprice}}">
	<input type="hidden" name="totDelCharge" id="totDelCharge" value="{{$totDelCharge}}">
	<input type="hidden" name="walletamounthidden" id="walletamounthidden" value="{{$walletamounthidden}}">
	<input type="hidden" name="payment_method" id="payment_method" value="{{$payment_method}}">
	<button type="submit" class="btn_submit btn btn-primary w-lg-50 mx-auto mt-4 py-3 ft-medium ft-12 w-100 lock_before" name="pay" id="pay">Pay
	</button>
	<?php if(isset($response)){echo $response;} ?> 
	</div>
	</form><br><br>

	</div>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<!-- TO DO : Place below JS code in js file and include that JS file -->
	<script type="text/javascript">
        function onSubmit() {
        $('.btn_submit').attr('disabled', true);
        }
		Stripe.setPublishableKey('<?php echo $params['public_live_key']; ?>');

		$(function() {
			var $form = $('#payment-form');
			$form.submit(function(event) {
				// Disable the submit button to prevent repeated clicks:
				$form.find('.submit').prop('disabled', true);

				// Request a token from Stripe:
				Stripe.card.createToken($form, stripeResponseHandler);

				// Prevent the form from being submitted:
				return false;
			});
		});

		function stripeResponseHandler(status, response) {
			// Grab the form:
			var $form = $('#payment-form');
			if (response.error) 
			{ 	
				alert("Failed");
				// Problem!
				// Show the errors on the form:
				$form.find('.payment-errors').text(response.error.message).show();
				$form.find('.submit').prop('disabled', false); // Re-enable submission
			} 
			else 
			{ 
				alert("Success");
				// Token was created!
				// Get the token ID:
				var token = response.id;
				// Insert the token ID into the form so it gets submitted to the server:
				$form.append($('<input type="hidden" name="stripeToken">').val(token));
				// Submit the form:
				$form.get(0).submit();
			}
		};
	</script>
	@include('front.include.footer')
	@yield('footer')
	<?php
}
else
{
    $currentURL = URL::to('/myorders');
    //echo "<script>alert('Something Wrong!')</script>";
    echo "<script>window.location.href='".$currentURL."'</script>";
    exit;
}
?>