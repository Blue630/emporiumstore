@include('front.include.header')
@yield('header')   
@php
use App\Buyer;
use App\Addresses;
use App\Coupon;
use App\Wishlist;

if(Auth::check())
{
$user_id = auth()->user()->id;
}

$orderdetails = DB::table('order_detail')->select('*','users.name as bname','products.name as pname','orders.oid as ouid','buyers.uid as buid','orders.status as ostatus','orders.created_at as ocreated_at','orders.track_id as track_id','order_detail.quantity as oquantity','addresses.address as oaddress','addresses.state as ostate','addresses.city as ocity','addresses.country as ocountry','addresses.pincode as addpincode','addresses.phoneno as addpno','products.image as pimage','sellers.state as sstate','sellers.reg_business_name as sellername','orders.totalamount as oamount','orders.id as oid','order_detail.id as detail_id')->join('orders','orders.id','order_detail.order_id')->join('products','products.id','order_detail.product_id')->join('buyers','buyers.uid','orders.uid')->join('users','users.id','orders.buyer_id')->join('sellers','sellers.user_id','order_detail.seller_id')->join('product_detail','product_detail.id','order_detail.variant_id')->join('addresses','addresses.id','orders.address_id')->Where('order_detail.order_id', $order_id)->Where('orders.buyer_id', $user_id)->get();
@endphp
<!-- content area start -->
<div class="seller_login_banner2 pt-5">
<div class="container px-lg-5">
<div class="shadow-set bg-white-trans p-5 mt-5">
<div class="">
<a href="{{url('/update-profile/')}}" class="text-grey"><i data-feather="arrow-left-circle" class="text-black"></i> <span class="ft-10">BACK TO PROFILE</span></a>
</div>
<div class="px-lg-5">
<div class="row">
<div class="col-xl-10 mx-auto pt-lg-5">
<div class="d-flex justify-content-between align-items-center flex-wrap   mt-5 border-bottom border-3 pb-3">
<h3 class="ft-medium ft-25 lh-36 m-0">Order Details</h3>
</div>
</div>
<div class="w-100"></div><div class="col-xl-10 mx-auto  mt-4">
@php                        
foreach($orderdetails as $orderdetail){
$date = strtotime("+7 day");
$explode_date = explode(" ",$orderdetail->ocreated_at);
$date = new DateTime(date($explode_date[0]));
$order_date = date_format($date,"d M Y");
$date->modify('+7 day');
$deliver_date = $date->format('Y-m-d');
$deliver_date=date_create($deliver_date);
$final_date = date_format($deliver_date,"d M Y");
$spec_details = unserialize($orderdetail->spec_detail);
$product_id = $orderdetail->product_id;
$order_id = $orderdetail->order_id;
$productdata=DB::table('products')->where('id',$product_id)->first();
$cartdata=DB::table('cart')->where(array('orderid'=>$order_id,'product_id'=>$product_id,'user_id'=>$user_id))->first();
@endphp
<div class="card shadow-sm rounded bg-white p-3 p-lg-5 my-5">
<div class="checkout_product_list table-mobile2">
<div class="d-flex order_date flex-wrap justify-content-between">
<p><span class="text-grey">Order Placed on</span> {{$order_date}}</p>
<p><span class="text-grey">Order ID# </span> {{$orderdetail->ouid}} </p>
</div>
<table class="table table-borderless">
<tbody>
<tr>
<td style="width: 160px;">
<div class="checkout_prod_img me-4">
<a href="{{url('/product-detail/')}}/{{$orderdetail->slug}}">
<img src="{{ asset('public/products/'.$productdata->image) }}" class="shadow" width="160px" alt="">
</a>
</div>
</td>
<td>
<div class="checkout_prod_desc pt-2">
<a href="{{url('/product-detail/')}}/{{$orderdetail->slug}}">
<p class="ft-12 lh-18 ft-medium mb-2">{{$orderdetail->pname}}</p></a>
<small class="ft-10 text-grey lh-16 d-block">
@php foreach($spec_details as $key=>$spec_detail){
if($key != 'vprice'){ @endphp
{{ucfirst($key)}}: <span class="text-black">{{$spec_detail}}</span><br>
@php } } @endphp   
Sold by:<span class="text-black">{{$orderdetail->sellername}} ({{$orderdetail->sstate}})</span>
</small>
<p class="mt-3 mb-0"><strong>£{{$orderdetail->product_amount}}</strong>
<!--<small class="ft-10">(Cash on Delivery)</small>-->
</p>
<p class="ft-12">Cashback <span class="text-green">£{{$cartdata->cashback}}</span></p>
</div>
</td>
<td class="text-end ft-11 ft-500">
<p class="mb-0"><span class="text-grey">Status</span>  @php 
if($orderdetail->ostatus == 1){
echo 'Processing';
}
else if($orderdetail->ostatus == 2){
echo 'Order in Transit';
}
else if($orderdetail->ostatus == 3){
echo 'Order Delivered';
}
else if($orderdetail->ostatus == 4){
echo 'Cancelled';
}
@endphp
</p>
<p class="mb-0"><span class="text-grey">Expected Delivery by</span> {{$final_date}}</p>
<p class="mb-0"><span class="text-grey">Delivery Partner</span> Parcelhub</p>
<p class="mb-0"><span class="text-grey">Track Id</span> {{$orderdetail->track_id}}</p>
<div class="d-flex align-items-center gap-4 justify-content-end flex-wrap mt-2">
<a href="https://www.parcelhub.co.uk/" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Track</a>
</div>
<div class="d-flex ft-8 lh-12 justify-content-end mt-3 text-end">
<span class="d-block me-2">Note:</span>
<small class="d-block"> We will inform you in case of the delay in delivery due to <br class="d-none d-md-block"> the Pandemic regulations issued by the UK Government.</small>
</div>
</td>
</tr>
</tbody>
</table>
<div class="order_address_details">
<div class="row gx-5">
<div class="col-lg-4 mt-5">
<h3 class="ft-20">Delivery Address</h3>
<address>
{{$orderdetail->oaddress}} <br>
Postcode {{$orderdetail->addpincode}}, <br>
{{$orderdetail->ocountry}}.<br>
Phone {{$orderdetail->addpno}}</address>
</div>
<div class="col-lg-4 mt-5">
@php    if($orderdetail->is_paid == 0){  @endphp
<h3 class="ft-20">Payment Method</h3>
<p>
<br> Pay now online to avoid Cash hassles and contact-less delivery.
</p>
<div class="d-flex align-items-center">
<a href="javascript:void(0)" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Pay</a>
</div>
@php } @endphp
</div>
@php  if($orderdetail->ostatus == 3 && $orderdetail->is_rated == 0){  @endphp
<div class="col-lg-4 mt-5">
<form method="post" action="{{url('rate-product')}}" enctype="multipart/form-data">
{{ csrf_field() }}
<h3 class="ft-20">Rate & Review</h3>
<div class="d-flex align-items-center gap-3">
<div class="rating_box">
<fieldset class="prod_rating">
<input type="hidden" name="product_id" value="{{$orderdetail->product_id}}">
<input type="hidden" name="detail_id" value="{{$orderdetail->detail_id}}">
<input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
<input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
<input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Average - 3 stars"></label>
<input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
<input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
</fieldset>
</div>
</div>
<input class="form-control h-25" type="text" name="title" placeholder="Type Review Title">
<input class="form-control mt-4 h-25" type="file" name="images[]" multiple>
<textarea name="review" id="" class="form-control ft-10 mt-4" placeholder="Type your review.."></textarea>
<div class="text-end d-flex">
<button type="submit" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Review</button>
</div>
</form>
</div>
@php } @endphp
</div>
</div>
</div>
</div>
@php } @endphp
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
/** shift to custom Js **/
$('.behavecheckbox').mousedown(function(e) {
var $self = $(this);
if ($self.is(':checked')) {
var uncheck = function() {
setTimeout(function() {
$self.prop('checked', false);
}, 0);
};
var unbind = function() {
$self.unbind('mouseup', up);
};
var up = function() {
uncheck();
unbind();
};
$self.bind('mouseup', up);
$self.one('mouseout', unbind);
}
});
/** shift to custom Js end**/
$("[data-coupon]").click(function(event) {
var $tempElement = $("<input>");
$("body").append($tempElement);
$tempElement.val($(this).attr('data-coupon')).select();
document.execCommand("Copy");
$tempElement.remove();
$(this).text($(this).attr('data-coupon'));
alert("Copied successfully");
});
$('.qtyminus').click(function(e) {
var min = parseInt($(this).next('input').attr('min'));
var max = parseInt($(this).next('input').attr('max'));
var step = parseInt($(this).next('input').attr('step'));
var current = parseInt($(this).next('input').val());
var newval = (current - step);
if (newval < min) {
newval = min;
} else if (newval > max) {
newval = max;
}
$(this).next('input').val(newval);
e.preventDefault();
});
$('.qtyplus').click(function(e) {
var min = parseInt($(this).prev('input').attr('min'));
var max = parseInt($(this).prev('input').attr('max'));
var step = parseInt($(this).prev('input').attr('step'));
var current = parseInt($(this).prev('input').val());
var newval = (current + step);
if (newval > max) {
newval = max;
}
$(this).prev('input').val(newval);
e.preventDefault();
});
/** image Js **/
function ImageSetter(input, target) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
target.attr('src', e.target.result);
}
reader.readAsDataURL(input.files[0]);
}
}
$("#uploaduser").change(function() {
var imgDiv = $(this).data('id');
imgDiv = $('#userimage');
ImageSetter(this, imgDiv);
});
/** image Js **/
$('.append_walletamount [data-value]').click(function() {
var saveamount = $(this).data('value');
$(this).parents('.add_money_form').find('[type="text"]').val(saveamount);
});
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();
if (dd < 10) {
dd = '0' + dd
}
if (mm < 10) {
mm = '0' + mm
}
today = yyyy + '-' + mm + '-' + dd;
document.getElementById("datefield").setAttribute("max", today);
});
function uploadImage(){
// let formdata = new Formdata();
$("#imageform").submit();
// $.ajax({
// type: "post",
// url: "{{url('/cart/addtoCart')}}",
// data:{"product_id":product_id, _token: '{{csrf_token()}}',"variantarray":variantarray,"quantity":quantity,"price":price,"user_id":user_id,"variantIds":variantIds},
// success: function(data){
// window.location.href='{{url("/cart")}}';
// }
// })
}
</script>
@include('front.include.footer')
@yield('footer')