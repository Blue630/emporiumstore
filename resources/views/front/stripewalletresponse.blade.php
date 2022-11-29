<?php
$amount = $_REQUEST['totalamount'];
$buyer_id = $_REQUEST['buyer_id'];
$payment_method = $_REQUEST['payment_method'];
$stripeToken = $_REQUEST['stripeToken'];
?>
@include('front.stripe.Stripe')
<?php
$params = array(
		"testmode"   => "on",
		"private_live_key" => "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",
	    "public_live_key"  => "pk_live_51JX5TNGXLUn7XVFqQLGZQapiH7yBGBhLByOSThmeSaG1xmkZl9uAu4uejbXWKm7pxZFEik0vrU3m8tcQkwCTdLzQ00m1bTCxVN",
		//"private_live_key" => "sk_live_UUCOI2p5f6ye9oqmIPKgohSW",
		//"public_live_key"  => "pk_live_NM71jfG5jXk2ChKV4PnBW6Uw",
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
	$amount_cents = str_replace(",", "", $amount)*100; // Chargeble amount
	$description = "Invoice #" . $invoiceid . " - " . $invoiceid;
	try
	{
		$charge = Stripe_Charge::create(array(
						"amount" => $amount_cents,
						"currency" => "gbp",
						"source" => $_POST['stripeToken'],
						"description" => $description)
		);
		/*echo "<pre>";
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
$userdata = DB::table('users')->where(array('id'=>$buyer_id))->first();
$previous_wallet_amount = $userdata->wallet;
$name = $userdata->name;
$updated_wallet_amount = $amount + $previous_wallet_amount;
$updateData=array(
'wallet'=>$updated_wallet_amount,
);
DB::table('users')->where(array('id'=>$buyer_id))->update($updateData);

$addData = array(
'payment_method'=>'Stripe',
'amount'=>$amount,
'user_id'=>$buyer_id,
'admin_amount'=>0,
'seller_amount'=>0,
'buyer_amount'=>$amount,
'status'=>'Success',
'type'=>5,
'transaction_id'=>$stripeToken,
);
DB::table('transaction_history')->insert($addData);
$id = DB::getPdo()->lastInsertId();
?>
@include('front.include.header')
@yield('header')
<div class="container" style="margin-top:30px;">
<div class="row">
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	<div class="check-out" style="text-align:center; color:red; font-size:20px;">Payment Status</div>
	<br/>
		<center><span style="font-size: 18px;text-align:center;">Hi, {{$name}}</span></center>
		<center><span style="font-size: 18px;text-align:center;">Your Transaction ID No: {{$stripeToken}}</span></center>
		<center><span style="font-size: 18px;text-align:center;">Your Payment Status is <strong>{{$result}}</strong></span></center>
		<center><span style="font-size: 18px;text-align:center;">Money has been added to your emporium wallet.</span></center>
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
<script>
 setTimeout(function(){
    window.location.href = "{{url('/update-profile')}}";
 }, 5000);
</script>