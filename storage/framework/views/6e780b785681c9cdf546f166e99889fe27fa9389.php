<?php echo $__env->make('front.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('header'); ?>
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
                    <form id="checkotpform" method="post" action="<?php echo e(url('/front/forget-password-otp')); ?>">
                    <?php echo csrf_field(); ?>
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
<?php echo $__env->make('front.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('footer'); ?><?php /**PATH D:\Works\Work-2022\laravel\resources\views/front/forget-password-email.blade.php ENDPATH**/ ?>