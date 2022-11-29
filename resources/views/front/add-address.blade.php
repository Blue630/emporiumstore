@include('front.include.header')
@yield('header')
<?php
if(Auth::check())
{
$user_id = auth()->user()->id;
}
?>
<!-- content area start -->
<div class="seller_login_banner pt-5">

<div class="container px-lg-5">
    <div class="shadow-set bg-white p-5 mt-5">
        <div class="">
            <a href="{{url('/checkout')}}" class="text-grey"><i data-feather="arrow-left-circle" class="text-green"></i> <span class="ft-10">Return to Checkout</span></a>
        </div>


        <div class="px-lg-5">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <?php
                    //$addressdetail = '';
                    ?>
                    <h3 class="ft-medium ft-25 lh-36  mt-5 check_green">Current Address</h3>
                    <div class="add_address_form">
                        <h4 class="ft-medium ft-12 lh-18 text-grey pb-3  border-bottom border-3 mb-0">Selected</h4>
                        <div class="py-5">
                            <div class="payments_details_form">
                                    @if($msg=Session::get('success'))
                                    <div class="alert alert-success">{{$msg}}</div>
                                    @endif
                                    <form method="post" action="{{url('editaddress')}}/{{@$addressdetail->id}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4 pb-3">
                                        <label for="" class="d-block ft-10 text-grey ft-medium">COUNTRY</label>
                                        <select name="country" id="country" class="form-control text-uppercase ft-12" required="">
                                            <option value=''>Select Country</option>
                                            <?php
                                            $country = DB::table('countries')->orderBy('id','asc')->get();
                                            foreach ($country as $countryvalue) 
                                            {
                                            ?>
                                            <option <?php echo ($countryvalue->name == $addressdetail->country ?'selected="selected"':"") ?> value="{{$countryvalue->name}}">{{$countryvalue->name}}</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-4 pb-3">
                                        <label for="" class="d-block ft-10 text-grey ft-medium">Address Line 1</label>
                                        <input type="text" class="form-control shadow-sm ft-12 ft-medium" placeholder="Enter Address Line 1" id="address" name="address" value="@if($addressdetail){{$addressdetail->address}}@endif" required="">
                                    </div>
                                    <div class="mb-4 pb-3">
                                        <label for="" class="d-block ft-10 text-grey ft-medium">Address Line 2</label>
                                        <input type="text" class="form-control shadow-sm ft-12 ft-medium" placeholder="Enter Address Line 2" id="address2" name="address2" value="@if($addressdetail){{$addressdetail->address2}}@endif" required="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4 pb-3">
                                                <label for="" class="d-block ft-10 text-grey ft-medium">CITY</label>
                                                <input class="form-control shadow-sm ft-12 ft-medium" type="text" placeholder="Enter City" value="@if($addressdetail){{$addressdetail->city}}@endif" id="city" name="city" required="">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4 pb-3">
                                                <label for="" class="d-block ft-10 text-grey ft-medium">POSTCODE</label>
                                                <input class="form-control shadow-sm ft-12 ft-medium" type="text" placeholder="Enter Pincode" id="pincode" name="pincode" value="@if($addressdetail){{$addressdetail->pincode}}@endif" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4 pb-3">
                                                <label for="" class="d-block ft-10 text-grey ft-medium">COUNTY</label>
                                                <input class="form-control shadow-sm ft-12 ft-medium" type="text" placeholder="County" id="state" value="@if($addressdetail){{$addressdetail->state}}@endif" name="state" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4 pb-3">
                                                <label for="" class="d-block ft-10 text-grey ft-medium">PHONE NO.</label>
                                                <input class="form-control shadow-sm ft-12 ft-medium" type="text" placeholder="Phone Number" value="@if($addressdetail){{$addressdetail->phoneno}}@endif" id="phoneno" name="phoneno">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                                    <button type="submit" class="btn btn-primary w-100 mt-4 py-4 ft-medium">Update & Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 d-none d-xl-flex">&nbsp;</div>
                <div class="col-lg-6 col-xl-5">
                    <div class="button_h d-flex justify-content-center h-100 align-items-center">
                        <button type="submit" class="btn btn-default border-secondary px-5 shadow rounded-0 mt-4 ft-medium ft-12 w-75" id="addnewaddress"> Add new Address   +</button>
                    </div>
                    <div id="new_address_block">
                        <h3 class="ft-medium ft-25 lh-36  mt-5 add_new_address position-relative">Add New Address <i class="cross_dark" id="delete_new_address"></i></h3>
                        <div class="selected_address">
                            <h4 class="ft-medium ft-12 lh-18 text-grey pb-3  border-bottom border-3 mb-0">&nbsp;</h4>
                            <div class="py-5">
                                <div class="add_address_form">
                                        @if($msg=Session::get('success'))
                                        <div class="alert alert-success">{{$msg}}</div>
                                        @endif
                                        <form method="post" action="{{url('addaddress')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4 pb-3">
                                            <label for="" class="d-block ft-10 text-grey ft-medium">COUNTRY</label>
                                            <select name="country" id="country" class="form-control text-uppercase ft-12" required="">
                                                <option value=''>Select Country</option>
                                                <?php
                                                $country = DB::table('countries')->orderBy('id','asc')->get();
                                                foreach ($country as $countryvalue) 
                                                {
                                                ?>
                                                <option value="{{$countryvalue->name}}">{{$countryvalue->name}}</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-4 pb-3">
                                            <label for="" class="d-block ft-10 text-grey ft-medium">Address Line 1</label>
                                            <input type="text" class="form-control shadow-sm ft-12 ft-medium" placeholder="Enter Address Line 1" id="address" name="address" value="" required="">
                                        </div>
                                        <div class="mb-4 pb-3">
                                            <label for="" class="d-block ft-10 text-grey ft-medium">Address Line 2</label>
                                            <input type="text" class="form-control shadow-sm ft-12 ft-medium" placeholder="Enter Address Line 2" id="address2" name="address2" value="" required="">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-4 pb-3">
                                                    <label for="" class="d-block ft-10 text-grey ft-medium">CITY</label>
                                                    <input class="form-control shadow-sm ft-12 ft-medium" type="text" id="city" name="city" placeholder="Enter City" value="" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-4 pb-3">
                                                    <label for="" class="d-block ft-10 text-grey ft-medium">POSTCODE</label>
                                                    <input class="form-control shadow-sm ft-12 ft-medium" type="text" id="pincode" name="pincode" placeholder="Enter Pincode" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-4 pb-3">
                                                    <label for="" class="d-block ft-10 text-grey ft-medium">COUNTY</label>
                                                    <input class="form-control shadow-sm ft-12 ft-medium" type="text" id="state" name="state" placeholder="State" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-4 pb-3">
                                                    <label for="" class="d-block ft-10 text-grey ft-medium">PHONE NO.</label>
                                                    <input class="form-control shadow-sm ft-12 ft-medium" type="text" id="phoneno" name="phoneno" placeholder="Phone Number">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                                        <button type="submit" class="btn btn-primary w-100 mt-4 py-4 ft-medium"> Save & Select</button>
                                        <div class="text-center mt-5">
                                            <a href="#" class="ft-15 lh-22 text-grey underline"><u>Skip</u></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-50px"></div>
</div>
<!-- content area End -->
@include('front.include.footer')
@yield('footer')
<script>
$(function() {
    $('#addnewaddress').click(function() {
        $(this).parent().removeClass('d-flex').hide();
        $('#new_address_block').show();
    });
    $('#delete_new_address').click(function() {
        $('#addnewaddress').parent().addClass('d-flex').show();
        $('#new_address_block .form-control').val('');
        $('#new_address_block').hide();
    });
});
</script>