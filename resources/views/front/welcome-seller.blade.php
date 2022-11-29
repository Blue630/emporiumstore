@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="text-center" id="welcome_sellet">
<h1 class="ft-50 lh-75 text-grey">Welcome to</h1>
<img src="{{asset('public/front/img/LOGO-seller.jpg') }}" class="img-fluid" alt="">
<div class="h-50px "></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="text-center"><a href="{{url('/seller/dashboard')}}" class="ft-20 lh-30 text-grey text-decoration-underline">Go to Seller Dashbard</a></div>
</div>
<div class="h-50px "></div>
<!-- content area End -->
@include('front.include.footer')
@yield('footer')