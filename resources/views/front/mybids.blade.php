@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="seller_login_banner2 pt-5">

<div class="container px-lg-5">
<div class="shadow-set bg-white-trans p-5 mt-5">
<div class="">
<a href="{{url('/update-profile/')}}" class="text-grey"><i data-feather="arrow-left-circle" class="text-black"></i> <span class="ft-10">BACK TO PROFILE</span></a>
</div>


<div class="px-lg-5">
<div class="row">
<div class="col-lg-11 col-xl-10 mx-auto pt-lg-5">
<div class="d-flex justify-content-between align-items-center flex-wrap   mt-5 border-bottom border-3 pb-3">
<h3 class="ft-medium ft-25 lh-36 m-0">My Bids</h3>

</div>
</div>
<div class="w-100"></div>
<div class="col-lg-10 mx-auto  mt-4">
<div class="card shadow-sm rounded bg-white p-5 my-5">
<?php
$bidscount = count($bids);
if($bidscount>0)
{
foreach($bids as $bid)
{
?>
<div class="checkout_product_list mb-5 table-mobile px-lg-5 py-3">
<table class="table table-borderless">
<tbody>
<tr>
<td style="width: 75px;">
<div class="checkout_prod_img me-4">
<a href="{{url('/product-detail/')}}/{{$bid->slug}}">
<img src="{{asset('/public/products')}}/{{$bid->image}}" class="shadow" width="64px" alt=""></a>
</div>
</td>
<td>
<div class="checkout_prod_desc pt-2"><a href="{{url('/product-detail/')}}/{{$bid->slug}}">
<p class="ft-12 lh-18 ft-medium mb-0">{{$bid->name}}</p></a>
<!--<small class="ft-10">SIZE: <span class="text-grey">10-</span>(UK) COLOR: <span class="text-grey">BLACK</span></small>-->
</div>
</td>
@php 
$auction_date =  date_create($bid->acreated_at);
$auction_date = date_format($auction_date,"F d, Y  h:iA");
@endphp
<td class="text-end">
<div class="checkout_price ft-15 lh-22 ft-medium text-grey mb-3">
BID : GBP {{$bid->bid}}
</div>
<div class="checkout_price ft-15 lh-22 ft-medium text-grey mb-3">
Status : 
@php if($bid->bstatus ==1){ @endphp
Bid Place
@php } else if($bid->bstatus ==2){ @endphp
Bid Awarded (Due for Payment) 
@php } else if($bid->bstatus ==3){ @endphp
Bid Proceed
@php } else if($bid->bstatus ==4){ @endphp
Bid Decline
@php } else if($bid->bstatus ==5){ @endphp
Bid Expired
@php } else if($bid->bstatus ==6){ @endphp
Bid Close
@php } @endphp
</div>

<div class="checkout_price ft-15 lh-22 ft-medium text-grey mb-3">
Auction Date : {{$auction_date}} 
</div>



<div class="d-flex align-items-center gap-4 justify-content-end flex-wrap">
@php if($bid->bstatus == 2 and $bid->paid ==0){ @endphp

<form action="{{url('/bidpayment')}}">
@csrf
<input type="hidden" name="user_id" id="user_id" value="{{$bid->bid_user_id}}">
<input type="hidden" name="bid_id"  value="{{$bid->bidid}}">


<input type="hidden" id="amount" name="amount" value="{{$bid->bid}}">


<div class="mt-5">
<button type="submit" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Pay now</button>
</div>
</form>


@php } @endphp
</div>
</td>

</tr>
</tbody>
</table>
</div>
<?php
}
}
else
{
?>
<div class="alert alert-danger" style="text-align:center;">Your Bid History Is Empty</div>
<?php
}
?>

</div>

</div>
</div>
<div class="w-100 my-5"></div>
</div>

</div>
</div>


<div class="h-50px"></div>


</div>

<!-- content area End -->

<script>
$(function() {
$('.enterpayprice').keyup(function() {
var saveamount = $(this).val();
if (saveamount) {
$('.payprice').text('£ ' + saveamount);
} else {
$('.payprice').text('');
}
});
});
</script>
@include('front.include.footer')
@yield('footer')