<?php
$payment_method = $_REQUEST['payment_method'];
$feature_subscription_amount = $_REQUEST['feature_subscribe_amount'];
$seller_id = $_REQUEST['seller_id'];
if($payment_method=="Paypal")
{
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
        'payment_status'=>'Processing',
        'start_date'=>$subscription_start_date,
        'end_date'=>$subscription_end_date,
        'amount'=>$feature_subscription_amount,
        'duration'=>15,
        'transaction_id'=>$transaction_id,
        'created_at'=>date('Y-m-d')
    );
    DB::table('seller_featured_subscription')->insert($addData);
    $id = DB::getPdo()->lastInsertId();
        /*$updateData=array(
        'seller_featured_subscription_id'=>$id,
        );
        DB::table('sellers')->where(array('user_id'=>$seller_user_id))->update($updateData);*/
?>
<form action="https://www.paypal.com/cgi-bin/webscr" name="paypalfrm2" id="paypalfrm2" method="post" target="_top">
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
else
{
?>
@include('front.stripe.Stripe')
<?php
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
?>
@extends('admin.layout.layout') @section('content')
<div class="container">
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
<div style="margin-top:20px;"></div>
<div class="row">
<div class="col-lg-8 mx-auto">
<form action="{{url('/seller/stripethankyou')}}" class="form-horizontal" method="POST" id="payment-form">
<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Subscription Amount</label>
<input type="text" class="form-control" name="name" value="£{{$feature_subscription_amount}}" disabled>
</div>

<div class="mb-4 pb-3">
<label for="accountNumber" class="d-block ft-10 text-grey ft-medium">CARD NUMBER</label>
<input type="text" class="form-control" size="20" data-stripe="number" value="4111111111111111" required>
</div>

<div class="row">
<div class="col-md-6 mb-6">
<label for="" class="d-block ft-10 text-grey ft-medium">Expiration Month</label>
<select class="form-control" data-stripe="exp_month" required>
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
<label for="" class="d-block ft-10 text-grey ft-medium">Expiration Year</label>
<?php
$year = date("Y"); 
/*$yearvalue = substr(date("Y"),2); 
$endyear = date('Y', strtotime('+10 years'));
$endyearvalue = substr(date('Y', strtotime('+10 years')),2);*/
?>
<select class="form-control" data-stripe="exp_year">
<?php
for($i=22; $i<=32; $i++) 
{
?>
<option value="<?php echo $i;?>" <?php if($i==$year) { echo "selected"; }?>>{{$i}}</option>
<?php
}
?>

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
<input type="hidden" name="totalamount" id="totalamount" value="{{$feature_subscription_amount}}">
<input type="hidden" name="seller_id" id="seller_id" value="{{$seller_id}}">
<input type="hidden" name="payment_method" id="payment_method" value="{{$payment_method}}">
<button type="submit" class="btn btn-primary w-lg-50 mx-auto mt-4 py-3 ft-medium ft-12 w-100 lock_before" name="pay" id="pay">Pay
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
@section('script')
@stop @endsection
<?php
}
?>