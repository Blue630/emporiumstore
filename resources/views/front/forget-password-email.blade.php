@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
    <div class="row gx-5">
        <div class="col-xl-6 col-md-8 mx-auto">
            <div class="shadow p-4 p-lg-5">
                <h3 class="text-center ft-medium ft-25 lh-36">Enter Your Registered Email</h3>
                <div class="p-4 p-lg-5" id=" ">
                    <div id="seller-Login">
                    <form id="checkotpform" method="post" action="{{url('/front/forget-password-otp')}}">
                    @csrf
                    <div class="mb-4 pb-3">
                    <input type="email" class="form-control shadow-sm" id="email" name="emailid" placeholder="Enter Your Email" >
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4 ft-medium py-4 triggerSubmit">Send OTP</button>
                    </form>
                    </div>
                    <div class="h-50px d-none d-md-block"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px "></div>
<!-- content area End -->
@include('front.include.footer')
@yield('footer')