@include('front.include.header')
@yield('header')
@php
use App\Wishlist;

//$user_details = $user['logged_user'];
if(Auth::check())
{
$user_id = auth()->user()->id;
$wishlist = Wishlist::getWishlistProducts($user_id);  
$wishlistcount = count($wishlist);
}
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
                        <div class="col-lg-11 col-xl-10 mx-auto pt-lg-5">
                            <div class="d-flex justify-content-between align-items-center flex-wrap   mt-5 border-bottom border-3 pb-3">
                                <h3 class="ft-medium ft-25 lh-36 m-0">My Wishlist</h3>
                                <span class="ft-20 lh-30 ft-medium">{{$wishlistcount}} Items</span>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-lg-10 mx-auto  mt-4">
                            <div class="card shadow-sm rounded bg-white p-5 my-5">
                                <?php    
                                if($wishlistcount>0)
                                {
                                foreach($wishlist as $product)
                                {
                                ?>
                                <div class="checkout_product_list mb-5 table-mobile px-lg-5 py-3">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td style="width: 75px;">
                                                    <div class="checkout_prod_img me-4">
                                                        <a href="{{url('/product-detail/')}}/{{$product->slug}}">
                                                        <img src="{{asset('/public/products')}}/{{$product->image}}" class="shadow" width="64px" alt=""></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkout_prod_desc pt-2"><a href="{{url('/product-detail/')}}/{{$product->slug}}">
                                                        <p class="ft-12 lh-18 ft-medium mb-0">{{$product->name}}</p></a>
                                                        <!--<small class="ft-10">SIZE: <span class="text-grey">10-</span>(UK) COLOR: <span class="text-grey">BLACK</span></small>-->
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="checkout_price ft-15 lh-22 ft-medium text-grey mb-3">
                                                        <strike> GBP {{$product->price}}</strike>
                                                    </div>
                                                    <small class="d-block ft-10 lh-16 ft-medium">Get upto <span class="text-danger">{{$product->discount ?? 0}}%</span>  off and additional <span class="text-danger">{{$cashback ?? 0}}% Cashback</span> </small>
                                                    <p class="ft-12 ft-medium lh-18">Get it for as low as <span class="text-green">£{{number_format($product->price * (1 - ($product->discount ?? 0) / 100), 2)}}</span></p>

                                                    <!--<div class="d-flex align-items-center gap-4 justify-content-end flex-wrap">
                                                        <a href="javascript:void(0)" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Add to Cart</a>
                                                        <a href="javascript:void(0)" class="btn btn-primary py-0 px-5 ft-10 d-block mt-2">Checkout</a>
                                                    </div>-->
                                                </td>
                                                <td style="width: 50px;" class="text-center">
                                                    <a href="{{url('/remove-product-from-wishlist')}}/{{$product->id}}" class="text-grey"><i class="fas fa-trash"></i></a>
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
                                <div class="alert alert-danger" style="text-align:center;">There is no item in wishlist</div>
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