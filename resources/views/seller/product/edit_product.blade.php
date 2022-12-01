<?php
error_reporting(0);
?>
@extends('admin.layout.layout')
 @section('content')
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
  <!-- Content Wrapper. Contains page content -->
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
                   //alert(data); //return false;
                   $('#spec_id').html(data);
                }
        }); 
    });
});
</script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/seller/manageproduct')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-body">
            @if($msg=Session::get('success'))
            <div class="alert alert-success">{{$msg}}</div>
            @endif
            <form method="post" action="{{url('seller/editproduct')}}/{{$productdetail->id}}" enctype="multipart/form-data" onsubmit="onSubmit()">
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
                            <option value="{{$allcate->id}}" @if($productdetail->catid==$allcate->id){{"selected"}}@endif>{{$allcate->catname}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Categories</label>
                            <select id="subcat_id" style="width: 100%;" name="subcat_id" class="form-control">
                                <option value="" >Select Category first</option>
                                @if($subcate)
                                @foreach($subcate as $allsubcate)
                                <option value="{{$allsubcate->id}}" @if($productdetail->subcat_id==$allsubcate->id){{"selected"}}@endif>{{$allsubcate->name}}</option>
                                @endforeach
                                @endif
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
                            <input type="text" id="name" name="name" value="@if($productdetail){{$productdetail->name}}@endif" class="form-control">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Number of available quantities.</label>
                            <input type="number" min="1" id="quantity" name="quantity" value="@if($productdetail){{$productdetail->quantity}}@endif" class="form-control" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" min="0.1" step="0.01" value="@if($productdetail){{$productdetail->price}}@endif" id="price" name="price" class="form-control" placeholder="Price">
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Discount <small>(leave empty if no discount)</small></label>
                            <div class="input-group mb-3">
                                <input type="number" value="@if($productdetail){{$productdetail->discount}}@endif" min="0.01" step="0.01" id="discount" name="discount" class="form-control" placeholder="Discount">
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

                            <option value="{{$discount_code_result->id}}" @if($productdetail->discount_code_id==$discount_code_result->id){{"selected"}}@endif>{{$discount_code_result->code}}({{$discount_code_result->percent}}%)</option>

                            <?php
                            }
                            ?>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product SKU Code</label>
                            <div class="input-group mb-3">
                                <input type="text" value="@if($productdetail){{$productdetail->product_code}}@endif" id="product_code" name="product_code" class="form-control" placeholder="SKU" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Delivery Area Postcode</label>
                            <?php
                            $zipcode_id = explode(',',$productdetail->zipcode);
                            ?>
                            <select name="zipcode[]" id="zipcode" class="form-control" multiple required>
                            <option value="">Select Postal Code</option>
                            @if($postal_code)
                              @foreach($postal_code as $allpostal_code)
                                <option <?php
if(in_array($allpostal_code->id, $zipcode_id))
{
echo 'selected';
}
?> value="{{$allpostal_code->id}}" >{{$allpostal_code->zipcode}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Main Image</label>
                            <div class="input-group mb-3">
                                <?php
                                if($productdetail->image!="")
                                {
                                ?>
                                <img src="{{asset('public/products')}}/{{$productdetail->image}}" height="100" width="120" alt="Product Image">
                                <?php
                                }
                                ?>
                                <input type="file" id="proimage" name="proimage" class="form-control" placeholder="Image">&nbsp;&nbsp;<span style="color:red">[SIZE: 240*240]</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Short Description</label>
                            <div class="card-body p-0">
                                <textarea id="short_desc" class="form-control ckeditor" name="short_desc" > @if($productdetail){{$productdetail->short_desc}}@endif
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <div class="card-body p-0">
                                <textarea id="description" class="form-control ckeditor" name="description">
                                  @if($productdetail){{$productdetail->description}}@endif
                                </textarea>
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
                        <label>Attributes</label>
                        <div id="attributes_clones">
                        <?php
                        $a = 0 ;
                        //$vpriceArr = '';
                        $product_id = $productdetail->id;
                        $parent_id = $productdetail->catid;
                        
                        $productvariantdata=DB::table('product_detail')->where('product_id',$product_id)->get();
                        $recodCount = count($productvariantdata);
                        if($recodCount>0)
                        {
                        foreach ($productvariantdata as $key => $val ) {
                            $a++;
                            $variant_id = $val->id;
                            $spec_detail = $val->spec_detail;
                            $new_unseriealized_array = unserialize($spec_detail);

                            //$productspecdata=DB::table('specifications')->where('cat_id',$parent_id)->get();
                            $productspecdata = DB::table('specifications')
                            ->select('*')
                            ->whereRaw('FIND_IN_SET('.$parent_id.',cat_id)')
                            ->get();
                            foreach ($productspecdata as $specvalue) {
                            $spec_slug = $specvalue->slug;
                            $newArr = $new_unseriealized_array[$spec_slug];
                            $vpriceArr = $new_unseriealized_array['vprice'];
                        }//die;
                        ?>
                        <div class="clone<?php echo $a;?>"> 
                        <hr>
                        <div class="dlete_row"><a href="#" onclick="if(confirm('Are you sure want to delete?')){ document.location.href='{{url('/seller/deletevariant')}}/<?php echo $variant_id;?>/<?php echo $product_id; ?>'} else{return false;}">x</a></div>
                        <?php
                        $specdata = DB::table('specifications')
                        ->select('*')
                        ->whereRaw('FIND_IN_SET('.$parent_id.',cat_id)')
                        ->get();
                        if(!empty($specdata))
                        {
                            foreach ($specdata as $value) {
                                $specs_id = $value->id;
                                $specs_slug = $value->slug;
                                $optiondata=DB::table('options')->where('specs_id',$specs_id)->get();
                                if(!empty($optiondata))
                                {
                                ?>
                                <div class="row clearfix">
                                    <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                                        <?php echo $value->name;?></label>
                                    <div class="col-8">
                                        <select name="var[<?php echo $a;?>][<?php echo $value->slug;?>]" data-attr="<?php echo $value->slug;?>" class="form-control" required>
                                            <option value="">--Select <?php echo $value->name;?>--</option>
                                            <?php
                                            foreach($optiondata as $optionvalue)
                                            {
                                            ?>
                                            <option value="<?php echo $optionvalue->name;?>" @if($new_unseriealized_array[$specs_slug]==$optionvalue->name){{"selected"}}@endif><?php echo $optionvalue->name;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                }
                            }
                        }

                        ?>
                        <script>
                        $(document).ready(function() {
                        $("#attributes_clones select").change(function(){
                        var getVal = $(this).val();

                        if(getVal!=null){
                        $("#attributes_clones select").removeAttr('required');   
                        $(this).attr('required',true); 
                        }
                       
                        else
                        {
                        alert('empty');
                        $("#attributes_clones select").each(function(){
                        $(this).attr('required',true);
                        });   
                        }
                        if(!getVal)
                        {
                        alert('empty');
                        $("#attributes_clones select").each(function(){
                        $(this).attr('required',true);
                        });              
                        }
                        });
                        });
                        </script>
                        <div class="row clearfix">
                        <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                                Price</label>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">£</span>
                                    </div>
                                    <input type="text" data-attr="vprice" value="<?php echo $vpriceArr;?>" name="var[<?php echo $a;?>][vprice]" class="form-control" placeholder="Price">
                                    <input type="hidden" data-attr="variant_id" name="var[<?php echo $a;?>][variant_id]" value="<?php echo $variant_id;?>">
                                </div>
                            </div>
                        </div>
                        <label for="<?php echo $value->name;?>" class="col-4 font-weight-normal mb-4">
                                Gallery Image</label>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="file" data-attr="product_image" name="product_image[<?php echo $a;?>][]" class="form-control" multiple>
                                </div>
                            </div>
                            <div class="form-group img_sets">
                                <div class="input-group mb-3 d-flex">                                    
                                    <?php
                                    $productimagedata=DB::table('additional')->where([['product_id', '=', $product_id],
                                        ['option_id', '=', $variant_id]])->get();
                                    if($productimagedata!="")
                                    {
                                    foreach ($productimagedata as $imagevalue) {                                    
                                    ?>
                                    <div>
                                    <img src="{{asset('public/product_image')}}/{{$imagevalue->product_image}}" height="100" width="120" alt="Product Image">
                                    <!-- <a href="#" class="delete_btn" data-attr="{{$product_id}}" id="{{$imagevalue->id}}">X</a> -->
                                    <a href="#" onclick="if(confirm('Are you sure want to delete?')){ document.location.href='{{url('/seller/deleteadditional')}}/<?php echo $imagevalue->id;?>/<?php echo $product_id; ?>'} else{return false;}">X</a>
                                     </div>
                                    <?php
                                    }
                                    }
                                    else
                                    {
                                    ?>
                                    <h2>No Gallery Image Found</h2>
                                    <?php
                                    }
                                    ?>
                               
                                </div>
                            </div>


                        </div> 
                        
                        </div>
                        </div>                   
                        <?php
                        }
                        ?>
                        </div>
                        <input type="button" value="Add More" onClick="addRow()" />
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.col -->
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
                <h3 class="card-title">SEO Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" id="meta_title" value="@if($productdetail){{$productdetail->meta_title}}@endif" name="meta_title" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            <input type="text" id="meta_keyword" value="@if($productdetail){{$productdetail->meta_keyword}}@endif" name="meta_keyword" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea id="meta_description" class="form-control" name="meta_description">@if($productdetail){{$productdetail->meta_description}}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn_submit btn btn-primary">Submit</button>
                </div>
            </div>
            </div>
            </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
<script>
    /*$(document).ready(function() {
        $('.delete_btn').click(function() {
            var product_id = $(this).attr('data-attr');
            var id = $(this).attr('id');
            if (confirm('Are you sure want to delete ?')) {
                document.location.href = '{{url("/seller/deleteadditional")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });*/
</script>

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
.img_sets>div a {
    position: absolute;
    background: #000;
    color: #fff;
    /* padding: 10px; */
    border-radius: 50%;
    width: 18px;
    height: 18px;
    text-align: center;
    font-size: 12px;
}
.img_sets>div {
    gap: 22px;
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

$('#attributes_clones>div:last-child input').val('');
$('#attributes_clones>div:last-child select').val($("#attributes_clones>div:last-child select option:first").val());
$('#attributes_clones>div:last-child .img_sets').remove();

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