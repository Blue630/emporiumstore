@include('front.include.header')
@yield('header')
<!-- content area start -->
<?php
if(Auth::check())
{
$user_id = auth()->user()->id;
$user=DB::table('users')->where('id',$user_id)->first();
}
$cartdata=DB::table('cart')->where(array('user_id'=>$user_id,'status'=>1))->get();
$cartcount = count($cartdata);
$addressdata = DB::table('addresses')->where(array('user_id'=>$user_id,'is_main_address'=>1))->first();
if(!empty($addressdata))
{
    $pincode = $addressdata->pincode;
}
else
{
$currentURL = URL::to('/update-profile');
echo "<script>alert('Please update your profile before going to cart!')</script>";
echo "<script>window.location.href='".$currentURL."'</script>";
exit;
}
if($cartcount>0)
{
?>
<!-- content area start -->
<div class="seller_login_banner2 pt-5">
    <div class="container px-lg-5">
        <div class="shadow-set bg-white-trans p-5 mt-5">
            <div class="">
                <a href="{{url('/')}}" class="text-grey"><i data-feather="arrow-left-circle" class="text-black"></i>
                    <span class="ft-10">BACK</span></a>
            </div>
            <form method="post" action="{{url('checkout')}}" enctype="multipart/form-data" onsubmit="onSubmit()">
                @csrf
                <div class="px-lg-5">
                    <div class="row">
                        <div class="col-lg-6 col-xl-5 pt-lg-5   ps-lg-65">
                            <h3 class="ft-medium ft-25 lh-36  mt-5 border-bottom border-3 pb-3">My Cart</h3>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-lg-8 col-xl-7">
                            <div class="cart_page_form">
                                <div class="py-5">
                                    <?php
                                    if(!empty($cart))
                                    {
                                    $totDelCharge = 0;
                                    foreach ($cart as $key=>$cartvalue) 
                                    {
                                    // if($key==2)
                                    // {
                                    $cartid = $cartvalue->id;
                                    $product_id = $cartvalue->product_id;
                                    if($cartvalue->variant_id!='')
                                    {
                                        $variant_id = $cartvalue->variant_id;
                                    }
                                    else{
                                        $variant_id = '';
                                    }
                                    //\DB::enableQueryLog(); // Enable query log
                                    $productdetail = DB::table('product_detail')->where(array('product_id'=>$product_id,'id'=>$variant_id))->first();
                                    if($productdetail)
                                    {
                                        $un = unserialize($productdetail->spec_detail);
                                    }
                                    else{
                                        DB::table('cart')->WhereRaw('id='.$cartid)->delete();
                                        $currentURL = URL::to('/cart');
                                        //echo "<script>alert('Please update your profile before going to cart!')</script>";
                                        echo "<script>window.location.href='".$currentURL."'</script>";
                                        exit;
                                    }
                                    

                                    //echo "<pre>";
                                    //print_r($un);
                                    $products = DB::table('products')->where('id',$product_id)->first();
                                    if($products)
                                    {
                                        $product_id = $products->id;
                                    }
                                    $checkCashback = DB::table('cashbacks')->select('*')->whereRaw('FIND_IN_SET('.$product_id.',product_id)')->first();
                                    if(!empty($checkCashback))
                                    {
                                        $cashback = $checkCashback->cashback;
                                    }
                                    else
                                    {
                                        $cashback = 0;
                                    }
                                    $specificationdata=DB::table('specifications')->where('cat_id',$products->catid)->get();
                                    if($addressdata!='')
                                    {
                                    //\DB::enableQueryLog(); // Enable query log
                                    $postCodeData = DB::table('postal_code')->select('cost')->where(array('seller_id'=>$products->user_id,'zipcode'=>$addressdata->pincode))->first();
                                    //dd(\DB::getQueryLog());die;
                                    if(empty($postCodeData))
                                    {
                                        $cost = 0;
                                    }
                                    else
                                    {
                                        $cost = $postCodeData->cost;
                                    }
                                    $totDelCharge = $totDelCharge + $cost;
                                    $delCharge = $cost?'£'.$cost:'<span class="text-black">FREE</span>';
                                    }
                                    /*foreach ($specificationdata as $specificationdatavalue) {
                                    $spec_slug = $specificationdatavalue->slug;
                                    echo $spec_res = $un[$spec_slug]; 
                                    }*/
                                    /*if($un['colors']!='')
                                    {
                                    $spec_res = $un['colors'];
                                    }*/
                                    $variantimage = DB::table('additional')->where(array('product_id'=>$product_id,'option_id'=>$variant_id))->first();
                                    $spec_detail = $cartvalue->spec_detail;
                                    $unserializespecdetail = unserialize($spec_detail);
                                    // echo "<pre>";
                                    // print_r($unserializespecdetail);
                                    // die;
                                    $quantity = $cartvalue->quantity;
                                    $price = $cartvalue->sellprice;
                                    $totalamount = $cartvalue->totalamount;
                                    $add_days = 6;
                                    $current_date = date('Y-m-d');
                                    $date = date('Y-m-d',strtotime($current_date) + (24*3600*$add_days));
                                    $newdate = date('F j, Y',strtotime($date));  
                                    ?>
                                    <div class="checkout_product_list  py-5 table-mobile ">
                                        <table class="table table-borderless align-middle">
                                            <tbody>
                                                <tr>
                                                    <td class="py-5">
                                                        <input type="hidden" name="user_id" id="user_id"
                                                            value="{{$user_id}}">
                                                        <input
                                                            <?php if($cartvalue->movetocheckout==1){?>checked<?php } else{}?>
                                                            type="radio" id="cartid" name="cartid[{{$key}}]"
                                                            value="{{$cartvalue->id}}">
                                                    </td>
                                                    <td style="width: 75px;">
                                                        <div class="checkout_prod_img me-4">
                                                            <img src="{{ asset('public/product_image/'.$variantimage->product_image) }}"
                                                                class="shadow" width="64px" alt="">
                                                        </div>
                                                    </td>
                                                    <td style="width:220px;">
                                                        <div class="checkout_prod_desc pt-2">
                                                            <p class="ft-12 lh-18 ft-medium mb-0"><a href="{{url('product-detail/'.$products->slug)}}">{{$products->name}}
                                                            </a></p>
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
                                                    </td>
                                                    <td>
                                                        <div class="checkout_qty d-flex align-items-center gap-2">
                                                            <button class="qtyminus btn" aria-hidden="true ">−</button>
                                                            <input type="text" name="qty" class="qty quantity" min="1"
                                                                max="10" step="1" value="{{$quantity}}"
                                                                class="btn border text-center">
                                                            <button class="qtyplus btn" aria-hidden="true">+</button>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="checkout_price ft-15 lh-22 ft-medium">
                                                            <span class="sprice"
                                                                data-price="{{number_format($totalamount,2)}}"> GBP
                                                                {{number_format($totalamount,2)}}</span><br>
                                                            <small><span class="text-green">{{$cashback}}%</span> cashback</small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" onclick="updatecartitem({{$cartvalue->id}},this);"
                                                            class="text-grey d-none updatecart"><i
                                                                class="fas fa-refresh"></i></a>
                                                        <a href="#" onclick="removecartitem({{$cartvalue->id}});"
                                                            class="text-grey"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="4" class="ft-15 text-grey">
                                                        
                                                        Delivery by {{$newdate}} | <?=$delCharge?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    }
                                    }
                                    // }
                                    ?>
                                    <!--<div class="wallet_money_opt d-flex flex-wrap align-items-center gap-3">
                                        <div class="d-flex  gap-3">
                                            <div>
                                                <input type="checkbox">
                                            </div>
                                            <span class="ft-medium">Use Wallet money <span
                                                    class="text-green available_balance">(Available £25)</span> Or
                                                Top-up with £705 to pay.</span>
                                        </div>
                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary w-100 px-5 ft-medium py-2 ft-12">Add
                                                Money</button>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-5 align-self-lg-center px-xl-5">
                            <div class="card bg-white shadow p-5">
                                <h3 class="ft-normal ft-15 border-bottom border-3 pb-3 mb-3 text-grey">My Cart</h3>
                                <div class="p_details_list">
                                    <div class="d-flex justify-content-between align-items-center py-3 item_price">
                                        <span>Price ({{$cartcount}} Items)</span>
                                        <price class="ft-medium">£ {{number_format( $cartdata->sum('totalamount'),2) }}
                                        </price>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-3 item_cashback">
                                        <span>Cashback</span>
                                        <price class="text-green ft-medium"> £ {{number_format( $cartdata->sum('cashback'),2) }} </price>
                                    </div>
                                    <!-- <div class="d-flex justify-content-between align-items-center py-3 item_coupon">
                                        <span>Coupon</span>
                                        <price class="text-green ft-medium">- £ 0 </price>
                                    </div> -->
                                    <div class="d-flex justify-content-between align-items-center py-3 item_coupon">
                                        <span>Delivery Charges</span>
                                        <?php if($totDelCharge==0){
                                           echo '<price class="text-green ft-medium"> FREE </price>';
                                        }else{
                                           echo '+ £ '.$totDelCharge;
                                        } ?>
                                    </div>
                                    <hr>
                                    <div
                                        class="d-flex justify-content-between align-items-center py-3 item_total ft-18 ft-medium">
                                        <span>Total Amount</span>
                                        <price> £ {{number_format(($cartdata->sum('totalamount') + $totDelCharge),2) }}
                                        </price>
                                    </div>
                                    <hr>
                                    <div
                                        class="d-flex justify-content-center align-items-center py-3 text-green ft-medium">
                                        <!--<span>You are saving £ 70 on this order</span>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-75 mx-auto my-5 py-5">
                            <!-- <a href="{{url('/checkout')}}" class="btn btn-primary px-5 mt-4 ft-medium">Proceed to checkout</a> -->
                            <!-- <a href="javascript:void(0);" onclick="movetocheckout();" class="btn btn-primary px-5 mt-4 ft-medium">Proceed to checkout</a> -->
                            <button type="submit" name="checkout" class="btn_submit btn btn-primary px-5 mt-4 ft-medium"
                                id="checkout" value="checkout">Proceed to checkout</button>
                        </div>
                    </div>
                </div>
            </form>
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
    $('.cart_page_form :radio').mousedown(function(e) {
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
});
</script>
<script>
$(function() {
    $('#submitcoupon').click(function() {
        var discountcode = $(this).parents('.enter_coupon').find('input[type="text"]').val();
        $.ajax({
            type: "post",
            url: "{{url('/cart/discountcart')}}",
            data: {
                "discountcode": discountcode,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                alert(data);
                var dataprice = data.toString().split('-');
                var discountprice = dataprice[0];
                var totalamountafterdiscount = dataprice[1];
                $(".checkout_discount").removeAttr('style');
                $(".checkout_discount price").text(discountprice);
                $(".checkout_total_price price").text(totalamountafterdiscount);
                //window.location.href='{{url("/cart")}}';
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
    $('#addcoupon').click(function() {
        $(this).hide();
        $('.enter_coupon').show();
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
        $(this).parents('tr').find('.updatecart').trigger('click');
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
        $(this).parents('tr').find('.updatecart').trigger('click');
        e.preventDefault();
    });
});
</script>
<script>
const removecartitem = (id) =>
    {
        if (confirm('Are you sure want to remove item?'))
        {
            document.location.href = '{{url("cart/removeitem")}}/' + id;
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
        url: "{{url('/cart/updateitem')}}",
        data: {
            "id": cart_id,
            _token: '{{csrf_token()}}',
            "quantity": quantity,
            "user_id": user_id
        },
        success: function(data) {
            window.location.href = '{{url("/cart")}}';
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
        <div class="alert alert-danger" style="text-align:center; margin-top:25px;color:red;"><strong>Cart Is Empty<br>
                <a href="{{url('/')}}" style="text-decoration: underline;color:#842029;">Continue
                    Shopping</a></strong></div>
    </div>
</div>
<?php 
}
?>
@include('front.include.footer')
@yield('footer')