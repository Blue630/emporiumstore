@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="h-50px d-none d-lg-block"></div>
<div class="container ab-w  my-5">
    <div class="page_title about_us position-relative">
        <img src="{{asset('public/pages/'.$about->banner_image)}}" class="img-fluid d-block mx-auto" alt="">
        <h1 class="ft-60 lh-90 ft-bold">OUR PASSION<br>LED US HERE</h1>
    </div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
    <div class=" red_stripe_left"></div>
    <article class="global_leading_msg  ab-w mx-auto text-center">
        <div class="w-100 clearfix">&nbsp;</div>
        <h3 class="ft-30 ft-medium lh-45 text-center mb-4 pb-4 text-black mt-2">{{$about->heading}}</h3>
        <p class="ft-20 lh-30">{!!$about->content!!}</p>
        <p class="ft-20 lh-30">{!!$about->short_desc!!} </p>

        <div class="w-100 clearfix">&nbsp;</div>
    </article>
    <div class=" red_stripe_right"></div>
</div>
<div class="w-100 clearfix"></div>
<div class="h-50px d-none d-lg-block"></div>

<div class="container my-5 ab-w">
    <h3 class="ft-30 ft-medium lh-45 text-center mb-5 text-black">{{$about->heading2}}</h3>
    <img src="{{asset('public/pages/'.$about->heading2_image)}}" class="img-fluid d-block mx-auto" alt="">

</div>

<div class="h-50px d-none d-lg-block"></div>

<div class="container">
    <div class="red_stripe_right2"></div>
    <article class="global_leading_msg  ab-w mx-auto text-center clearfix">
        <div class="w-100 clearfix">&nbsp;</div>
        <h3 class="ft-30 ft-medium lh-45 text-center mb-4 pb-4 text-black mt-5">{{$about->heading3}}</h3>
        <p class="ft-20 lh-30">{!!$about->content2!!} </p>
        <p class="ft-20 lh-30">{!!$about->content4!!}</p>
        <p class="ft-20 lh-30">{!!$about->content5!!}</p>
        <p class="ft-20 lh-30">{!!$about->content6!!}</p>
        <div class="w-100 clearfix">&nbsp;</div>
    </article>
    <div class="  red_stripe_left2"></div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
    <article class="global_leading_msg  ab-w mx-auto text-center clearfix aq_png">
        <div class="w-100 clearfix">&nbsp;</div>
        <h3 class="ft-30 ft-medium lh-45 text-center mb-4 pb-4 text-black mt-5">{{$about->heading4}}
        </h3>
        <p class="ft-20 lh-30">{!!$about->content3!!}</p>
        <p class="ft-20 lh-30">{!!$about->content7!!} </p>
        <div class="w-100 clearfix">&nbsp;</div>
    </article>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px d-none d-lg-block"></div>
@include('front.include.footer')
@yield('footer')