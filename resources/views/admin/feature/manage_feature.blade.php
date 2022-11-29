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
        <h1 class="m-0">Featured Products</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
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
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Seller ID</th>
                                <th>Product</th>
                                <th>Featured Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $srn=1;
                            if($feature)
                            {
                            foreach($feature as $feature_res)
                            {
                            $seller_id = $feature_res->user_id;
                            $sellerfeaturedsub=DB::table('seller_featured_subscription')->where('seller_id',$seller_id)->orderBy('id','desc')->first();
                            $sellers=DB::table('users')->where('id',$seller_id)->orderBy('id','desc')->first();
                            $product_id = $feature_res->product_id;
                            $product=DB::table('products')->where('id',$product_id)->orderBy('id','desc')->first();
                            
                            ?>
                            <tr>
                                <td>{{$srn}}</td>
                                <td>{{$sellers->u_id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$sellerfeaturedsub->end_date}}</td>
                                
                            </tr>
                            <?php 
                            $srn++;
                            }
                            }
                            ?>
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $feature->links() !!}
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