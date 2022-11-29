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
	$amount = $payment_response->payment_gross;
		if($payment_status=='Success')
		{
			$bid_id = $_REQUEST['item_name'];
			$name = $user_session->name;
			
			$updateData=array(
			'status'=>3,
			'paid'=>1,
			);
			DB::table('biddings')->where(array('id'=>$bid_id))->update($updateData);
		
			
			$bidding_data = DB::table('biddings')->where(array('id'=>$bid_id))->first();
			
			$auction_table_data = [
			    'bidding_id'=>$bid_id
			    ];
			
			DB::table('auctions')->where(array('id'=>$bidding_data->auction_id))->update($auction_table_data);
			
			
	DB::table('biddings')->where(array('auction_id'=>$bidding_data->auction_id,'paid'=>0))->update(["status"=>4]);
			
			$addData = array(
			'payment_method'=>'Paypal',
			'amount'=>$amount,
			'user_id'=>$buyer_id,
			'admin_amount'=>$amount,
			'seller_amount'=>0,
			'buyer_amount'=>0,
			'status'=>$payment_status,
			'type'=>2,
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
				<center><span style="font-size: 18px;text-align:center;">Your Order No: {{$orderid}}</span></center>
				<center><span style="font-size: 18px;text-align:center;">Your Payment Status is <strong>{{$payment_status}}</strong></span></center>
				<center><span style="font-size: 18px;text-align:center;"> THANKS FOR YOUR PURCHASE.<br> YOU WILL RECEIVE AN INVOICE BY EMAIL SHORTLY.</span></center>
		</div>
	</div>   
</div>
@include('front.include.footer')
@yield('footer')
<script>
 setTimeout(function(){
    window.location.href = "{{url('/mybids')}}";
 }, 5000);
</script>