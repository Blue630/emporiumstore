@extends('admin.layout.layout') @section('content')
@php
use App\Product;
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
        <h1 class="m-0">Manage Auction</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <!--<ol class="breadcrumb float-sm-right">
            <a href="{{url('/admin/addauction')}}" class="btn btn-block btn-primary">Add Auction</a>
        </ol>-->
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
                <form name="sortbyfrm" id="sortbyfrm" method="get" action="{{url('admin/manageauction')}}">
                <div class="row">
                <div class="col-sm-3 sortby">
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
                <div class="col-sm-4 date-pickme" style="margin-left:65px;">
                <div class="flt-lft">
                <label class="d-flex align-items-center">Date:
                <div class="input-group ml-2">
                <input type="date" name="date" class="form-control float-right">
                </div>
                </label>
                </div>
                </div>
                <div class="col-sm-3 search-ord">
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Search..">
                </div>
                <div class="col-sm-1">
                <button type="submit" class="btn btn-block btn-primary">Go!</button>
                </div>
                </div>
                </form>
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product Name</th>
                                <th>Minimum Cost</th>
                                <th>Auction Expiration</th>
                                <!--<th>Auto Close</th>-->
                                <!--<th>Status</th>
                                <th>Action</th>-->
                                 <th>Bid Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $srn=1;
                            @endphp
                            @if($auction)
                            @foreach($auction as $allauction)
                            @php
                            $product=App\Product::getproduct($allauction->product_id);
                            if($product!='')
                            {
                            $productname=$product->name;
                            }
                            else
                            {
                            $productname="";
                            }
                            @endphp
                            <tr>
                                <td>{{$srn}}</td>
                                <td>{{$productname}}</td>
                                <td>{{$allauction->minimum_cost}}</td>
                                <td>{{$allauction->auction_time}}</td>

                                <!--<td>
                                    <?php
                                    if($allauction->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/admin/inactiveauction')}}/{{$allauction->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/admin/activeauction')}}/{{$allauction->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>-->
                                <!--<td>
                                    <a href="{{url('/admin/editauction')}}/{{$allauction->id}}">Edit</a>
                                </td>-->
                                 <td>
                                    <a href="{{url('admin/bids')}}/{{$allauction->id}}"<i class="fas fa-arrow-circle-right" style="font-size: 24px;"></i></a>
                                </td>
                            </tr>
                            @php $srn++ @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $auction->links() !!}
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
@section('script')
<script>
    $(document).ready(function() {
        $('.delete_btn').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure want to delete ?')) {
                document.location.href = '{{url("/admin/deleteauction")}}' + '/' + id;
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