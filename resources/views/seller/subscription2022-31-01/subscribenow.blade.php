<?php
$subscription_name = '';
$transaction_id = '';
if(isset($_REQUEST['userid']))
{
	$seller_user_id = $_REQUEST['userid'];
	$subscription_amount = $_REQUEST['price'];
	$subscription_detail = DB::table('subscriptions')->where('price',$subscription_amount)->first();
	$subscription_id = $subscription_detail->id;
	$subscription_name = $subscription_detail->plan_name;
	$subscription_duration = $subscription_detail->duration;
	$random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$shuffle_str = str_shuffle($random_str);
	$transaction_id = substr($shuffle_str,0,10);
	$NewDate=Date('y:m:d', strtotime("+30 days"));
	$subscription_start_date = date('Y-m-d H:i:s');
	$subscription_end_date=Date('Y-m-d H:i:s', strtotime("+30 days"));

		$addData=array(
		    'amount'=>$subscription_amount,
		    'seller_id' => $seller_user_id,
		    'subscription_id'=>$subscription_id,
		    'transaction_id'=>$transaction_id,
		    'payment_status'=>'Processing',
		    'start_date'=>$subscription_start_date,
		    'end_date'=>$subscription_end_date,
		    'duration'=>$subscription_duration,
		    'created_at'=>date('Y-m-d H:i:s')
		);
		DB::table('seller_subscriptions')->insert($addData);
		$id = DB::getPdo()->lastInsertId();


		$updateData=array(
		'seller_subscription_id'=>$id,
		);
		DB::table('sellers')->where(array('user_id'=>$seller_user_id))->update($updateData);
?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="paypalfrm2" id="paypalfrm2" method="post" target="_top">
	<center><h1>Please Wait While You Are Redirecting To Pay Pal...</h1></center>
	<center><h2>Please Do Not Refresh The Page</h2></center>
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="ledbltd@gmail.com">
	<input type="hidden" name="lc" value="GBP">
	<input type="hidden" name="item_name" value="<?php echo $subscription_name ;?>">
	<input type="hidden" name="custom" value="<?php echo $transaction_id;?>">
	<input type="hidden" name="amount" value="<?php echo $subscription_amount;?>">
	<input type="hidden" name="currency_code" value="GBP">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="0">
	<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
	<input type="hidden" name="return" value="{{url('/seller/success')}}">
	<input type="hidden" name="notify_url" value="{{url('/seller/success')}}">
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
?>