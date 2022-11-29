@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="seller_login_banner pt-5">
    <div class="container">
        <h2 class="text-center shadow-set text-grey py-4 ft-bold bg-white">SELL ON EMPORIUM</h2>
        <div class="row">
            <div class="col-lg-6 col-xl-5 mx-auto py-5">
                <article>
                    <h1 class="ft-50 lh-75 text-grey ft-bold">Become an<br>EMPORIUM seller</h1>
                    <p>Sell upto ** products for free. We host individual as well as business sellers with infinite number of products.</p>
                </article>
                <div class="seller-login-btn">
                    <a href="{{url('/login')}}" class="btn btn-primary mt-4 ft-medium btn_primary_trans">Log-In</a><br>
                    <small class="ft-10 lh-12 text-grey">20% per order + monthly membership fee</small>
                </div>
            </div>
        </div>
    </div>
    <div class="h-50px"></div>
    <div class="h-50px"></div>
    <div class="h-50px d-none d-lg-block"></div>
    <div class="h-50px d-none d-lg-block"></div>
    <div class="h-50px d-none d-lg-block"></div>
    <div class="h-50px d-none d-lg-block"></div>
    <div class="container w-xl-75">
        <div class="row gx-5">
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">2% Commission on<br>Susbcription
                    </h2>
                    <p class="ft-12 lh-18 text-grey">You pay 0% Commission on orders on purchase of a monthly Seller subscription.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">Huge Potential for<br>Sales
                    </h2>
                    <p class="ft-12 lh-18 text-grey">Sell your products to more than 67+ million ppotential customers around UK.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">We Promote your<br>Products
                    </h2>
                    <p class="ft-12 lh-18 text-grey">We market your products to increase the potential for you to get more orders.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">Repeat Sales</h2>
                    <p class="ft-12 lh-18 text-grey">Gone days when you have to approach your previous clients, we will remind them once you offer new products.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">Solid Back-End<br>Support
                    </h2>
                    <p class="ft-12 lh-18 text-grey">We are just a few clicks away in helping you out.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">Perks
                    </h2>
                    <p class="ft-12 lh-18 text-grey">Want to get more clients? no issues we have integrated a ton of features using which you can definitely get more orders.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">Inventory<br>Management
                    </h2>
                    <p class="ft-12 lh-18 text-grey">We have created a very easy to use Seller ecosystem to let you manage your store using very few clicks.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">No Hidden Fee
                    </h2>
                    <p class="ft-12 lh-18 text-grey">We are transaparent with all the subscription packs and we dont charge any hidden fee.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_view bg-white  shadow p-5">
                    <h2 class="py-4 ft-poppins ft-bold">Data Protection
                    </h2>
                    <p class="ft-12 lh-18 text-grey">All your orders, wallet, and account are in safe hands. You can count on us.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="h-50px"></div>
    <div class="h-50px"></div>
    <div class="letsstart_selling text-center">
        <h3 class="ft-40 lh-60 text-grey">Let’s start Selling</h3>
        <p class="ft-15 text-grey mb-4">Sell products to 67+ million customers</p>
        <div class="seller-login-btn">
            <a href="#" class="btn btn-primary mt-4 ft-medium btn_primary_trans">Log-In</a><br>
            <small class="ft-10 lh-12 text-grey">20% per order + monthly membership fee</small>
        </div>
    </div>
    <div class="h-50px"></div>
</div>
<section id="signup_newsletter" class="my-5 py-5 px-5">
    <div class="d-lg-flex align-items-center justify-content-center">
        <h2 class="ft-35 lh-50 text-black text-center pb-4 pb-lg-0">Sign-Up to Our Newsletter</h2>
        <div class="sub_button ps-lg-5 ms-lg-5">
            <a href="#" class="blue_btn btn-large ft-35 text-center">SUBSCRIBE</a>
        </div>
    </div>
</section>
<!-- content area End -->
@include('front.include.footer')
@yield('footer')