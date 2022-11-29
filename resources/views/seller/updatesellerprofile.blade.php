@extends('admin/layout/layout')
@section('content')
<?php
$user_id = \Auth::user()->id;
$get_business_type = DB::table('sellers')->where('user_id',$user_id)->first();
if(!empty($get_business_type))
{
$business_type = $get_business_type->business_type;
}
else
{
    $business_type = '';
}
?>
<style>
.error_label {
    color: red;
}
.seller_type {
    display: none;
}
.seller_type.active {
    display: block;
}
</style>
<!-- content area start -->
<div class="h-50px"></div>
<div class="h-50px d-none d-lg-block"></div>
<div class="content-wrapper">
<div class="container-fluid">
<div class="row gx-5">
<div class="col-12">
<div class="p-4 p-lg-5">
<h3 class="text-center ft-medium ft-25 lh-36">Let us know more about You</h3>
<div class="p-0" id=" ">
<div id="seller-Login">
<div class="mb-3 pb-1">
<select class="form-control" id="business_type" required>
<option value="">Select your Business type</option>
<option value="individual" <?php if($business_type=='Individual') { echo "selected"; } ?>>I am an 'Individual Seller'</option>
<option value="business" <?php if($business_type=='Business') { echo "selected"; } ?>>I run my own Business</option>
</select>
</div>
<form method="post" action="{{url('seller/editseller')}}/{{$get_business_type->user_id}}">
@csrf
<div class="seller_type <?php echo($business_type=="Individual" ? "active":""); ?>" id="individual-seller">
    
<label for="" class="d-block text-grey mb-2">Primary Contact Person</label>
<div class="row">
<div class="col-md-4">
<div class="mb-3 pb-1">
<input type="text" class="form-control" value="<?php echo $get_business_type->first_name;?>" id="fname" name="fname" placeholder="First Name*" >
<span class="error_label" id="fname_err"></span>
</div>
</div>
<div class="col-md-4">
<div class="mb-3 pb-1">
<input type="text" class="form-control" value="<?php echo $get_business_type->middle_name;?>" id="mname" name="mname" placeholder="Middle Name">
<span class="error_label" id="mname_err"></span>
</div>
</div>
<div class="col-md-4">
<div class="mb-3 pb-1">
<input type="text" value="<?php echo $get_business_type->last_name;?>" class="form-control" id="lname" name="lname" placeholder="Last Name*" >
<span class="error_label" id="lname_err"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3 pb-1">
<input type="text" class="form-control" value="<?php echo $get_business_type->mobile;?>" id="mobile" name="mobile" placeholder="Enter Your Official Mobile*" >
<span class="error_label" id="mobile_err"></span>
</div>
</div>
<div class="col-md-6">
<div class="mb-3 pb-1">
<input type="text" class="form-control" value="<?php echo $get_business_type->alt_mobile_no;?>" id="alt_mobile_no" name="alt_mobile_no" placeholder="Enter Your Alternate Mobile">
<span class="error_label" id="alt_mobile_no_err"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3 pb-1">
<input type="text" value="<?php echo $get_business_type->pincode;?>" class="form-control shadow-sm" id="pincode" name="pincode" placeholder="Enter You Post Code*" >
<span class="error_label" id="pincode_err"></span>
</div>
</div>
<div class="col-md-6">
<div class="mb-3 pb-1">
<input type="text" class="form-control" id="state" value="<?php echo $get_business_type->state;?>" name="state" placeholder="State*" >
<span class="error_label" id="state_err"></span>
</div>
</div>
</div>
<div class="mb-3 pb-1">
<input type="input" value="<?php echo $get_business_type->address;?>" class="form-control" id="address" name="address" placeholder="Full Address*">
<span class="error_label" id="address_err"></span>
</div>
<div class="mb-3 pb-1">
<div class="form-check">
<input class="form-check-input" <?php if($get_business_type->ind_agree==1) { echo "checked"; } ?> type="checkbox" id="ind_agree" name="ind_agree" value="1" id="flexCheckDefault" >
<label class="form-check-label ft-12 lh-18 text-grey" for="flexCheckDefault">
I have understood that all the informations provided are correct and legit, I also understand that these informations cannot be changed later.
</label>
<span class="error_label" id="ind_agree_err"></span>
</div>
</div>
<input type="hidden" name="business_type" value="Individual">

<button type="submit" onclick="return individual_validate()" class="btn btn-primary w-100 mt-4 py-4 ft-medium">Update</button>
</div>
</form>
<form method="post" action="{{url('seller/editseller')}}/{{$get_business_type->user_id}}">
@csrf
<div class="seller_type <?php if($business_type=="Business") { ?>active<?php }?>" id="business-seller">
    
<label for="" class="d-block text-grey mb-2">Primary Contact Person</label>
<div class="row">
<div class="col-md-4">
<div class="mb-3 pb-1">
<input type="text" value="<?php echo $get_business_type->first_name;?>" class="form-control" id="first_name" name="first_name" placeholder="First Name*" >
<span class="error_label" id="first_name_err"></span>
</div>
</div>
<div class="col-md-4">
<div class="mb-3 pb-1">
<input type="text" value="<?php echo $get_business_type->middle_name;?>" class="form-control" id="middle_name" placeholder="Middle Name" name="middle_name" >
<span class="error_label" id="middle_name_err"></span>
</div>
</div>
<div class="col-md-4">
<div class="mb-3 pb-1">
<input type="text" class="form-control" value="<?php echo $get_business_type->last_name;?>" id="last_name" name="last_name" placeholder="Last Name*">
<span class="error_label" id="last_name_err"></span>
</div>
</div>
</div>

<div class="mb-3 pb-1">
<input type="input" class="form-control" id="reg_business_name" name="reg_business_name" value="<?php echo $get_business_type->reg_business_name;?>" placeholder="Enter Your Registered Business Name*" >
<span class="error_label" id="reg_business_name_err"></span>
</div>

<div class="mb-3 pb-1">
<input type="input" class="form-control" id="off_business_mobile" name="off_business_mobile" value="<?php echo $get_business_type->off_business_mobile;?>" placeholder="Enter Your Official Business Mobile*" >
<span class="error_label" id="off_business_mobile_err"></span>
</div>
<div class="row">
<div class="col-md-6">
<div class="mb-3 pb-1">
<input type="text" class="form-control" id="vat_number" name="vat_number" value="<?php echo $get_business_type->vat_number;?>" placeholder="Enter VAT Number" >
<span class="error_label" id="vat_number_err"></span>
</div>
</div>
<div class="col-md-6">
<div class="mb-3 pb-1">
<input type="text" value="<?php echo $get_business_type->business_reg_num;?>" class="form-control" id="business_reg_num" name="business_reg_num" placeholder="Business Registration Number*" >
<span class="error_label" id="business_reg_num_err"></span>
</div>
</div>
</div>
<div class="mb-3 pb-1">
<input type="input" class="form-control" id="business_address" name="business_address" value="<?php echo $get_business_type->business_address;?>" placeholder="Full Business Address*" >
<span class="error_label" id="business_address_err"></span>
</div>
<div class="mb-3 pb-1">
<div class="form-check">
<input class="form-check-input" type="checkbox" id="business_agree" name="business_agree" value="1" id="flexCheckDefault2" value="<?php echo $get_business_type->business_agree;?>" <?php if($get_business_type->business_agree==1){ echo "checked"; } ?>>
<label class="form-check-label ft-12 lh-18 text-grey" for="flexCheckDefault2">
I have understood that all the informations provided are correct and legit, I also understand that these informations cannot be changed later.
</label>
<span class="error_label" id="business_agree_err"></span>
</div>
</div>
<input type="hidden" name="business_type" value="Business">
<button type="submit" onclick="return business_validate()" class="btn btn-primary w-100 mt-4 py-4 ft-medium">Update</button>
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
<!-- content area End -->
</div>
<script>
    function individual_validate(){
        var fname = document.getElementById("fname").value;
        //var mname = document.getElementById("mname").value;
        var lname = document.getElementById("lname").value;
        var mobile = document.getElementById("mobile").value;
        var alt_mobile_no = document.getElementById("alt_mobile_no").value;
        var pincode = document.getElementById("pincode").value;
        var state = document.getElementById("state").value;
        var address = document.getElementById("address").value;
        var fnameErr = "";
        //var mnameErr = "";
        var lnameErr = "";
        var mobileErr = "";
        var alt_mobile_noErr = "";
        var pincodeErr = "";
        var stateErr = "";
        var addressErr = "";
    
        var returnstatus=1;
        
        //var phonefilter = /^[0-9]{10}$/;
        
        if(!$('#ind_agree').is(":checked")) 
        {
            ind_agreeErr="please agree the terms and conditions.";
            document.getElementById('ind_agree_err').innerHTML = ind_agreeErr;
            returnstatus = 0;
        }
        else
        {
            ind_agreeErr = "";
            document.getElementById('ind_agree_err').innerHTML = "";
        }
        
        if(fname == "")
        {
            fnameErr="Please enter first name.";
            document.getElementById('fname_err').innerHTML = fnameErr; 
            returnstatus = 0;
        }
        else
        {
            fnameErr="";
            document.getElementById('fname_err').innerHTML = "";
        }
        
        /*if(mname == "")
        {
            mnameErr="Please enter middle name.";
            document.getElementById('mname_err').innerHTML = mnameErr; 
            returnstatus = 0;
        }
        else
        {
            mnameErr="";
            document.getElementById('mname_err').innerHTML = "";
        }*/
        
        if(lname == "")
        {
            lnameErr="Please enter last name.";
            document.getElementById('lname_err').innerHTML = lnameErr; 
            returnstatus = 0;
        }
        else
        {
            lnameErr="";
            document.getElementById('lname_err').innerHTML = "";
        }
        
        if(mobile == "")
        {
            mobileErr="Please enter mobile number.";
            document.getElementById('mobile_err').innerHTML = mobileErr; 
            returnstatus = 0;
        }
        else
        {
            mobileErr="";
            document.getElementById('mobile_err').innerHTML = "";
        }
        
        if(alt_mobile_no == "")
        {
            alt_mobile_noErr="Please enter alternate mobile number.";
            document.getElementById('alt_mobile_no_err').innerHTML = alt_mobile_noErr; 
            returnstatus = 0;
        }
        else
        {
            alt_mobile_noErr="";
            document.getElementById('alt_mobile_no_err').innerHTML = "";
        }
        
        if(pincode == "")
        {
            pincodeErr="Please enter postcode.";
            document.getElementById('pincode_err').innerHTML = pincodeErr; 
            returnstatus = 0;
        }
        else
        {
            pincodeErr="";
            document.getElementById('pincode_err').innerHTML = "";
        }
        
        if(state == "")
        {
            stateErr="Please enter state name.";
            document.getElementById('state_err').innerHTML = stateErr; 
            returnstatus = 0;
        }
        else
        {
            stateErr="";
            document.getElementById('state_err').innerHTML = "";
        }
        
        if(address == "")
        {
            addressErr="Please enter address.";
            document.getElementById('address_err').innerHTML = addressErr; 
            returnstatus = 0;
        }
        else
        {
            addressErr="";
            document.getElementById('address_err').innerHTML = "";
        }
    
        if(returnstatus == 0)
        {
            return false;
        }    
    }
    function business_validate(){
    var first_name = document.getElementById("first_name").value;
    //var middle_name = document.getElementById("middle_name").value;
    var last_name = document.getElementById("last_name").value;
    var reg_business_name = document.getElementById("reg_business_name").value;
    var off_business_mobile = document.getElementById("off_business_mobile").value;
    var vat_number = document.getElementById("vat_number").value;
    var business_reg_num = document.getElementById("business_reg_num").value;
    var business_address = document.getElementById("business_address").value;
    var firstnameErr = "";
    //var middlenameErr = "";
    var lastnameErr = "";
    var reg_business_nameErr = "";
    var off_business_mobileErr = "";
    var vat_numberErr = "";
    var business_reg_numErr = "";
    var business_addressErr = "";

    var returnstatus=1;
    
    //var phonefilter = /^[0-9]{10}$/;
    
    if(!$('#business_agree').is(":checked")) 
    {
        business_agreeErr="please agree the terms and conditions.";
        document.getElementById('business_agree_err').innerHTML = business_agreeErr;
        returnstatus = 0;
    }
    else
    {
        business_agreeErr = "";
        document.getElementById('business_agree_err').innerHTML = "";
    }
    
    if(first_name == "")
    {
        firstnameErr="Please enter first name.";
        document.getElementById('first_name_err').innerHTML = firstnameErr; 
        returnstatus = 0;
    }
    else
    {
        firstnameErr="";
        document.getElementById('first_name_err').innerHTML = "";
    }
    
    /*if(middle_name == "")
    {
        middlenameErr="Please enter middle name.";
        document.getElementById('middle_name_err').innerHTML = middlenameErr; 
        returnstatus = 0;
    }
    else
    {
        middlenameErr="";
        document.getElementById('middle_name_err').innerHTML = "";
    }*/
    
    if(last_name == "")
    {
        lastnameErr="Please enter last name.";
        document.getElementById('last_name_err').innerHTML = lastnameErr; 
        returnstatus = 0;
    }
    else
    {
        lastnameErr="";
        document.getElementById('last_name_err').innerHTML = "";
    }
    
    if(reg_business_name == "")
    {
        reg_business_nameErr="Please enter registered business name.";
        document.getElementById('reg_business_name_err').innerHTML = reg_business_nameErr; 
        returnstatus = 0;
    }
    else
    {
        reg_business_nameErr="";
        document.getElementById('reg_business_name_err').innerHTML = "";
    }
    
    if(off_business_mobile == "")
    {
        off_business_mobileErr="Please enter official business business mobile number.";
        document.getElementById('off_business_mobile_err').innerHTML = off_business_mobileErr; 
        returnstatus = 0;
    }
    else
    {
        off_business_mobileErr="";
        document.getElementById('off_business_mobile_err').innerHTML = "";
    }
    
    if(vat_number == "")
    {
        vat_numberErr="Please enter VAT number.";
        document.getElementById('vat_number_err').innerHTML = vat_numberErr; 
        returnstatus = 0;
    }
    else
    {
        vat_numberErr="";
        document.getElementById('vat_number_err').innerHTML = "";
    }
    
    if(business_reg_num == "")
    {
        business_reg_numErr="Please enter business registration number.";
        document.getElementById('business_reg_num_err').innerHTML = business_reg_numErr; 
        returnstatus = 0;
    }
    else
    {
        business_reg_numErr="";
        document.getElementById('business_reg_num_err').innerHTML = "";
    }
    
    if(business_address == "")
    {
        business_addressErr="Please enter business business address.";
        document.getElementById('business_address_err').innerHTML = business_addressErr; 
        returnstatus = 0;
    }
    else
    {
        business_addressErr="";
        document.getElementById('business_address_err').innerHTML = "";
    }

    if(returnstatus == 0)
    {
        return false;
    }
}


$(function() {
$('#business_type').change(function() {
var saveval = $.trim($(this).val());
$('.seller_type').removeClass('active');
if (saveval == 'individual') {
$('#individual-seller').addClass('active');
} else if (saveval == 'business') {
$('#business-seller').addClass('active');
} else {
$('.seller_type').removeClass('active');
}
});
});
</script>
@endsection