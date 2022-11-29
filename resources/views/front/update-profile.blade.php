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
$user_details = DB::table('users')->Where('id', $user_id)->first();

$buyer_details = Buyer::fetchBuyerDetailsOnUID($user_details->u_id);

$user_details1 = $user_details->user_type;

$seller_details = DB::table('sellers')->where(array('u_id'=>$user_details->u_id))->first();

$primary_address = Addresses::fetchBuyerPrimaryAddress($user_details->id);  
if(!empty($primary_address->id)){
$primary_add_id = $primary_address->id;
$full_address= $primary_address->address;
$country= $primary_address->country;
$pincode= $primary_address->pincode;
$city= $primary_address->city;
$state= $primary_address->state;
}else{
$primary_add_id = '';
$full_address='';
$country='';
$pincode='';
$city='';
$state='';
}

@endphp

<!-- content area start -->

<div class="seller_login_banner2 pt-5">

<div class="container px-lg-5">
<div class="shadow-set bg-white-trans p-5 mt-5">
<div class="d-flex flex-wrap">
<a href="{{url('/')}}" class="text-black"><i data-feather="arrow-left-circle"></i> <span class="ft-10">BACK</span></a>
<nav class="text-center ms-auto">
<ol class="breadcrumb justify-content-center text-uppercase">
<li class="breadcrumb-item"><a href="{{url('/')}}">BACK TO HOMEPAGE</a></li>
<li class="breadcrumb-item active" aria-current="page">UPDATE PROFILE</li>
</ol>
</nav>
</div>


<div class="px-lg-5">
<div class="row">
<div class="col-lg-6 col-xl-4 px-lg-5">
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="px-5">
<div class="card shadow py-5 px-4 text-center">
<?php
if($user_details1==3)
{
?>
<img src="{{asset('/public/front')}}/img/{{$buyer_details->image}}" class="img-fluid mx-auto d-block rounded-circle" style="max-width: 114px;" alt="">
<?php
if($buyer_details->image!='')
{
?>
<a href="#" class="delete_btn" id="{{$buyer_details->id}}">X</a>
<?php
}
}
else
{
?>
<a href="#" class="delete_btn" id="{{$seller_details->id}}"><img src="{{asset('/public/front')}}/img/{{$seller_details->image}}" class="img-fluid mx-auto d-block rounded-circle" style="max-width: 114px;" alt="">X</a>
<?php
}
?>
<p class="ft-medium pt-3">Hello, {{$user_details->name}}</p>
<p class="email ft-medium">{{$user_details->email}}</p>
<?php
if($user_details1==3)
{
?>
<p class="phone ft-medium">{{$buyer_details->phone}}</p>
<?php
}
else
{
?>
<p class="phone ft-medium">{{$seller_details->phone}}</p>
<?php
}
?>
<p class="location ft-grey m-0">{{$city}}, {{$state}}</p>

</div>
<div class="card shadow py-5 px-4  text-center my-4">
<strong class="d-block ft-medium mb-2">Select Profile Photo</strong>
<div class="d-flex flex-wrap flex-lg-nowrap mt-4 gap-2">
<div class="d-flex align-items-center">
<?php
if($user_details1==3)
{
?>
<div><img id="userimage" src="{{asset('/public/front')}}/img/{{$buyer_details->image}}" class="img-fluid mx-auto d-block rounded-circle" style="max-width: 62px;" alt=""></div>
<?php
}
else
{
?>
<div><img id="userimage" src="{{asset('/public/front')}}/img/{{$seller_details->image}}" class="img-fluid mx-auto d-block rounded-circle" style="max-width: 62px;" alt=""></div>
<?php
}
?>

<form method="post" action="{{url('update-userimage')}}" id="imageform" enctype="multipart/form-data">
{{ csrf_field() }}
<?php
if($user_details1==3)
{
?>
<div class="text-black cursor-pointer">
<input type="hidden" name="img_buyer_id" value="{{$buyer_details->id}}">
<input type='file' id="uploaduser" onchange="uploadImage({{$buyer_details->id}})" name="image"/><i data-feather="paperclip"></i></div>
<?php
}
else
{
?>
<div class="text-black cursor-pointer">
<input type="hidden" name="img_seller_id" value="{{$seller_details->id}}">
<input type='file' id="uploaduser" onchange="uploadImage({{$seller_details->id}})" name="image"/><i data-feather="paperclip"></i></div>
<?php
}
?>
</form>
</div>
<div class="ft-12 lh-18">
<span class="d-block mb-3">Choose Square Image</span>JPG, JPEG, PNG. Max size of 500K
</div>
</div>

</div>
<div class="text-center my-5">
<a href="{{url('/userlogout')}}" class="border-bottom text-grey ft-20 ft-medium">Log-out</a>
</div>
</div>

</div>
<div class="col-lg-6 col-xl-8">
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<h3 class="ft-medium ft-25 lh-36  mt-5">General Information</h3>
<div class="add_address_form">

<div class="py-5">
<div class="payments_details_form">
<form onsubmit="onSubmit()" method="post" action="{{url('update-userdetails')}}">

{{ csrf_field() }}
<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Full Name</label>

<input type="text" class="form-control shadow-sm ft-20 ft-medium" value="{{$user_details->name}}" name="fullname">
<?php
if($user_details1==3)
{
?>
<input type="hidden" name="buyer_id" value="{{$buyer_details->id}}">
<?php
}
else
{
?>
<input type="hidden" name="seller_id" value="{{$seller_details->id}}">
<?php
}
?>
<input type="hidden" name="user_id" value="{{$user_details->id}}">
</div>
<div class="row">
<?php
if($user_details1==3)
{
?>
<div class="col-md-6">
<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Date of Birth</label>
<input class="form-control shadow-sm ft-medium" type="date" value="{{$buyer_details->dob}}" id="datefield" name="dob">
</div>
</div>
<?php
}
?>
<?php
if($user_details1==3)
{
?>
<div class="col-md-6">
<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Gender</label>
<select name="gender" class="form-control" id="">
<option value="">Choose</option>
<option @php echo($buyer_details->gender == 'Male')? "selected":"" @endphp value="Male">Male</option>
<option @php echo($buyer_details->gender == 'Female')? "selected":"" @endphp value="Female">Female</option>
<option @php echo($buyer_details->gender == 'Other')? "selected":"" @endphp value="Other">Other</option>
</select>
</div>
</div>
<?php
}
?>
</div>
<div class="row">
<div class="col-md-6">
<?php
if($user_details1==3)
{
?>
<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Phone</label>
<input class="form-control shadow-sm ft-medium" type="text" value="{{$buyer_details->phone}}" name="phone">
</div>
<?php
}
else
{
?>
<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Phone</label>
<input class="form-control shadow-sm ft-medium" type="text" value="{{$seller_details->phone}}" name="phone">
</div>
<?php
}
?>
</div>

<div class="col-md-6">
<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Email</label>
<input class="form-control shadow-sm  ft-medium" type="text" value="{{$user_details->email}}" name="email" disabled>
</div>
</div>
</div>
<button type="submit" class="btn_submit btn btn-primary  mt-4 py-4 px-5 w-xl-25 ft-medium ft-12">Save & Update</button>


</form>
</div>
</div>
</div>


<h3 class="ft-medium ft-25 lh-36  mt-5 check_green_left">Primary Address <small class="ft-12">(Selected)</small></h3>
<div class="add_address_form">

<div class="py-5">
<div class="payments_details_form">
<form onsubmit="onSubmit()"method="post" action="{{url('update-user-primaryaddress')}}">

{{ csrf_field() }}


<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">Full Address</label>
<input type="hidden" name="user_id" value="{{$user_details->id}}">
<input type="text" class="form-control shadow-sm ft-20 ft-medium" value="{{$full_address}}" name="full_address">
</div>
<div class="row">
<div class="col-md-6">

<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">COUNTRY</label>

<input class="form-control shadow-sm ft-medium" type="text" value="{{$country}}" name="country">
</div>

</div>
<div class="col-md-6">


<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">POST CODE</label>
<input class="form-control shadow-sm ft-medium" type="text" value="{{$pincode}}" name="pincode">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">

<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">CITY</label>

<input class="form-control shadow-sm ft-medium" type="text" value="{{$city}}" name="city">
</div>

</div>
<div class="col-md-6">


<div class="mb-4 pb-3">
<label for="" class="d-block ft-10 text-grey ft-medium">STATE</label>

<input class="form-control shadow-sm  ft-medium" type="text" value="{{$state}}" name="state">
</div>
</div>
<div class="col-md-6 mb-5">
<a href="{{url('editaddress')}}/{{$primary_add_id}}" class="text-grey">Add new Address +</a>
</div>
</div>
<button type="submit" class="btn_submit btn btn-primary  mt-4 py-4 px-5 w-xl-25 ft-medium ft-12">Save & Update</button>


</form>
</div>
</div>
</div>

<!--<div class="accordion checkout_accordion" id="">-->
<!--    <div class="accordion-item border-0 bg-transparent py-5">-->
<!--        <h2 class="accordion-header" id="">-->
<!--            <button class="w-100 bg-transparent border-0 text-start ft-25 ft-medium text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">-->
<!--                <i class="fas fa-chevron-down"></i>   Payments-->
<!--        </button>-->
<!--        </h2>-->
<!--        <div id="collapseOne" class="accordion-collapse collapse my-5" aria-labelledby="">-->
<!--            <div class="accordion-body">-->
<!--                <div class="table-responsive">-->
<!--                    <table class="table table-borderless w-xl-75">-->
<!--                        <tbody>-->
<!--                            <tr>-->
<!--                                <td></td>-->
<!--                                <td class="text-black">Set as Primary</td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td class="align-middle" style="width: 50px;"><input type="radio" name="primarycard" class="w-radio"></td>-->
<!--                                <td>-->
<!--                                    <div class="shadow-sm bg-white p-3 d-flex gap-5 align-items-center w-auto">-->
<!--                                        <div><img src="img/ae.jpg" alt=""></div>-->
<!--                                        <span>American Express A/c XX2589</span>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td class="align-middle" style="width: 50px;"><input type="radio" name="primarycard" class="w-radio"></td>-->
<!--                                <td>-->
<!--                                    <div class="shadow-sm bg-white p-3 d-flex gap-5 align-items-center w-auto">-->
<!--                                        <div><img src="img/bar.jpg" alt=""></div>-->
<!--                                        <span>Barclays Bank A/c XX5688</span>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--                <div class="button_h d-flex mt-4">-->
<!--                    <a href="#" class="btn btn-outline-success border-success px-5 shadow  mt-4 ft-medium ft-12 py-1 text-black " id="">Add a New Card     +</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!--</div>-->

<div class="accordion checkout_accordion" id="walletAccord">
<div class="accordion-item border-0 bg-transparent py-5">
<h2 class="accordion-header" id="">
<button class="w-100 bg-transparent border-0 text-start ft-25 ft-medium text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapsewallet" aria-expanded="false" aria-controls="collapsewallet">
<i class="fas fa-chevron-down"></i>   Wallet
</button>
</h2>
<div id="collapsewallet" class="accordion-collapse collapse my-5" aria-labelledby="">
<div class="accordion-body">
<div class="d-flex gap-4 align-items-center">
<div><img src="img/wallet.png" alt=""></div>
<span class="ft-25 ft-500">Current Balance</span>
<b class="text-green ft-25 ms-4 d-block">£{{$user_details->wallet}}</b>
</div>
<div class="add_money_form my-5">
<form onsubmit="onSubmit" action="{{url('addmoney')}}" id="addmoney" name="addmoney">
@csrf
<input type="hidden" name="user_id" id="user_id" value="{{$user_details->id}}">
<label for="" class="d-block ft-20 ft-500">Add Money to Wallet</label>
<div class="input-group mb-3 d-flex w-lg-50 shadow mt-4">
<span class="input-group-text ft-30 bg-white px-4">£</span>
<input type="text" id="amount" name="amount" class="form-control ft-30 h-100" aria-label="Amount (to the nearest dollar)" placeholder="Amount" required="">
</div>
<div class="w-lg-50 d-flex justify-content-center align-items-center gap-4 mt-4 append_walletamount">
<a href="javascript:void(0)" data-value="50" class="bg-white border py-0 px-4 ft-12 text-black ft-medium">+50</a>
<a href="javascript:void(0)" data-value="100" class="bg-white border py-0 px-4 ft-12 text-black ft-medium">+100</a>
<a href="javascript:void(0)" data-value="150" class="bg-white border py-0 px-4 ft-12 text-black ft-medium">+150</a>
<a href="javascript:void(0)" data-value="200" class="bg-white border py-0 px-4 ft-12 text-black ft-medium">+200</a>
</div>
<div class="mt-5">
<input type="radio" id="payment_method" name="payment_method" value="Paypal" required=""> <b>Paypal</b>&nbsp;&nbsp;&nbsp;
<input type="radio" id="payment_method" name="payment_method" value="Stripe"> <b>Stripe</b><br>
<button type="submit" class="btn_submit btn btn-primary  mt-5 py-4 px-5 w-lg-25 ft-medium ft-12">Proceed</button>
</div>
</form>
</div>

</div>
</div>
</div>

</div>


<div class="accordion checkout_accordion" id="">
<div class="accordion-item border-0 bg-transparent py-5">
<h2 class="accordion-header" id="">
<button class="w-100 bg-transparent border-0 text-start ft-25 ft-medium text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCoupons" aria-expanded="false" aria-controls="collapseCoupons">
<i class="fas fa-chevron-down"></i>   My Coupons
</button>
</h2>
<div id="collapseCoupons" class="accordion-collapse collapse my-5" aria-labelledby="">
<div class="accordion-body">
<div class="card bg-white shadow-sm p-5 rounded coupon_box2">
<div class="row">
<div class="col-xl-12 mx-auto">
<div class="row gx-lg-5">

<!--Fetch Coupons-->
@php                                            
$coupons = Coupon::getCoupons();  

foreach($coupons as $coupon){
@endphp                                           

<div class="col-lg-3 col-md-6">
<div class="shadow p-4  text-center">
<img src="{{asset('/public/coupons')}}/{{$coupon->image}}" class="img-fluid rounded-circle" alt="">
<span class="ft-8 lh-12 d-block mt-3">Get {{$coupon->percent}}% off </span>
<strong class="ft-12 lh-18 ft-medium">{{$coupon->name}}</strong>
<a href="javascript:void(0)" data-coupon="{{$coupon->code}}" class="btn btn-primary py-0 ft-10 d-block mt-2">Copy Code</a>
</div>
</div>
@php   
}
@endphp                                                            
</div>
</div>
</div>

<div class="button_h d-flex  justify-content-center">
<a href="{{url('coupon/')}}" class="btn btn-light border-secondary px-2 shadow  ft-medium ft-12 py-1 " id="">View All</a>
</div>

</div>

</div>
</div>
</div>

</div>


<div class="accordion checkout_accordion" id="">
<div class="accordion-item border-0 bg-transparent py-5">
<h2 class="accordion-header" id="">
<button class="w-100 bg-transparent border-0 text-start ft-25 ft-medium text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWishlist" aria-expanded="false" aria-controls="collapseWishlist">
<i class="fas fa-chevron-down"></i>  My Wishlist
</button>
</h2>
<div id="collapseWishlist" class="accordion-collapse collapse  my-5" aria-labelledby="">
<div class="accordion-body">
<div class="card bg-white shadow-sm p-5 rounded">

<!--Fetch Whislist Product-->
<div class="checkout_product_list table-mobile ">
<table class="table table-borderless align-middle">
<tbody>
@php                                            
$wishlist = Wishlist::getWishlistProducts($user_details->id);  
foreach($wishlist as $product){
@endphp                               
<tr>
<td style="width: 75px;">
<div class="checkout_prod_img me-4"><a href="{{url('/product-detail/')}}/{{$product->slug}}">
<img src="{{asset('/public/products')}}/{{$product->image}}" class="shadow" width="64px" alt=""></a>
</div>
</td>
<td style="width:50%;">
<div class="checkout_prod_desc pt-2"><a class="text-black" href="{{url('/product-detail/')}}/{{$product->slug}}">
<p class="ft-12 lh-18 ft-medium mb-0">{{$product->name}}</p></a>
<!--<small class="ft-10">SIZE: <span class="text-grey">10-</span>(UK) COLOR: <span class="text-grey">BLACK</span></small>-->
</div>
</td>

<td class="text-center">
<div class="checkout_price ft-15 lh-22 ft-medium">
<span data-price="200"> GBP {{$product->price}}</span>
</div>
</td>
<td>
<a href="{{url('/remove-product-from-wishlist')}}/{{$product->id}}" class="text-grey"><i class="fas fa-trash"></i></a>
</td>
</tr>
<tr  style="height:30px">
	<td>&nbsp;</td>
</tr>
@php
}
@endphp

</tbody>    
</table>
</div>

<div class="button_h d-flex justify-content-center">
<a href="{{url('/wishlist')}}" class="btn btn-light border-secondary px-2 shadow  ft-medium ft-12 py-1 " id="addcoupon">View All</a>
</div>

</div>

</div>
</div>
</div>

</div>








</div>

</div>
<div class="text-center">
<div class="w-lg-75 mx-auto my-5">
<button type="submit" class="btn btn-primary px-5 mt-4 ft-medium w-lg-50">Save & Update</button>
</div>
</div>
</div>

</div>
</div>
<div class="h-50px"></div>
</div>
<!-- content area End -->
<script>
function onSubmit() {
$('.btn_submit').attr('disabled', true);
}


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

$(document).ready(function() {
    var url = window.location.href;
    var hash = url.substring(url.indexOf('#'));
    if(hash=='#walletAccord'){
        $(hash).find('[data-bs-toggle="collapse"]').trigger('click');
    }
    $('.delete_btn').click(function() {
        var id = $(this).attr('id');
        if (confirm('Are you sure want to delete ?')) {
            document.location.href = '{{url("/deleteimage")}}' + '/' + id;
        } else {
            return false;
        }
    });
});

</script>
@include('front.include.footer')
@yield('footer')