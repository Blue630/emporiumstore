@extends('admin.layout.layout') 
@section('content')
@php
use App\Product;
use App\Category;
use App\Subcategory;
use App\users;
use App\Review;
@endphp
<style type="text/css">
.btn.btn-warning{
border-radius: 50px;
font-weight: 700;
font-size: 13px;
}
table.table.table-bordered {
    font-size: 13px;
}
</style>
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
                <div class="col-sm-6 sortby">
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
                <div class="col-sm-6 sortby">
                <div class="flt-lft">
                <label>Filter by:
                <select class="form-control w-100" name="sortbydeals" id="sortbydeals" onchange="javascript:document.getElementById('sortbyfrm').submit();">
                <option value="">Deals</option>
                <option value="1">Today's Deal</option>
                <option value="2">Weekly Deal</option>
                <option value="3">Monthly Deal</option>
                <option value="4">Seasonal Deal</option>
                <option value="5">Trending Product</option>
                </select>
                </label>
                </div>
                </div>
                <?php
                /*if(!empty($_GET))
                {
                ?>
                <div class="col-sm-6 sortby">
                <div class="flt-lft">
                <label>Filter by status:
                <select class="form-control w-100" name="sortbystatus" id="sortbystatus" onchange="javascript:document.getElementById('sortbyfrm').submit();">
                <option value="">Status</option>
                <option <?php if($_GET['sortbystatus']==1) { echo "selected"; } ?> value="1">Active</option>
                <option <?php if($_GET['sortbystatus']==0) { echo "selected"; } ?> value="0">InActive</option>
                </select>
                </label>
                </div>
                </div>
                <?php
                }
                else
                {*/
                ?>
                <div class="col-sm-6 sortby">
                <div class="flt-lft">
                <label>Filter by status:
                <select class="form-control w-100" name="sortbystatus" id="sortbystatus" onchange="javascript:document.getElementById('sortbyfrm').submit();">
                <option value="">Status</option>
                <option value="1">Active</option>
                <option value="0">InActive</option>
                </select>
                </label>
                </div>
                </div>
                <?php
                /*}*/
                ?>
                </div>
                <div class="row">
                <div class="col-sm-4 search-ord">
                <label>Search By:
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Search by product name..">
                </label>
                </div>
                <div class="col-sm-4">
                <button type="submit" class="btn btn-block btn-primary">Go!</button>
                </div>
                <div class="col-sm-2"></div>
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
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Reviews</th>
                                <th>Status</th>
                                <th style="width:90px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /*foreach ($product as $value) {
                                echo $image = $value->image;
                            }die;*/
                            ?>
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
                                <td>{{$categoryname}}</td>
                                <td>{{$subcategoryname}}</td>
                                <td>{{$allproduct->quantity}}</td>
                                <td>£{{$allproduct->price}}</td>
                                <td>
                                <a href="{{url('admin/product-rating')}}/{{$allproduct->pid}}">
                                @php
                                
                                $rating_data = Review::getRatingAverage($allproduct->pid);
                                
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
                                    if($allproduct->pstatus==1)
                                    {
                                    ?>
                                    <a href="{{url('/admin/inactiveproduct')}}/{{$allproduct->pid}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/admin/activeproduct')}}/{{$allproduct->pid}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a data-toggle="tooltip" title="Edit" href="{{url('/admin/editproduct')}}/{{$allproduct->pid}}"><i class='fa fa-edit'></i></a>&nbsp;&nbsp;
                                    <!--<a href="#" class="delete_btn" id="{{$allproduct->pid}}"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;-->  
                                    
                                    <a href="javascript:void(0)" title="Manage Featured" data-toggle="modal" data-target="#exampleModal{{$allproduct->pid}}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                                    
                                    <!--<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$allproduct->pid}}">Manage</button>-->
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $allproduct->pid;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Product ({{$allproduct->pname}})</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="get" action="{{url('admin/updateproduct')}}">
                                    <label>Today's Deal</label>
                                    <input type="checkbox" <?php echo ($allproduct->todaydeal == 1 ? ' checked' : ''); ?> id="todaydeal" value="1" name="todaydeal"><br>
                                    
                                    <label>Weekly Deals</label>
                                    <input type="checkbox" <?php echo ($allproduct->weeklydeal == 1 ? ' checked' : ''); ?> id="weeklydeal" value="1" name="weeklydeal"><br>
                                    
                                    <label>Deal of the Month</label>
                                    <input type="checkbox" <?php echo ($allproduct->monthlydeal == 1 ? ' checked' : ''); ?> id="monthlydeal" value="1" name="monthlydeal">
                                    <br>
                                    <label>Seasonal</label>
                                    <input type="checkbox" <?php echo ($allproduct->season == 1 ? ' checked' : ''); ?> id="season" value="1" name="season">
                                    <br>
                                    <label>Trending</label>
                                    <input type="checkbox" <?php echo ($allproduct->trending == 1 ? ' checked' : ''); ?> id="trending" value="1" name="trending"><br>
                                    <label>Featured</label>
                                    <input type="checkbox" <?php echo ($allproduct->is_admin_featured == 1 ? ' checked' : ''); ?> id="is_admin_featured" value="1" name="is_admin_featured"><br>
                                    <input type="hidden" id="id" name="id" value="<?php echo $allproduct->pid;?>">
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
@stop 
@endsection