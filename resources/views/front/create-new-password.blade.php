@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
    <div class="row gx-5">
        <div class="col-xl-6 col-md-8 mx-auto">
            <div class="shadow p-4 p-lg-5">
                <h3 class="text-center ft-medium ft-25 lh-36">Create New Password</h3>
                <div class="p-4 p-lg-5" id=" ">
                    <div id="seller-Login">
                        <form id="checkotpform" method="post" action="{{url('/front/update-old-password')}}">
                        @csrf
            <div class="mb-4 pb-3">
            <input type="hidden" name="email" value="{{$emailid}}">
            <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control shadow-sm" id="password" name="password" value="">
            </div>
            <br>
            <div class="form-group">
            <label for="confirmpass">Confirm Password</label>
            <input type="password" class="form-control shadow-sm" id="confirmpass" name="confirmpass" value="" >
            </div>
            
            </div>
      
            <button type="button" class="btn btn-primary w-100 mt-4 ft-medium py-4 triggerSubmit">Submit</button>
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
<script>
$(".triggerSubmit").click(function(){

let pass = $("#password").val();
let confirmpass = $("#confirmpass").val();

if(pass == confirmpass){
    $('#checkotpform').submit();
}else{
 alert("Password and Confirm Password does not match");   
}
})
</script>

@include('front.include.footer')
@yield('footer')