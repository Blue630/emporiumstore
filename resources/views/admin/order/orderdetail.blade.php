 @extends('admin.layout.layout')
 @section('content')
@php
use App\Category;
use App\Subcategory;
use App\additional;

@endphp
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">View Order Details</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-body">
                                    <dl class="row">
                                        <h3 class="col-sm-12">Order Details</h3>
                                        <dt class="col-sm-2">Order ID</dt>
                                        <dd class="col-sm-10">{{$orderdetail->ouid}}</dd>
                                        <dt class="col-sm-2">Order status</dt>
                                        <dd class="col-sm-10">
                                        @if($orderdetail->ostatus ==1)         
                                        Pending
                                        @elseif($orderdetail->ostatus ==2) 
                                        Placed
                                        @else
                                        Failed   
                                        @endif        
                                       </dd>
                                        <dt class="col-sm-2">Payment status</dt>
                                        <dd class="col-sm-10">
                                        @if(!empty($orderdetail->payment_id))         
                                        Paid
                                        @else
                                        Unpaid   
                                        @endif         
                                        </dd>
                                        <dt class="col-sm-2">Order Date</dt>
                                        <dd class="col-sm-10">{{$orderdetail->ocreated_at}}</dd>
                                        <div class="clearfix"></div>
                                    </dl>
@php
foreach($orders as $key=>$order){
$key++;
@endphp
<hr>
<h3 class="col-sm-12 text-center" ><u>Product {{$key}}</u></h3>

                                        <dl class="row">
                                        <h3 class="col-sm-12">Seller Details</h3>
                                        <dt class="col-sm-2">Seller ID</dt>
                                        <dd class="col-sm-10">{{$order->su_id}}</dd>
                                        <dt class="col-sm-2">Seller Name</dt>
                                        <dd class="col-sm-10">{{$order->reg_business_name}}</dd>
                                       
                                        <div class="clearfix"></div>
                                    </dl>

                                    <dl class="row">
                                        <h3 class="col-sm-12">Product Details</h3>
                                        <dt class="col-sm-2">Product Name</dt>
                                        <dd class="col-sm-10">{{$order->pname}}</dd>
@php 
$category_data = Category::getproduct_category($order->catid);
$subcategory_data = Subcategory::getproduct_subcategory($order->subcat_id);
@endphp
                                        <dt class="col-sm-2">Category</dt>
                                        <dd class="col-sm-10">{{$category_data->catname}}</dd>
                                        <?php
                                        if(!empty($subcategory_data))
                                        {
                                        ?>              
                                        <dt class="col-sm-2">Sub Category</dt>
                                        <dd class="col-sm-10">{{$subcategory_data->name}}</dd>
                                        <?php
                                        }
                                        else
                                        {
                                            $subcategory_data = '';
                                        }
                                        ?>
                                        <dt class="col-sm-2">Short Description</dt>
                                        <dd class="col-sm-10">{{strip_tags($order->short_desc)}}</dd>

                                        <dt class="col-sm-2">Description</dt>
                                        <dd class="col-sm-10">{{strip_tags($order->description)}}</dd>
                                        <div class="clearfix"></div>
                                    </dl>
                                    <dl class="row">
                                        <h3 class="col-sm-12">Specifications</h3>
@php 
$specs_arr = unserialize($order->spec_detail);
$price = $specs_arr['vprice'];
unset($specs_arr['vprice']);
foreach($specs_arr as $key=>$specs){
if($key != 'variant_id'){
@endphp
                                        <dt class="col-sm-2">{{$key}}</dt>
                                        <dd class="col-sm-10">{{$specs}}</dd>
@php 
}
}
@endphp
                                        <dt class="col-sm-2">Product Images</dt>
                                        <dd class="col-sm-10">
                                            <ul class="list-unstyled list-images">
@php 
$images = additional::getProductImages($order->variant_id)->toArray();

foreach($images as $image){
    $pimage = $image["product_image"];
@endphp                        
                       
                                                <li><a href="{{asset('public/product_image')}}/{{$pimage}}" target="_blank"><img src="{{asset('public/product_image')}}/{{$pimage}}" class="border border-dark product-varient-img" alt="" style="width: 200px;"></a></li>
@php 
}
@endphp                                             
                                            </ul>
                                            <div class="clearfix"></div>
                                    </dl>
                                    
                        @php } @endphp            
                                    
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-default">
                                <div class="card-body">
                                    <dl class="row">
                                        <h3 class="col-sm-12">Buyer Details</h3>
                                        <dt class="col-sm-2">Name</dt>
                                        <dd class="col-sm-10">{{$orderdetail->bname}}</dd>
                                        <!--<dt class="col-sm-2">Message</dt>-->
                                        <!--<dd class="col-sm-10"><a href="#" data-toggle="modal" data-target="#modal-default"><i class="far fa-comments"></i></a></dd>-->
                                        <dt class="col-sm-2">Address</dt>
                                        <dd class="col-sm-10">{{$orderdetail->baddress}}</dd>
                                        <div class="clearfix"></div>
                                    </dl>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-body">
                                    <dl class="row">
                                        <h3 class="col-sm-12">Billing Details</h3>
                                        @if($orderdetail->discount !=0)           
                                        <dt class="col-sm-2">Discount</dt>
                                        <dd class="col-sm-10">{{$orderdetail->discount}}%</dd>
                                        @endif
                                        @if($orderdetail->cashback !=0)           
                                        <dt class="col-sm-2">Cashback</dt>
                                        <dd class="col-sm-10">£{{$orderdetail->cashback}}</dd>
                                        @endif
                                        <dt class="col-sm-2">Amount</dt>
                                        <dd class="col-sm-10">£{{$price}}</dd>
                                        <div class="clearfix"></div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
  