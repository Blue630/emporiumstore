@extends('admin.layout.layout') @section('content')
@php
use App\Product;
use App\Category;
use App\Subcategory;
use App\Review;
@endphp
<!-- Content Wrapper. Contains page content -->
<style>
.content-header .breadcrumb {
margin-left: 20px;
}
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Manage Products</h1>
    </div>
</div>
        <div class="row">
        <div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
        <a style="width:220px;" href="{{url('/Import-product-sample-file.csv')}}" class="btn btn-primary"><i class="fa fa-download">&nbsp;</i> Download Prouct Sample</a>
        </ol>
        <ol class="breadcrumb float-sm-left">
        <a style="width:240px;" href="{{url('/postal.csv')}}" class="btn btn-primary"><i class="fa fa-download">&nbsp;</i> Download Postal Sample</a>
        </ol>
        </div>
        </div><br>
        <div class="row mb-2">
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-upload">&nbsp;</i>Import Bulk Product</a>
        </ol>
        <ol class="breadcrumb float-sm-right">
            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenterpostal"><i class="fa fa-upload">&nbsp;</i>Import Bulk Postal Code</a>
        </ol>
        
        <ol class="breadcrumb float-sm-right">
            <a href="{{url('/seller/addproduct')}}" class="btn btn-block btn-primary">Add Product</a>
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
        <div class="card">
                <div class="card-body">
                <form name="sortbyfrm" id="sortbyfrm" method="get" action="{{url('seller/manageproduct')}}">
                <div class="row">
                <div class="col-sm-5 sortby">
                <div class="flt-lft">
                <label>Filter by:
                <select class="form-control w-100" name="sortbycategoryid" id="sortbycategoryid" onchange="javascript:document.getElementById('sortbyfrm').submit();">
                <option value="">Category</option>
                <?php $cat_id = isset($_REQUEST['sortbycategoryid'])?$_REQUEST['sortbycategoryid']:"";?>
                @if($cate)
                @foreach($cate as $allcate)
                <option value="{{$allcate->id}}" @if($cat_id==$allcate->id){{"selected"}}@endif >{{$allcate->catname}}</option>
                @endforeach
                @endif
                </select>
                </label>
                </div>
                </div>
                <!--<div class="col-sm-4 date-pickme">
                <div class="flt-lft">
                <label class="d-flex align-items-center">Date Range:
                <div class="input-group ml-2">
                <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
                </span>
                </div>
                <input type="text" name="daterange" class="form-control float-right">
                </div>
                </label>
                </div>
                </div>-->
                <div class="col-sm-5 search-ord">
                <label>Search By:
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Search by product name.." required>
                </label>
                </div>
                <div class="col-sm-2">
                <button type="submit" class="btn btn-block btn-primary">Go!</button>
                </div>
                </div>
                </form>
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>SKU Code</th>
                                <th>Product Name</th>
                                <th>Thumnbail</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Reviews</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $srn=1;
                            @endphp
                            @if($product)
                            @foreach($product as $allproduct)
                            @php
                            $category=App\Category::getproduct_category($allproduct->catid);
                            if($category!='')
                            {
                            $categoryname=$category->catname;
                            }
                            else
                            {
                            $categoryname="";
                            }
                            $subcategory=App\Subcategory::getproduct_subcategory($allproduct->subcat_id);
                            if($subcategory!='')
                            {
                            $subcategoryname=$subcategory->name;
                            }
                            else
                            {
                            $subcategoryname="";
                            }
                            @endphp
                            <tr>
                                <td>{{$srn}}</td>
                                <td>{{$allproduct->product_code}}</td>
                                <td>{{$allproduct->name}}</td>
                                <td><img style="width:50px;" src="{{ asset('public/products/'.$allproduct->image) }}" alt="Product Image"></td>
                                <td>{{$categoryname}}</td>
                                <td>{{$subcategoryname}}</td>
                                <td>{{$allproduct->quantity}}</td>
                                <td>£{{$allproduct->price}}</td>
                                <td>
                                <a href="{{url('seller/product-rating')}}/{{$allproduct->id}}">
                                @php
                                $rating_data = Review::getRatingAverage($allproduct->id);
                                
                                @endphp
                                <div class="p_rating d-flex align-items-center gap-2">
                                <div class="ratingofprod">
                                <div class="ratinga2">
                                <div class="ratinga" data-value="{{number_format($rating_data['rating'],1)}}"></div>
                                </div>
                                </div>                  
                                </div>
                                </a>
                                </td>
                                <td>
                                    <?php
                                    if($allproduct->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/seller/inactiveproduct')}}/{{$allproduct->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/seller/activeproduct')}}/{{$allproduct->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a data-toggle="tooltip" title="Edit" href="{{url('/seller/editproduct')}}/{{$allproduct->id}}"><i class='fa fa-edit'></i></a>
                                    <?php
                                    $seller_id=auth()->user()->id;
                                    $featured = DB::table('sellers')->where(array('is_featured_seller'=>1,'user_id'=>$seller_id))->first();
                                    if(!empty($featured))
                                    {
                                    $is_featured_seller = $featured->is_featured_seller;
                                    $currentDate = date('Y-m-d');
                                    $whereRaw = 'seller_id="'.$seller_id.'" ORDER BY id DESC';
                                    $featured_subscription = DB::table('seller_featured_subscription')->whereRaw($whereRaw)->first();
                                    $end_date = $featured_subscription->end_date;
                                    if($end_date < $currentDate){
                                        $updatesellerSubscribeData=array(
                                        'is_featured_seller'=>0,
                                        );
                                        DB::table('sellers')->where(array('user_id'=>$seller_id))->update($updatesellerSubscribeData);
                                    }
                                    //$countfeaturedsubscription = count($featured_subscription);
                                    if($is_featured_seller==1)
                                    {
                                    ?>
                                    <a href="javascript:void(0)" data-toggle="modal" title="Manage Featured" data-target="#exampleModal{{$allproduct->id}}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                                    <?php
                                    }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $allproduct->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update as a featured product ({{$allproduct->name}})</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="get" action="{{url('seller/updatefeaturedproduct')}}">
                                    <label>Featured</label>
                                    <input type="checkbox" <?php echo ($allproduct->is_featured == 1 ? ' checked' : ''); ?> id="is_featured" value="1" name="is_featured">
                                    <br>
                                    <input type="hidden" id="id" name="id" value="<?php echo $allproduct->id;?>">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @php $srn++ @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $product->links() !!}
                    </div>
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
<div class="modal fade" id="exampleModalCenterpostal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitlepostal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Bulk of Postal Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{url('/seller/importcsvpostal')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Browse Csv File</label>
              <input type="file" class="form-control" id="importcsv" name="importcsv" required accept="csv" onchange="return fileValidation()">
            </div>            
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
     
    </div>
  </div>
</div>
<!---import bulk product-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Bulk of Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{url('/seller/importcsvproduct')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Browse Csv File</label>
            <input type="file" class="form-control" id="importcsv" name="importcsv" >
            </div>            
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
     
    </div>
  </div>
</div>
@section('script')

<!-- page script -->
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('.delete_btn').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure want to delete ?')) {
                document.location.href = '{{url("/seller/deleteproduct")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});




function fileValidation() {
    var fileInput = document.getElementById('importcsv');
    var filePath = fileInput.value;
    //alert(filePath);
    // Allowing file type
    var allowedExtensions = /(\.csv)$/i;
    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        //fileInput.value = '';
        //return false;
        location.reload();
    } 
}
</script>
@stop @endsection