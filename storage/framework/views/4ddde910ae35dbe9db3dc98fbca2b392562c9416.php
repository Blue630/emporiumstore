<?php echo $__env->make('front.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('header'); ?>
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
    <div class="row gx-5">
        <div class="col-xl-6 col-md-8 mx-auto">
            <div class="shadow p-4 p-lg-5">
                <h3 class="text-center ft-medium ft-25 lh-36">Please enter the OTP</h3>
                <div class="p-4 p-lg-5" id=" ">
                    <div id="seller-Login">
                        <form id="checkotpform" method="post" action="<?php echo e(url('/send-create-new-password')); ?>">
                        <?php echo csrf_field(); ?>
                            <div class="mb-4 pb-3">
                                <label for="" class="form-label ft-12 text-grey lh-18">We have sent a 6 Digit OTP to your registered Email</label>
                                <input type="hidden" name="email" value="<?php echo e($emailid); ?>">
                                <input type="input" class="form-control shadow-sm" id="otp" name="otp" placeholder="OTP" >
                                <div class="text-end  mt-2 d-flex justify-content-between position-relative">
                                     
                                    <a href="javascript:void(0);" id="sendotp" class="text-black ml-auto">Send OTP</a>
                                    <span class="countdown"></span>
                                </div>
                            </div>

                         <a href="javascript:void(0);" id="verifyotp" class="btn btn-primary w-100 mt-4 ft-medium py-4"  style="display:block !important;">Verify OTP</a>
                            <button type="submit" class="btn btn-primary w-100 mt-4 ft-medium py-4 triggerSubmit d-none" disabled>Verify OTP</button>
                        </form>
                    </div>
                    <div class="h-50px d-none d-md-block"></div>

                    <!-- <h3 class="text-center ft-22 lh-36 mt-5 pt-4 text-grey">Already have an account ?</h3> -->
                    <!-- <div class="w-75 mx-auto">
                        <button type="submit" class="btn btn-primary w-100 mt-4 ft-medium py-3">Log-in</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px "></div>
<!-- content area End -->
<?php echo $__env->make('front.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('footer'); ?>
<style type="text/css">
	.countdown {
    background: transparent;
    color: #000000;
    position: absolute;
    width: 100%;
        top: 100%;
        bottom:auto;
}
</style>
<script>
var interval;

function countdown() {
    clearInterval(interval);
    interval = setInterval(function() {
        var timer = $('.countdown').html();
        timer = timer.split(':');
        var minutes = timer[0];
        var seconds = timer[1];
        seconds -= 1;
        if (minutes < 0) return;
        else if (seconds < 0 && minutes != 0) {
            minutes -= 1;
            seconds = 59;
        } else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

        $('.countdown').html(minutes + ':' + seconds);

        if (minutes == 0 && seconds == 0) clearInterval(interval);
    }, 1000);
}

var verify_pto = Math.floor(100000 + Math.random() * 900000);

$('#sendotp').click(function() {
    var email = '<?php echo e($emailid); ?>';
    
    $('input[name=verify_pto]').val(verify_pto);
    $.ajax({
    url:'<?php echo e(url('/front/forgetpassword-sendotp')); ?>',
    method:'post',
    data:{'email':email,verify_pto:verify_pto, _token:'<?php echo e(csrf_token()); ?>'},
    success:function(data){
    }
    });
    $('.countdown').text("00:15");
    $('.countdown').css('display', 'inline');
    $('#verifyotp').show();
    countdown();
    $(this).hide();
    setTimeout(function() {
        $('#sendotp').show().text('Resend OTP');
        $('.countdown').hide(); 
    }, 15000);
});

$('#verifyotp').click(function() {
    
    // var verify_pto = $('input[name=verify_pto]').val();
    var enterOtp = $('#otp').val();

    if(verify_pto==enterOtp){
        alert("verified");
        
        $('#checkotpform').submit();
        $('.triggerSubmit').removeAttr('disabled').trigger('click');
    }else{
        alert("not verifed");
       
    }
});
$(function(){
$('#sendotp:visible').trigger('click');
});
</script><?php /**PATH D:\Works\Work-2022\laravel\resources\views/front/forget-password-otp.blade.php ENDPATH**/ ?>