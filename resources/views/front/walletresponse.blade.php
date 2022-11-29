@include('front.include.header')
@yield('header')
<?php
$Msg = "";
if(isset($_REQUEST['custom']) && $_REQUEST['custom']!="")
{
    if(Auth::check())
    {
    $buyer_id = auth()->user()->id;
    $transaction_id = $_REQUEST['custom'];
    $payment_response = DB::table('payment_response')->where(array('custom'=>$transaction_id))->first();

    $orderid = $payment_response->orderid;
    $payment_status = $payment_response->payment_status;
    $walletamount = $payment_response->payment_gross;
        if($payment_status=='Success')
        {
            $userdata = DB::table('users')->where(array('id'=>$buyer_id))->first();
            $previous_wallet_amount = $userdata->wallet;
            $name = $userdata->name;
            $updated_wallet_amount = $walletamount + $previous_wallet_amount;
            $updateData=array(
            'wallet'=>$updated_wallet_amount,
            );
            DB::table('users')->where(array('id'=>$buyer_id))->update($updateData);
            
            $addData = array(
            'payment_method'=>'Paypal',
            'amount'=>$walletamount,
            'user_id'=>$buyer_id,
            'admin_amount'=>0,
            'seller_amount'=>0,
            'buyer_amount'=>$walletamount,
            'status'=>$payment_status,
            'type'=>5,
            'transaction_id'=>$transaction_id,
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
                <center><span style="font-size: 18px;text-align:center;">Your Transaction ID No: {{$transaction_id}}</span></center>
                <center><span style="font-size: 18px;text-align:center;">Your Payment Status is <strong>{{$payment_status}}</strong></span></center>
                <center><span style="font-size: 18px;text-align:center;">Money has been added to your emporium wallet.</span></center>
        </div>
    </div>   
</div>
@include('front.include.footer')
@yield('footer')
<script>
 setTimeout(function(){
    window.location.href = "{{url('/update-profile')}}";
 }, 5000);
</script>