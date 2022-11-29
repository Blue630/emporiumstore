@include('front.include.header')
@yield('header')
    <!-- content area start -->
    <div class="seller_login_banner2 pt-5">
        <div class="container px-lg-5">
            <div class="shadow-set bg-white-trans p-5 mt-5">
                <div class="">
                    <a href="{{url('/my-account')}}" class="text-grey"><i data-feather="arrow-left-circle" class="text-black"></i> <span class="ft-10">BACK TO PROFILE</span></a>
                </div>
                <div class="px-lg-5">
                    <div class="row">
                        <div class="col-lg-11 col-xl-10 mx-auto pt-lg-5 ">
                            <h3 class="ft-medium ft-25 lh-36  mt-5 border-bottom border-3 pb-3">Available Coupons</h3>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-lg-12 col-xl-11 mx-auto  mt-4">
                            <div class="card bg-white shadow-sm p-5 mt-5 coupon_box">
                                <div class="row">
                                    <div class="col-xl-10 mx-auto">
                                        <div class="row gx-lg-5">
                                            <?php
                                            $coupon_count = count($coupons);
                                            
                                            if($coupon_count>0)
                                            {
                                            foreach ($coupons as $couponsvalue) 
                                            {
                                            ?>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="shadow p-4  text-center">
                                                    <img src="{{ asset('public/coupons/'.$couponsvalue->image) }}" class="img-fluid rounded-circle" alt="">
                                                    <span class="ft-8 lh-12 d-block mt-3">Get 5% off on all {{$couponsvalue->name}}</span>
                                                    <strong class="ft-12 lh-18 ft-medium">{{$couponsvalue->name}}</strong>
                                                    <a href="javascript:void(0)" data-coupon="{{$couponsvalue->code}}" class="btn btn-primary py-0 ft-10 d-block mt-2">Copy Code</a>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            }
                                            else
                                            {
                                            ?>
                                            <div style="text-align:center;" class="alert alert-danger">No Coupon Available</div>
                                            <?php
                                            }
                                            ?>
                                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $("[data-coupon]").click(function(event) {
        var $tempElement = $("<input>");
        $("body").append($tempElement);
        $tempElement.val($(this).attr('data-coupon')).select();
        document.execCommand("Copy");
        $tempElement.remove();
        $(this).text($(this).attr('data-coupon'));
        alert("Copied successfully");
    });
</script>
@include('front.include.footer')
@yield('footer')