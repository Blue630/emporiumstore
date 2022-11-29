<?php
if(isset($_REQUEST['seller_id']))
{
	$seller_id = $_REQUEST['seller_id'];
    $feature_subscription_amount = $_REQUEST['feature_subscribe_amount'];
	$random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$shuffle_str = str_shuffle($random_str);
	$transaction_id = substr($shuffle_str,0,10);
	$NewDate=Date('y:m:d', strtotime("+14 days"));
	$subscription_start_date = date('Y-m-d');
	$subscription_end_date=Date('Y-m-d', strtotime("+14 days"));
	$addData=array(
	    'seller_id'=>$seller_id,
	    'featured_subscription_id' => 1,
	    'start_date'=>$subscription_start_date,
	    'end_date'=>$transaction_id,
	    'payment_status'=>'Processing',
	    'start_date'=>$subscription_start_date,
	    'end_date'=>$subscription_end_date,
	    'amount'=>$feature_subscription_amount,
	    'duration'=>15,
	    'transaction_id'=>$transaction_id,
	    'payment_status'=>'Processing',
	    'created_at'=>date('Y-m-d')
	);
	DB::table('seller_featured_subscription')->insert($addData);
	$id = DB::getPdo()->lastInsertId();
        /*$updateData=array(
        'seller_featured_subscription_id'=>$id,
        );
        DB::table('sellers')->where(array('user_id'=>$seller_user_id))->update($updateData);*/
?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="paypalfrm2" id="paypalfrm2" method="post" target="_top">
	<center><h1>Please Wait While You Are Redirecting To Pay Pal...</h1></center>
	<center><h2>Please Do Not Refresh The Page</h2></center>
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="ledbltd@gmail.com">
	<input type="hidden" name="lc" value="GBP">
	<input type="hidden" name="item_name" value="Featured Subscription">
	<input type="hidden" name="custom" value="<?php echo $transaction_id;?>">
	<input type="hidden" name="amount" value="<?php echo $feature_subscription_amount;?>">
	<input type="hidden" name="currency_code" value="GBP">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="0">
	<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
	<input type="hidden" name="return" value="{{url('/seller/thankyou')}}">
	<input type="hidden" name="notify_url" value="{{url('/seller/thankyou')}}">
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