@extends('admin.layout.layout') @section('content')
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
        <h1 class="m-0">Manage Discount Coupon</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{url('/admin/addcoupon')}}" class="btn btn-block btn-primary">Add Discount Coupon Code</a>
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
                <form name="sortbyfrm" id="sortbyfrm" method="get" action="{{url('admin/managecoupon')}}">
                <div class="row">
                <div class="col-sm-4 sortby">
                </div>
                <div class="col-sm-4 date-pickme">
                </div>
                <div class="col-sm-3 search-ord">
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Search..">
                </div>
                <div class="col-sm-1">
                <button type="submit" class="btn btn-block btn-primary">Go!</button>
                </div>
                </div>
                </form><br>
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Seller ID</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Percent</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $srn=1;
                            @endphp
                            @if($coupon)
                            @foreach($coupon as $allcoupon)
                            <tr>
                                <td>{{$srn}}</td>
                                <?php
                                $sellerdetail=DB::table('sellers')->where('user_id',$allcoupon->seller_id)->get();
                                foreach ($sellerdetail as $seller_detail_value) {
                                ?>
                                <td>{{$seller_detail_value->u_id}}</td>
                                <?php
                                }
                                ?>
                                <td>{{$allcoupon->name}}</td>
                                <td>{{$allcoupon->code}}</td>
                                <td>{{$allcoupon->percent}}</td>
                                <td>{{$allcoupon->start_date}}</td>
                                <td>{{$allcoupon->end_date}}</td>
                                <td>
                                    <?php
                                    if($allcoupon->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/admin/inactivecoupon')}}/{{$allcoupon->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/admin/activecoupon')}}/{{$allcoupon->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{url('/admin/editcoupon')}}/{{$allcoupon->id}}">Edit</a><!--&nbsp; <a href="#" class="delete_btn" id="{{$allcoupon->id}}">Delete</a>-->
                                </td>
                            </tr>
                            @php $srn++ @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $coupon->links() !!}
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
                document.location.href = '{{url("/admin/inactivecoupon")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
@stop @endsection