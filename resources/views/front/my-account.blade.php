@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="seller_login_banner2 pt-5">
    <div class="container px-lg-5">
        <div class="shadow-set bg-white-trans p-5 mt-5">
            <div class="">
                <a href="#" class="text-grey"><i data-feather="arrow-left-circle" class="text-black"></i> <span class="ft-10">BACK TO PROFILE</span></a>
            </div>
            <div class="px-lg-5">
                <div class="row">
                    <div class="col-xl-10 mx-auto pt-lg-5">
                        <div class="d-flex justify-content-between align-items-center flex-wrap   mt-5 border-bottom border-3 pb-3">
                            <h3 class="ft-medium ft-25 lh-36 m-0">My Account</h3>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-xl-10 mx-auto  mt-4">
                        <div class="row">
                            <div class="col-lg-4 my-3">
                                <div class="card shadow-sm rounded bg-white p-4 h-100">
                                    <h2 class="ft-15 ft-500 mb-0"><a href="{{url('/update-profile')}}">My Profile</a></h2>
                                    <hr class="my-3">
                                    <p class="ft-10 lh-15">Manage your Name, Address, Phone, Saved Cards, Wallet, etc.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 my-3">
                                <div class="card shadow-sm rounded bg-white p-4 h-100">
                                    <h2 class="ft-15 ft-500 mb-0"><a href="{{url('/myorders')}}">My Orders</a></h2>
                                    <hr class="my-3">
                                    <p class="ft-10 lh-15">Manage & Track your orders, and Re-Purchase items.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 my-3">
                                <div class="card shadow-sm rounded bg-white p-4 h-100">
                                    <h2 class="ft-15 ft-500 mb-0"><a href="{{url('/wishlist')}}">My Wishlist </a></h2>
                                    <hr class="my-3">
                                    <p class="ft-10 lh-15">Manage and purchase items in your Wishlist</p>

                                </div>
                            </div>
                            <div class="col-lg-4 my-3">
                                <div class="card shadow-sm rounded bg-white p-4 h-100">
                                    <h2 class="ft-15 ft-500 mb-0"><a href="{{url('/update-profile')}}#walletAccord">My Payment</a></h2>
                                    <hr class="my-3">
                                    <p class="ft-10 lh-15">Manage saved cards or add a new card.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 my-3">
                                <div class="card shadow-sm rounded bg-white p-4 h-100">
                                    <h2 class="ft-15 ft-500 mb-0"><a href="{{url('/coupon')}}">My Coupons</a></h2>
                                    <hr class="my-3">
                                    <p class="ft-10 lh-15">See all your available coupons and use them to save extra on your next purchase.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 my-3">
                                <div class="card shadow-sm rounded bg-white p-4 h-100">
                                    <h2 class="ft-15 ft-500 mb-0">My Cashback</h2>
                                    <hr class="my-3">
                                    <p class="ft-10 lh-15">Total amount of the Cashback earned till date.</p>
                                </div>
                            </div>
                             <div class="col-lg-4 my-3">
                                <div class="card shadow-sm rounded bg-white p-4 h-100">
                                    <h2 class="ft-15 ft-500 mb-0"><a href="{{url('/mybids')}}">My Bids </a></h2>
                                    <hr class="my-3">
                                    <p class="ft-10 lh-15">Sell all your added bids on auction products</p>
                                </div>
                            </div>
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
@include('front.include.footer')
@yield('footer')