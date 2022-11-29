@extends('admin.layout.layout')
@section('content')
@php
use App\Category;
@endphp
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<!-- Content Wrapper. Contains page content -->
<!-- Google Font: Source Sans Pro -->
<script type="text/javascript">
$(document).ready(function(){
    /* Populate data to subcategory dropdown */
    $('#catid').on('change',function(){
        var catId = $(this).val();
        //alert(catId);
        $.ajax({
                url:'{{ url('seller/getsubcat') }}',
                method:'get',
                type:'html',
                data:{catId:catId},
                success:function(data){
                   //alert(data); //return false;
                   $('#subcat_id').html(data);
                }
        }); 
    });
    $('#catid').on('change',function(){
        var catId = $(this).val();
        //alert(catId);
        $.ajax({
                url:'{{ url('seller/getspecification') }}',
                method:'get',
                type:'html',
                data:{catId:catId},
                success:function(data){
                    let result = data.split('|-|');
                    if(result[1] == 1){
                        $('.btn_submit').prop('disabled', true);
                    }
                    else{
                        $('.btn_submit').prop('disabled', false);
                    }
                   //alert(data); //return false;
                   $('#spec_id').html(result[0]);
                }
        }); 
    });
});
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Product</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/seller/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

            <!-- <div class="col-12 text-right">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#uploadcsvmodal"><i class="far fa-file-excel"></i> Upload Bulk Product</button>
            </div> -->
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<form method="post" action="{{url('seller/addproduct')}}" enctype="multipart/form-data" onsubmit="onSubmit()">
@csrf
<div class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Select Category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categories</label>
                            <select name="catid" id="catid" class="form-control" required>
                            <option value="">Select Category</option>
                            @if($cate)
                              @foreach($cate as $allcate)
                                <option value="{{$allcate->id}}">{{$allcate->catname}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Categories</label>
                            <select id="subcat_id" style="width: 100%;" name="subcat_id" class="form-control" required>
                                <option value="">Select Category first</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Basic Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Number of available quantities.</label>
                            <input type="number" min="1" id="quantity" name="quantity" class="form-control" placeholder="Quantity" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" min="0.1" step="0.1" id="price" name="price" class="form-control" placeholder="Price" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Discount <small>(leave empty if no discount)</small></label>
                            <div class="input-group mb-3">
                                <input type="number" min="0.01" step="0.01" id="discount" name="discount" class="form-control" placeholder="Discount" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Discount Code</label>
                            <select name="discount_code_id" id="discount_code_id" class="form-control" >
                            <option value="">Select Discount</option>
                            <?php
                            $seller_id=auth()->user()->id;
                            $discount_code=DB::table('coupons')->where('seller_id',$seller_id)->orderBy('id','desc')->get();
                            foreach($discount_code as $discount_code_result)
                            {
                            ?>
                            <option value="{{$discount_code_result->id}}">{{$discount_code_result->code}}({{$discount_code_result->percent}}%)</option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                    </div>
                    <!--<div class="col-md-6">
                        <div class="form-group">
                            <label>Product SKU Code</label>
                            <div class="input-group mb-3">
                                <input type="text" id="product_code" name="product_code" class="form-control" placeholder="SKU Code" required>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Delivery Area Postcode</label>
                            <select name="zipcode[]" id="zipcode" class="form-control" multiple required>
                            <option value="">Select Postal Code</option>
                            @if($postal_code)
                              @foreach($postal_code as $allpostal_code)
                                <option value="{{$allpostal_code->id}}">{{$allpostal_code->zipcode}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Main Image</label>
                            <div class="input-group mb-3">
                                <input type="file" id="proimage" name="proimage" class="form-control" placeholder="Image" required>&nbsp;&nbsp;&nbsp;<span style="color:red">[SIZE: 240*240]</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Short Description</label>
                            <div class="card-body p-0">
                                <textarea id="short_desc" class="form-control ckeditor" name="short_desc" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <div class="card-body p-0">
                                <textarea id="description" class="form-control ckeditor" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Specification</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="spec_id">
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">SEO Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea id="meta_description" class="form-control" name="meta_description" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                    <button type="submit" class="btn_submit btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<!-- REQUIRED SCRIPTS -->
<style>
[data-dz-errormessage] {
    display: none;
}
.dlete_row{
    position: absolute;
    right: 20px;
    background: #000;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    text-align: center;
    font-size: 20px;
    top: -12px;
    z-index: 9999;
    color: #fff;
    font-family: 'Circular-Loom';
    display: flex;
    justify-content: center;
    align-items: center;
}
#attributes_clones>div{
    position: relative;
}
#attributes_clones>div:only-child .dlete_row{
        display: none;
} 
</style>
<!-- jQuery -->            
<script>

function createname(){
    var j = 0;
    $('#attributes_clones>div').each(function(){ 
        j++;        
   $(this).find('[data-attr]').each(function(){
        varsaveattr = $(this).attr('data-attr');
        if(varsaveattr=='product_image'){
        $(this).attr('name','product_image['+j+'][]');
        }else{
        $(this).attr('name','var['+j+']['+varsaveattr+']');
       }
    });
}); 
   
}    

function addRow() {
var table = $('#attributes_clones');
var rowCount = $('#attributes_clones>div').length; 
//alert(rowCount);
var clone = $('#attributes_clones>div.clone1').html();
if(rowCount < 5){                           // limit the user from creating fields more than your limits
    $(table).append('<div class="">'+clone+'</div>');
    $('#attributes_clones>div:last-child').addClass('clone'+(rowCount+1));
    
}else{
     alert("Maximum Entry is 5.");
           
}
createname();
}

$('body').on('click','.dlete_row', function(){
$(this).parent().remove();
var k = 0;
$('#attributes_clones>div').each(function(){ 
        k++;
       $(this).attr('class','clone'+k);
});
createname();
});
</script>
<script>
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
</script>
@endsection  