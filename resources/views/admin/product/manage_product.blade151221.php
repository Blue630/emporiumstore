@extends('admin.layout.layout') @section('content')
@php
use App\Product;
use App\Category;
use App\Subcategory;
use App\users;
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Manage Products</h1>
    </div>
    <!-- /.col -->
  
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
                <form name="sortbyfrm" id="sortbyfrm" method="get" action="{{url('admin/manageproduct')}}">
                <div class="row">
                <div class="col-sm-5 sortby">
                <div class="flt-lft">
                <label>Filter by:
                <select class="form-control w-100" name="sortbycategoryid" id="sortbycategoryid" onchange="javascript:document.getElementById('sortbyfrm').submit();">
                <option value="">Category</option>
                @if($cate)
                @foreach($cate as $allcate)
                <option value="{{$allcate->id}}" >{{$allcate->catname}}</option>
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
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Search by product name..">
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
                                <th>Seller Id</th>
                                <th>Seller Name</th>
                                <th>Product Name</th>
                                <th>Thumnbail</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Reviews</th>
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
                            $seller_details=users::getUserDetails($allproduct->user_id);
                            @endphp
                            <tr>
                                <td>{{$srn}}</td>
                                <td>{{$seller_details->u_id}}</td>
                                <td>{{$seller_details->name}}</td>
                                <td>{{$allproduct->pname}}</td>  
                                <td><img style="width:50px;" src="{{ asset('public/products/'.$allproduct->image) }}" alt="Product Image"></td>
                                <td>{{$categoryname}}</td>
                                <td>{{$subcategoryname}}</td>
                                <td>{{$allproduct->quantity}}</td>
                                <td>€{{$allproduct->price}}</td>
                                <td><a href="ratereviews.html"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></a></td>
                            </tr>
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
        <form method="post" action="{{url('/admin/importcsvproduct')}}" enctype="multipart/form-data">
        @csrf
       
            <div class="form-group">
              <label>Browse Csv File</label>
            <input type="file" class="form-control" id="importcsv" name="importcsv" required accept="csv">
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
                document.location.href = '{{url("/admin/deleteproduct")}}' + '/' + id;
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
</script>
@stop @endsection