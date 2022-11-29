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
$ordersdetail = DB::table('order_detail')->select('*','users.name as bname','products.name as pname','orders.oid as ouid','buyers.uid as buid','orders.status as ostatus','orders.created_at as ocreated_at','order_detail.quantity as oquantity','addresses.address as oaddress','addresses.state as ostate','addresses.city as ocity','addresses.country as ocountry','orders.id as oid','products.image as pimage')->join('orders','orders.id','order_detail.order_id')->join('products','products.id','order_detail.product_id')->join('buyers','buyers.uid','orders.uid')->join('product_detail','product_detail.id','order_detail.variant_id')->join('users','users.id','orders.buyer_id')->join('addresses','addresses.id','orders.address_id')->Where('orders.buyer_id', $user_id)->get();
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
<h3 class="ft-medium ft-25 lh-36 m-0">My Orders</h3>

@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
</div>
</div>
<div class="w-100"></div>
<div class="col-xl-10 mx-auto  mt-4">
<div class="card shadow-sm rounded bg-white p-3 p-lg-5 my-5">
<?php
$ordersdetailcount = count($ordersdetail);
if($ordersdetailcount>0)
{
foreach($ordersdetail as $orderdetail)
{
$myorderid = $orderdetail->order_id;
/*$orderdata=DB::table('order_detail')->where('order_id',$myorderid)->first();
$product_id = $orderdata->product_id;
$productdata=DB::table('products')->where('id',$product_id)->first();*/
$spec_details = unserialize($orderdetail->spec_detail);
$date = strtotime("+7 day");
$explode_date = explode(" ",$orderdetail->ocreated_at);
$product_id = $orderdetail->product_id;
$productdata=DB::table('products')->where('id',$product_id)->first();
$cartdata=DB::table('cart')->where(array('orderid'=>$myorderid,'product_id'=>$product_id,'user_id'=>$user_id))->first();
$date = new DateTime(date($explode_date[0]));
$date->modify('+7 day');
$deliver_date = $date->format('Y-m-d');
$deliver_date=date_create($deliver_date);
$final_date = date_format($deliver_date,"d M Y");
?>
<div class="checkout_product_list mb-5 table-mobile2 px-4 py-3 border rounded-3">
<table class="table table-borderless">
<tbody>
<tr>
<td style="width: 75px;">
<div class="checkout_prod_img me-4">
<a href="{{url('/order-detail/')}}/{{$orderdetail->oid}}">
<img src="{{ asset('public/products/'.$productdata->image) }}" class="shadow" width="64px" alt=""></a>
</div>
</td>
<td>
<div class="d-flex flex-wrap justify-content-between">
<div class="checkout_prod_desc pt-2">

<a href="{{url('/order-detail/')}}/{{$orderdetail->oid}}"> <p class="ft-12 lh-18 ft-medium mb-0">{{$orderdetail->pname}}</p></a>
<small class="ft-10">
@php foreach($spec_details as $key=>$spec_detail){
if($key != 'vprice'){ @endphp

{{ucfirst($key)}}: <span class="text-grey">{{$spec_detail}}</span>
@php } } @endphp  
</small>
</div>
<div class="text-end">
<p class="text-black mb-0"><u class="text-grey">Amount to be Paid:</u> <strong>£{{$orderdetail->product_amount}}</strong></p>
<?php
if($cartdata)
{
?>
<small class="ft-10 d-block">Cashback you will earn <span class="text-green">£{{$cartdata->cashback}}</span></small>
<?php
}
?>
</div>
</div>
<hr>
<div class="d-flex gap-4 flex-wrap">
<div class="lh-20 text-black ft-12">
<small class="ft-10">Ship to:</small> <br> {{$orderdetail->bname}}
</div>
<div class="lh-20 text-black ft-12">
<small class="ft-10">Address:</small> <br> {{$orderdetail->oaddress}}, {{$orderdetail->ocity}}, {{$orderdetail->ostate}}, {{$orderdetail->ocountry}}.
</div>
</div>
</td>
<td class="text-end ft-11 ft-500">
<p class="mb-0"><span class="text-grey">Status</span>
@php 
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
<div class="d-flex align-items-center gap-4 justify-content-end flex-wrap mt-2">
@php
if($orderdetail->ostatus != 4){
@endphp
<a target="_blank" href="{{url('/ordermail/')}}/{{$myorderid}}" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Invoice</a>
<a href="javascript:void(0)" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Track</a>
<a href="javascript:void(0)" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2 cancelpopup" order="{{$orderdetail->oid}}"><span class="text-danger ft-bold">Cancel this Order</span></a>
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
<div class="alert alert-danger" style="text-align:center;">Your Order History Is Empty</div>
<?php
}
?>
</div>
</div>
</div>
<div class="w-100 my-5"></div>
</div>
</div>


<div class="modal fade" id="cancelPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">

<div class="modal-header"> 
<h4 class="modal-title" id="exampleModalLongTitle" style="text-align:center">Cancel Order</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form method="post" action="{{url('/cancel-order')}}" enctype="multipart/form-data">
<div class="modal-body" id="seller_details_div">

@csrf
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Cancellation Reason</label>
<select type="text" name="reason" id="reason" class="form-control" required>
<option value="1">Getting a better price</option>
<option value="2">Not interested anymore</option>
<option value="3">Ordered wrong product</option>
<option value="4">Got this product offline</option>
<option value="5">Other</option>
</select>  
<input type="hidden" id="cancel_order_id" name="cancel_order_id">
</div>
</br>
</div>


<div class="col-md-12 descriptionclass" style="display:none">
<div class="form-group">
<label>Description</label>
<textarea   class="form-control" name="description" id="description"  disabled required></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Submit</button>
<button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
</div>
</form>

</div>
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
$("#imageform").submit();
}

$('.cancelpopup').click(function(){
let order_id = $(this).attr("order");
$("#cancel_order_id").val(order_id);
$("#cancelPopup").modal("show");

})


$("#reason").change(function(){
if($(this).val() == 5){
$("#description").prop('disabled', false);
$('.descriptionclass').show();
}else{
$("#description").prop('disabled', true);
$('.descriptionclass').hide();
}
})

$(".close").click(function(){
$("#cancelPopup").modal("hide");
})

</script>
@include('front.include.footer')
@yield('footer')