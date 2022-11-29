@include('front.include.header')
@yield('header')
<!-- content area start -->
<?php
if(Auth::check())
{
$user_id = auth()->user()->id;
$user=DB::table('users')->where('id',$user_id)->first();
$wallet_amount = $user->wallet;
}
$cartdata=DB::table('cart')->where(array('user_id'=>$user_id,'status'=>1,'movetocheckout'=>1))->get();
$cartcount = count($cartdata);
$addressdata = DB::table('addresses')->where(array('user_id'=>$user_id,'is_main_address'=>1))->first();
if($addressdata=='')
{
$currentURL = URL::to('/update-profile');
echo "<script>alert('Please update your profile before going to cart!')</script>";
echo "<script>window.location.href='".$currentURL."'</script>";
exit;
}
elseif($cartcount=='0')
{
$currentURL = URL::to('/cart');
echo "<script>alert('Please select cart value!')</script>";
echo "<script>window.location.href='".$currentURL."'</script>";
exit;
}
if($cartcount>0)
{
    
    $totDelCharge=0;
    foreach ($cart as $cartvalue) 
    {
        $product_id = $cartvalue->product_id;
        $products = DB::table('products')->where('id',$product_id)->first();
        $postCodeData = DB::table('postal_code')->select('cost')->where(array('seller_id'=>$products->user_id,'zipcode'=>$addressdata->pincode))->first();
        if(empty($postCodeData))
        {
            $cost = 0;
        }
        else
        {
            $cost = $postCodeData->cost;
        }
        $totDelCharge = $totDelCharge + $cost;
    }
?>
<div class="seller_login_banner pt-5">
    <div class="container px-lg-5">
        <div class="shadow-set bg-white p-5 mt-5">
            <nav class="text-center py-5">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">BACK TO SHOP</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/cart')}}">CART</a></li>
                    <li class="breadcrumb-item active" aria-current="page">CHECKOUT</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">CONFIRMATION</a></li>
                </ol>
            </nav>
            <h3 class="ft-medium ft-25 lh-36 px-lg-5">Checkout</h3>
            <div class="px-lg-5">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="shipping_details">
                            <h4 class="ft-medium ft-12 lh-18 text-grey pt-5 pb-4  border-bottom border-3 mb-0">SHIPPING
                                DETAILS</h4>
                            <div class="py-5">
                                <div class="row  ft-12 ft-medium">
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between align-items-end">
                                            <span>{{$user->name}}</span>
                                            <a href="{{url('editaddress')}}/{{@$addressdata->id}}"
                                                class="edit_shipping_address shadow text-grey">Edit </a>
                                        </div>
                                        <address class="m-0">
                                            {{$addressdata->address}}<br>{{$addressdata->city}}<br>{{$addressdata->state}}
                                            <br>{{$addressdata->country}} <br>{{$addressdata->pincode}}
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-end">{{$user->email}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="payments_details">
                            <h4 class="ft-medium ft-12 lh-18 text-grey pt-5  border-bottom border-3">PAYMENTS DETAILS
                            </h4>
                            <div class="py-5">
                                <div class="payments_details_form">
                                    <form onsubmit="onSubmit()" name="paynow" id="paynow" method="post" action="{{url('paynow')}}">
                                        @csrf
                                        <?php
                                        $cartdata=DB::table('cart')->where(array('user_id'=>$user_id,'status'=>1,'movetocheckout'=>1))->get();
                                        foreach ($cartdata as $cartresult) 
                                        {
                                        ?>
                                        <input type="hidden" name="cartid[]" id="cartid" value="{{$cartresult->id}}">
                                        <?php
                                        }
                                        ?>
                                        <input type="hidden" name="cashback_amt" id="cashback_amt" value="{{number_format( $cartdata->sum('cashback'),2) }}">
                                        <input type="hidden" name="amount" id="amount"
                                            value="{{number_format(($cartdata->sum('totalamount')+$totDelCharge),2) }}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                        <input type="hidden" name="discountprice" id="discountprice" value="{{$cartdata->sum('discount_amount')}}">
                                        <input type="hidden" value="{{number_format($totDelCharge,2)}}" name="totDelCharge" id="totDelCharge">
                                        <input type="hidden" name="walletamounthidden" id="walletamounthidden" value="{{$wallet_amount}}">
                                        <?php
                                        $cart_total = $cartdata->sum('totalamount');
                                        $delivery_charges = $totDelCharge;
                                        $sub_total = $cart_total + $delivery_charges;
                                        if($sub_total>$wallet_amount)
                                        {
                                            $afterwallet = $sub_total - $wallet_amount;
                                        }
                                        else
                                        {
                                            $afterwallet = 0;
                                        }
                                        //if($wallet_amount>$sub_total){echo "Plus";}else{ echo "Minus"; }
                                        ?>
                                        <div class="wallet_money_opt d-flex flex-wrap align-items-center gap-3">
                                        <div class="d-flex  gap-3">
                                        <div>
                                        
                                        <input type="checkbox" value='{{$wallet_amount}}' name="wallet_amount" id="myCheck" onclick="mywalletamount()">
                                        <p id="addmoneywallet" style="display:none">{{$afterwallet}}</p>
                                        </div>
                                        <span class="ft-medium">Use Wallet money </span>
                                        <span
                                        class="text-green available_balance">(Available £{{$wallet_amount}})
                                        </span>
                                        </div>
                                        <div>
                                        </div>
                                        </div><hr>


                                        <div class="wallet_money_opt d-flex flex-wrap align-items-center gap-3">
                                        <div class="d-flex  gap-3">
                                        <div>
                                        <!-- <input type="radio" name="option 1" value="A" />Value A
                                        <input type="radio" name="option 1" value="B" />Value B -->
                                        <!--<input type="checkbox" value="{{number_format(($sub_total),2) }}" name="paypal_amount" id="paypal_amount">-->
                                        <input type="radio" value="Paypal" name="paypal_amount">
                                        <p id="addmoneywallet" style="display:none">{{$afterwallet}}</p>
                                        </div>
                                        <span class="ft-medium">Use PayPal</span>
                                        </div>
                                        <div>
                                        </div>
                                        </div>

                                        <div class="wallet_money_opt d-flex flex-wrap align-items-center gap-3">
                                        <div class="d-flex  gap-3">
                                        <div>
                                        <input type="radio" value="Stripe" name="paypal_amount">
                                        <!-- <input type="radio" value="{{number_format(($sub_total),2) }}" name="stripe_amount" id="stripe_amount"> -->
                                        <p id="addmoneywallet" style="display:none">{{$afterwallet}}</p>
                                        </div>
                                        <span class="ft-medium">Use Stripe</span>
                                        </div>
                                        <div>
                                        </div>
                                        </div>
                                        <input type="hidden" name="pay" id="pay" value="pay">
                                        <button type="submit" id="payone" value="pay" name="pay" class="btn_submit btn btn-primary w-100 mt-4 py-4 ft-medium moneywalletbtn">You Only
                                            Pay £
                                            <span class="checkout_total_price">
                                                <price data-price="{{number_format(($sub_total),2) }}">
                                                    {{number_format(($sub_total),2) }}
                                                </price>
                                            </span>
                                        </button>

                                        <div class="mb-3 mt-5 text-center">
                                            <a href="#" class="form-check-label text-secondary ft-12"><img
                                                    src="{{ asset('public/front/img/safeicon.png') }}" alt=""
                                                    class="me-3 d-inline-block" /> Safe and Secure Payments. 100%
                                                Authentic Products</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 d-none d-xl-flex">&nbsp;</div>
                    <div class="col-lg-6 col-xl-5">
                        <h4 class="ft-medium ft-12 lh-18 text-grey pt-5 pb-4  border-bottom border-3 mb-0">YOUR ORDER
                        </h4>
                        <?php
                        if(!empty($cart))
                        {
                        foreach ($cart as $cartvalue) 
                        {
                        $product_id = $cartvalue->product_id;
                        $discount_amount = $cartvalue->discount_amount;
                        $discount_percent = $cartvalue->discount_percent;
                        $variant_id = $cartvalue->variant_id;
                        $productdetail = DB::table('product_detail')->where(array('product_id'=>$product_id,'id'=>$variant_id))->first();
                        $un = unserialize($productdetail->spec_detail);
                        //echo "<pre>";
                        //print_r($un);
                        $products = DB::table('products')->where('id',$product_id)->first();
                        $specificationdata=DB::table('specifications')->where('cat_id',$products->catid)->get();
                       
                        /*foreach ($specificationdata as $specificationdatavalue) {
                        $spec_slug = $specificationdatavalue->slug;
                        echo $spec_res = $un[$spec_slug]; 
                        }
                        if($un['colors']!='')
                        {
                        $spec_res = $un['colors'];
                        }*/
                        $variantimage = DB::table('additional')->where(array('product_id'=>$product_id,'option_id'=>$variant_id))->first();
                        $spec_detail = $cartvalue->spec_detail;
                        $unserializespecdetail = unserialize($spec_detail);
                        //echo "<pre>";
                        //print_r($unserializespecdetail);
                        $quantity = $cartvalue->quantity;
                        $price = $cartvalue->sellprice;
                        $discount_code_id = $cartvalue->discount_code_id;
                        if($discount_code_id!='')
                        {
                        $coupon = DB::table('coupons')->where(array('id'=>$discount_code_id))->first();
                        $coupon_code = $coupon->code;
                        }
                        $totalamount = $cartvalue->totalamount;
                        ?>
                        <div class="checkout_product_list">
                            <div class="row py-5  border-bottom border-3">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex flex-wrap">
                                        <div class="checkout_prod_img me-4">
                                            <img src="{{ asset('public/product_image/'.$variantimage->product_image) }}"
                                                class="shadow" width="64px" alt="">
                                        </div>
                                        <div class="checkout_prod_desc pt-2">
                                            <p class="ft-12 lh-18 ft-medium mb-0"><a href="{{url('product-detail/'.$products->slug)}}">{{$products->name}}</a></p>
                                            <?php
                                            foreach ($un as $key=>$newun) {
                                            if($key!='vprice' && $key!='variant_id')
                                            {
                                            ?>
                                            <small class="ft-10">{{ucfirst($key)}}: <span
                                                    class="text-grey">{{ucfirst($newun)}}</span></small>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4 mt-md-0 mt-lg-4 mt-xl-0  col-lg-12 col-xl-6">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <div class="checkout_qty d-flex align-items-center gap-2">
                                            <button class="qtyminus btn" aria-hidden="true ">&minus;</button>
                                            <input type="text" name="qty" class="qty quantity" min="1" max="10" step="1"
                                                value="{{$quantity}}" class="btn border text-center">
                                            <button class="qtyplus btn" aria-hidden="true">&plus;</button>
                                        </div>
                                        <div class="checkout_price ft-15 lh-22 ft-medium">
                                           
                                               
                                                <?php if($discount_amount>0)
                                                {
                                                    $newtotalamount = $totalamount + $discount_amount;
                                                ?>
                                                 <strike class="sprice" data-price="{{number_format($newtotalamount,2)}}"> GBP
                                                {{number_format($newtotalamount,2)}}</strike><br>
                                                <span class="text-success text-end d-block">GBP {{number_format($totalamount,2)}}</span>
                                                <?php
                                                } else {
                                                ?>
                                        <span class="sprice" data-price="{{number_format($totalamount,2)}}"> GBP
                                                {{number_format($totalamount,2)}}</span>
                                            <?php } ?>
                                        </div>
                                        <!-- <div class="checkout_discount d-flex justify-content-between ft-15 lh-22 ft-medium py-3 text-green"
                                        >
                                        <span>Discount</span>
                                        <span class="checkout_shipping_price">GBP <price>0.00</price></span>
                                        </div> -->
                                    </div>
                                </div>
                                <tr>
                                <td></td>
                                <td></td>
                                <td>
                                <?php
                                $discountcode="";
                                if($discount_percent=="")
                                {
                                ?>
                                <div class="button_h d-flex justify-content-center">
                                <button type="button"
                                class="addcoupon btn btn-default border-secondary px-5 shadow rounded-0 mt-4 ft-medium ft-12"
                                id="addcoupon{{$cartvalue->id}}" data-id="{{$cartvalue->id}}">ADD COUPON +</button>
                                </div>
                                <div class="button_h enter_coupon mt-3">
                                <label for="" class="d-block ft-12">Enter Coupon Code</label>
                                <div class="d-flex align-items-center position-relative">
                                <input type="text"
                                class="form-control border-0 border-bottom border-secondary rounded-0"
                                name="discountcode" id="discountcode" value="<?php echo $discountcode;?>">
                                <input type="hidden" name="discount" value="Discount">
                                </div>
                                <div class="text-center">
                                <button type="submit"
                                class="submitcode btn btn-default border-secondary px-5 shadow rounded-0 mt-4 ft-medium ft-12 w-75"
                                id="submitcoupon{{$cartvalue->id}}" data-id="{{$cartvalue->id}}"> SUBMIT </button><br>
                                </div>
                                </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                <div class="d-flex gap-3 mb-2 align-items-center w-lg-50">
                                <input type="text"
                                class="form-control border-0 border-bottom border-secondary rounded-0"
                                name="discountcode" id="discountcode" value="<?php echo $coupon_code;?>"
                                <?php if($coupon_code!="") { ?> disabled="disabled" <?php } ?> autocomplete="off"><a href="javascript:void(0)" class="fa fa-trash-o" onclick="removecartdiscount({{$cartvalue->id}},this);">x</a>
                                <input type="hidden" name="discount" value="Discount">
                                </div>
                                <?php
                                }
                                ?>
                                </td>
                                </tr>
                                <div class="col-12 text-end ft-12">
                                    <a href="#" onclick="updatecartitem({{$cartvalue->id}},this);"
                                        class="text-danger">Update</a> |
                                    <a href="#" onclick="removecartitem({{$cartvalue->id}});"
                                        class="text-danger">Remove</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        }
                        ?>
                        <div id="last_ch_price">
                            <div
                                class="checkout_subtotal d-flex justify-content-between ft-15 lh-22 ft-medium py-3 mt-2">
                                <span>Sub Total</span>
                                <span class="checkout_subtotal_price">GBP <price>
                                        {{number_format( $cartdata->sum('totalamount'),2) }}</price></span>
                            </div>
                            <!-- <div class="checkout_discount d-flex justify-content-between ft-15 lh-22 ft-medium py-3 text-green"
                                style="display:none !important">
                                <span>Discount</span>
                                <span class="checkout_shipping_price">-GBP <price>0.00</price></span>
                            </div> -->
                            <div class="checkout_subtotal d-flex justify-content-between ft-15 lh-22 ft-medium py-3">
                                <span>Shipping</span>
                                <span class="checkout_shipping_price">+GBP <price>0.00</price></span>
                            </div>
                            <div
                                class="checkout_subtotal d-flex justify-content-between ft-15 lh-22 ft-medium py-3 text-green">
                                <span>Cashback</span>
                                <span class="checkout_cashback_price">GBP <price>{{number_format( $cartdata->sum('cashback'),2) }}</price></span>
                            </div>
                            <div
                                class="checkout_subtotal d-flex justify-content-between ft-15 lh-22 ft-medium py-3 text-green">
                                <span>Delivery Charge</span>
                                <span class="checkout_cashback_price">+GBP <price><?php echo $totDelCharge; ?></price>
                                </span>
                            </div>
                            <div class="checkout_subtotal d-flex justify-content-between ft-15 lh-22 ft-medium py-3 ">
                                <span>Total</span>
                                <span class="checkout_total_price">GBP <price>
                                        {{number_format( ($cartdata->sum('totalamount')+$totDelCharge),2) }}</price>
                                </span>
                            </div>
                        </div>
                        <div class="text-center ft-10 border-bottom border-3 py-4 ft-medium">
                            Your Shipment will reach you via DPD courier partner service.
                        </div>
                        <div class="text-center ft-10  py-4 ft-medium">
                            Note: <span class="text-grey">You will recieve the cashback in your wallet account once the
                                return period is over.</span>
                        </div>
                        <!-- <div class="button_h d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-default border-secondary px-5 shadow rounded-0 mt-4 ft-medium ft-12"
                                id="addcoupon">ADD COUPON +</button>
                        </div> -->
                        <?php
                        $discountcode='';
                        ?>
                        <!-- <div class="button_h enter_coupon mt-3">
                            <label for="" class="d-block ft-12">Enter Coupon Code</label>
                            <div class="d-flex align-items-center position-relative">
                                <input type="text"
                                    class="form-control border-0 border-bottom border-secondary rounded-0"
                                    name="discountcode" id="discountcode" value="<?php //echo $discountcode;?>"
                                    <?php if($discountcode!="") { ?> disabled="disabled" <?php } ?> autocomplete="off">
                                <input type="hidden" name="discount" value="Discount">
                                <i data-feather="check" class="text-green activated_coupon"></i>
                                <i data-feather="x" class="text-danger invalid_coupon"></i>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-default border-secondary px-5 shadow rounded-0 mt-4 ft-medium ft-12 w-75"
                                    id="submitcoupon"> SUBMIT </button><br>
                                <span class="text-green activated_coupon ft-10 lh-18">Coupon Code Activated !!</span>
                                <span class="text-danger invalid_coupon ft-10 lh-18">Invalid Coupon !!</span>
                            </div>
                        </div> -->
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
var saveOldamount = '';   
function mywalletamount() {
   saveOldamount = $('.moneywalletbtn price').attr('data-price');
   //alert(saveOldamount);
  var checkBox = document.getElementById("myCheck");
  var addmoneywallet = $("#addmoneywallet").text();
  if (checkBox.checked == true){
    $('.moneywalletbtn price').text(addmoneywallet); 
    if(addmoneywallet==0){
      $('[name="paypal_amount"]:checked').prop('checked',false);
        $('[name="paypal_amount"]').prop('disabled',true);
    }
   
  } else {
     $('.moneywalletbtn price').text(saveOldamount); 
        $('[name="paypal_amount"]').prop('disabled',false);
    
  }
}

$(function() {
$('.submitcode').click(function() {
var discountcode = $(this).parents('.enter_coupon').find('input[type="text"]').val();
var cart_id = $(this).data("id");
//alert(cart_id);
$.ajax({
type: "post",
url: "{{url('/cart/discountcart')}}",
data: {
"discountcode": discountcode,"cart_id": cart_id,
_token: '{{csrf_token()}}'
},
success: function(data) {
//alert(data);
var dataprice = data.toString().split('-');
var discountprice = dataprice[0];
document.getElementById("discountprice").value=(discountprice);
var totDelCharge = '<?php echo $totDelCharge?>';
document.getElementById("totDelCharge").value=(totDelCharge);
var getwalletAmount = parseFloat($('#walletamounthidden').val());
//alert(totDelCharge);
var totalamountafterdiscount = parseFloat(dataprice[1]) + parseFloat(totDelCharge);
var calcamount = parseFloat(totalamountafterdiscount-getwalletAmount);
if(calcamount<=0){
calcamount = 0;
}
$(".checkout_discount").removeAttr('style');
$(".checkout_discount price").text(discountprice);
//$(".checkout_total_price price").text(totalamountafterdiscount);
$(".checkout_total_price price").attr('data-price',totalamountafterdiscount);
$('#addmoneywallet').text(calcamount);
//alert(calcamount);
var checkBox = document.getElementById("myCheck");
var addmoneywallet = $("#addmoneywallet").text();
if (checkBox.checked == true)
{
$('.moneywalletbtn price').text(calcamount);
}
if(data!="Invalid Coupon")
{
alert("Coupon Applied");
window.location.reload();
}
else{
    alert("Invalid Coupon");
}

}
})
/*if (discountcode) {
$(this).parents('.enter_coupon').find('.activated_coupon').show();
$(this).parents('.enter_coupon').find('.invalid_coupon').hide();
} else {
$(this).parents('.enter_coupon').find('.invalid_coupon').show();
$(this).parents('.enter_coupon').find('.activated_coupon').hide();
}*/
});
    /*$('#addcoupon').click(function() {
        $(this).hide();
        $('.enter_coupon').show();
    });*/

    $('.addcoupon').click(function() {
        //var product_id = $(this).data("id");
        //alert(product_id);
        $(this).hide();
        $(this).parents('.checkout_product_list').find('.enter_coupon').show();
        //var product_id = $(this).data("id");
        //alert(product_id);
    });


    $('#payone').click(function() {
        var payment_method = $('[name="paypal_amount"]:checked').val(); 
        var getcheckchecked = $('#myCheck');
        var getprice = parseInt($('#addmoneywallet').text()); 
        //alert(getprice);
        if(!$('#myCheck').is(':checked'))
        {
            if(!payment_method)
                {
                    alert("Please select any one payment method.");
                    return false;
                }
        }
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
});
</script>
<script>
const removecartitem = (id) =>
    {
        if (confirm('Are you sure want to remove item?'))
        {
            document.location.href = '{{url("checkout/removeitem")}}/' + id;
            window.reload();
        } else
        {
            return false;
        }
    }
<?php
if(Auth::check())
{
    $user_id = auth()->user()->id;
} 
else
{
    $user_id = "";
}
?>
function updatecartitem(id, ele, quantity)
{
    var cart_id = id;
    var user_id = '{{$user_id}}';
    var quantity = $(ele).parent().parent().find('.quantity').val();
    $.ajax({
        type: "post",
        url: "{{url('/checkout/updateitem')}}",
        data: {
            "id": cart_id,
            _token: '{{csrf_token()}}',
            "quantity": quantity,
            "user_id": user_id
        },
        success: function(data) {
            window.location.href = '{{url("/checkout")}}';
        }
    })
}
function removecartdiscount(id,ele,qunatity)
{
    var cart_id = id;
    var user_id = '{{$user_id}}';
    var quantity = $(ele).parent().parent().find('.quantity').val();
    $.ajax({
        type: "post",
        url: "{{url('/checkout/removediscount')}}",
        data: {
            "id": cart_id,
            _token: '{{csrf_token()}}',
            "quantity": quantity,
            "user_id": user_id
        },
        success: function(data) {
            window.location.href = '{{url("/checkout")}}';
        }
    })
}
</script>
<?php
}
else
{
?>
<div class="container">
    <div class="row">
        <div class="alert alert-danger" style="color:red;text-align:center; margin-top:25px;"><strong>Cart is empty <br> 
        <a
        href="{{url('/')}}" style="text-decoration: underline;color:#842029;">Continue Shopping</a></strong></div>
    </div>
</div>
<?php 
}
?>
@include('front.include.footer')
@yield('footer')