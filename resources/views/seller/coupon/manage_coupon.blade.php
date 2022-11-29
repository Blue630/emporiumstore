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
                <!--<form name="sortbyfrm" id="sortbyfrm" method="get" action="{{url('seller/managecoupon')}}">
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
                </form>--><br>
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Percent</th>
                                <th>Start Date</th>
                                <th>End Date</th>
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
                                <td>{{$allcoupon->name}}</td>
                                <td>{{$allcoupon->code}}</td>
                                <td>{{$allcoupon->percent}}</td>
                                <td>{{$allcoupon->start_date}}</td>
                                <td>{{$allcoupon->end_date}}</td>
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
@stop @endsection