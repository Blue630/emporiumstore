@include('front.include.header')
@yield('header')
<?php
if(Auth::check())
{
    //echo "HELLO DHEERAJ";
    //$user_id = auth()->user()->id;
    return redirect('/');
    //$currentURL = URL::to('/');
    //echo "<script>window.location.href='".$currentURL."'</script>";
    //exit;
}
?>
<style>
    [type="checkbox"]{ 
    box-shadow: 0px 0px 0px 1px #555 !important;
    }
</style>
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
<div class="row gx-5">
<div class="col-xl-6 col-md-8 mx-auto">
<div class="shadow p-4 p-lg-5">
<ul class="nav nav-tabs mb-4" id="loginTab" role="tablist">
<li class="nav-item" role="presentation">
<button class="nav-link active ft-25 lh-36" id="Login-tab" data-bs-toggle="tab" data-bs-target="#Login" type="button" role="tab" aria-controls="Login" aria-selected="true">LOG-IN</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link ft-25 lh-36" id="Register-tab" data-bs-toggle="tab" data-bs-target="#Register" type="button" role="tab" aria-controls="Register" aria-selected="false">REGISTER</button>
</li>
</ul>
<div class="tab-content p-4 p-lg-5" id="myTabContent">
<div class="tab-pane fade show active" id="Login" role="tabpanel" aria-labelledby="Login-tab">
<form class="login" method="post" action="{{url('dologin')}}">
@csrf
<div class="mb-4 pb-3">
    <?php
    if($errors->first('email')!="")
    {
    ?>
    <div class="alert alert-danger">{{$errors->first('email')}}</div>
    <?php
    }
    ?>
    @if($err=Session::get('error'))
        <div class="alert alert-danger">{{$err}}</div>
    @endif
    @if($success=Session::get('success'))
    <div class="alert alert-success">{{$success}}</div>
    @endif
    <input type="email" class="form-control shadow-sm" id="email" name="email" placeholder="Email">
</div>
<div class="mb-4 pb-3">
    <input type="password" class="form-control shadow-sm" name="password" id="password" placeholder="Password">
    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div>
<button type="submit" class="btn btn-primary w-100 mt-4 ft-medium">Log-In</button>
<div class="mb-3 mt-5">
    <a href="{{url('/forget-password-email')}}" class="form-check-label text-secondary">Forgot your Password?</a>
</div>
<h4 class="ft-20 lh-30 ft-medium my-4 text-black text-center">LOG-IN USING</h4>
<div class="d-flex justify-content-around align-items-center px-lg-5">
    <a href="redirect/google" style="font-size: 6rem;"><span class="iconify" data-icon="flat-color-icons:google"></span><i class="fab fa-google text-black ie_show" style="color: #4285F4;"></i></a>
    <!-- <a href="#" style="font-size: 7rem;color: #000;"><span class="iconify" data-icon="jam:apple-circle"></span><i class="fab fa-apple text-black ie_show" style="color: #000000;"></i></a> -->
    {{-- <a href="redirect/facebook" style="font-size: 6rem;"><span class="iconify" data-icon="logos:facebook"></span><i class="fab fa-facebook text-black ie_show" style="color: #395185;"></i></a> --}}
    <a href="redirect/twitter" style="font-size: 6rem;"><span class="iconify" data-icon="logos:twitter"></span><i class="fab fa-twitter text-black ie_show" style="color: #55ACEE;"></i></a>
</div>
</form>
</div>
<div class="tab-pane fade" id="Register" role="tabpanel" aria-labelledby="Register-tab">
<form class="login" method="post" action="{{url('registeration')}}">
@csrf
<h3 class="ft-25 lh-36 ft-400 text-center mb-5">We want to know more about you?<br>@if($msg=Session::get('success'))<span style="color:red">{{$msg}}</span>@endif</h3>
<?php
if($errors->first('email')!="")
{
?>
<div class="alert alert-danger">{{$errors->first('email')}}</div>
<?php
}
?>
<div class="d-flex gap-5 mb-5 pb-3 justify-content-center">
    <div class="buysellcheck">
        <label for="" class="btn btn-primary py-4 px-5 ft-18 ft-medium">
            <input type="radio" name="user_type" id="user_type" value='2'> 
            <span>I want to sell</span>
        </label>
    </div>
    <div class="buysellcheck">
        <label for="" class="btn btn-primary py-4 px-5 ft-18 ft-medium">
            <input type="radio" name="user_type" id="user_type" value='3'> 
            <span>I want to Buy</span>
        </label>
    </div>
</div>
<!-- <div class="mb-4 pb-3">
    <select name="user_type" id="user_type" class="form-control">
        <option vlaue=''>Select User Type</option>
        <option value='2'>Seller</option>
        <option value='3'>Buyer</option>
    </select>
</div> -->
<div class="mb-4 pb-3">
    <input type="text" class="form-control shadow-sm" name="name" id="name" aria-describedby="nameHelp" placeholder="Name" required>
</div>
<div class="mb-4 pb-3">
    <input type="email" class="form-control shadow-sm" name="email" id="email" aria-describedby="emailHelp" placeholder="Email" required>
</div>
<div class="mb-4 pb-3">
    <input type="password" class="form-control shadow-sm" id="passwords" name="password" placeholder="Password" required>
    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-passwords"></span>
</div>
<!-- <div class="mb-4 pb-3">
    {{$errors->first('cpassword')}}
    <input type="password" class="form-control shadow-sm" id="cpassword" name="cpassword" placeholder="Confirm Password">
    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div> -->
<input type="checkbox" name="terms" id="terms" required>  I Agree <a href="{{url('terms/')}}" target="_blank">Terms & Coditions</a>
<br><br>

<button type="submit" id="sendotp_btn" disabled class="btn btn-primary w-100 mt-4 ft-medium triggerSubmit">SEND OTP</button>
<div class="mb-3 mt-5">
    <a href="{{url('/forget-password-email')}}" class="form-check-label text-secondary">Forgot your Password?</a>
</div>
<h4 class="ft-20 lh-30 ft-medium my-4 text-black text-center">REGISTER USING</h4>
<div class="d-flex justify-content-around align-items-center px-lg-5">
    <a href="#" style="font-size: 6rem;"><span class="iconify" data-icon="flat-color-icons:google"></span><i class="fab fa-google text-black ie_show" style="color: #4285F4;"></i></a>
    {{-- <a href="#" style="font-size: 6rem;"><span class="iconify" data-icon="logos:facebook"></span><i class="fab fa-facebook text-black ie_show" style="color: #395185;"></i></a> --}}
    <a href="#" style="font-size: 6rem;"><span class="iconify" data-icon="logos:twitter"></span><i class="fab fa-twitter text-black ie_show" style="color: #55ACEE;"></i></a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px "></div>

<script>
$(function(){
   $(".toggle-passwords").on('click', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var saveattr = $('#passwords').attr('type');
        if (saveattr == 'password') {
            $('#passwords').attr('type', 'text');
        } else {
            $('#passwords').attr('type', 'password');
        }
    });
    
   $('#terms').click(function(){
       if($(this).is(':checked')){
           $('#sendotp_btn').removeAttr('disabled');
       }
       else
       {
         $('#sendotp_btn').prop('disabled',true);  
       }
   }) 
});
 
</script>
@include('front.include.footer')
@yield('footer')