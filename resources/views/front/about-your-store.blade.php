@include('front.include.header')
@yield('header')
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
<div class="row gx-5">
<div class="col-xl-6 col-md-8 mx-auto">
<div class="shadow p-4 p-lg-5">
<h3 class="text-center ft-medium ft-20 lh-30">Let us know more about your STORE</h3>
<div class="p-4 p-lg-5" id=" ">
<div>
<form class=" text-grey" method="post" action="{{url('aboutyourstore')}}">
@csrf
<div class="mb-4 pb-3">
    <label for="" class="form-label">Enter your Store Name</label>
    <input type="text" id="storename" name="storename" class="form-control shadow-sm" id="" placeholder="Your Store Name*" required="">
</div>
<div class="mb-4 pb-3">
    <select id="product_category" name="product_category" class="form-control mb-3" required="">
      <option value=''>Please Select a Product Category</option>
      <?php
      $category = DB::table('category')->orderBy('id','desc')->get();
      foreach($category as $categoryresult)
      {
      ?>
      <option value="{{$categoryresult->catname}}">{{$categoryresult->catname}}</option>
      <?php
      }
      ?>
    </select>
</div>
<div class="row">
    <div class="mb-4">
        <p>Where do you arrange your products from?</p>
    </div>
    <div class="col-md-6">
        <div class="mb-4 pb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="I make products by myself." id="arrange_product" name="arrange_product[]">
                <label class="form-check-label" for="flexCheckDefault">
            I make products by myself.
          </label>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-4 pb-3">
            <div class="form-check">
                <input class="form-check-input" name="arrange_product[]" type="checkbox" value="I resell the products that I buy." id="arrange_product">
                <label class="form-check-label" for="flexCheckDefault">
            I resell the products that I buy.
          </label>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-4 pb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="I Import the products." id="arrange_product" name="arrange_product[]">
                <label class="form-check-label" for="flexCheckDefault">
            I Import the products.
          </label>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-4 pb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="I Manufacture products." id="arrange_product" name="arrange_product[]">
                <label class="form-check-label" for="flexCheckDefault">
           I Manufacture products.
          </label>
            </div>
        </div>
    </div>
</div>
<div class="mt-5 mb-4 pb-3">
    <label for="" class="form-label">How Many Products you will sell?</label>
    <select class="form-control  mb-3" id="no_product_list" name="no_product_list" aria-label="" required="">
      <option value=''>Please Select a Number</option>
      <option value="1-10">1-10</option>
      <option value="10-100">10- 100</option>
      <option value="100-500">100- 500</option>
      <option value="I Don’t Know">I Don’t Know</option>
     </select>
</div>
<input type="hidden" id="u_id" name="u_id" value="{{$u_id}}">
<input type="hidden" id="business_type" name="business_type" value="{{$business_type}}">
<input type="hidden" id="email" name="email" value="{{$email}}">
<input type="hidden" id="is_admin" name="is_admin" value="{{$is_admin}}">
<input type="hidden" id="password" name="password" value="{{$password}}">
<input type="hidden" id="showpassword" name="showpassword" value="{{$showpassword}}">
<input type="hidden" id="name" name="name" value="{{$name}}">
<input type="hidden" id="user_type" name="user_type" value="{{$user_type}}">
<?php
if($business_type=='Individual')
{
?>
<input type="hidden" id="fname" name="fname" value="{{$fname}}">
<input type="hidden" id="lname" name="lname" value="{{$lname}}">
<input type="hidden" id="mname" name="mname" value="{{$mname}}">
<input type="hidden" id="mobile" name="mobile" value="{{$mobile}}">
<input type="hidden" id="alt_mobile_no" name="alt_mobile_no" value="{{$alt_mobile_no}}">
<input type="hidden" id="ind_agree" name="ind_agree" value="{{$ind_agree}}">
<input type="hidden" id="state" name="state" value="{{$state}}">
<input type="hidden" id="pincode" name="pincode" value="{{$pincode}}">
<input type="hidden" id="address" name="address" value="{{$address}}">
<?php
}
elseif($business_type=='Business')
{
?>
<input type="hidden" id="reg_business_name" name="reg_business_name" value="{{$reg_business_name}}">
<input type="hidden" id="reg_business_name" name="reg_business_name" value="{{$reg_business_name}}">
<input type="hidden" id="off_business_mobile" name="off_business_mobile" value="{{$off_business_mobile}}">
<input type="hidden" id="vat_number" name="vat_number" value="{{$vat_number}}">
<input type="hidden" id="business_reg_num" name="business_reg_num" value="{{$business_reg_num}}">
<input type="hidden" id="business_address" name="business_address" value="{{$business_address}}">
<input type="hidden" id="first_name" name="first_name" value="{{$first_name}}">
<input type="hidden" id="middle_name" name="middle_name" value="{{$middle_name}}">
<input type="hidden" id="last_name" name="last_name" value="{{$last_name}}">
<input type="hidden" id="business_agree" name="business_agree" value="{{$business_agree}}">
<?php
}
?>
<button type="submit" class="btn btn-primary w-100 mt-4 ft-medium">Register</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="h-50px d-none d-lg-block"></div>
<div class="h-50px "></div>
@include('front.include.footer')
@yield('footer')