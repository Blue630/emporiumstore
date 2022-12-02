@extends('admin.layout.layout') @section('content')

<!-- Content Wrapper. Contains page content -->
<style>
.content-header .breadcrumb {
margin-left: 20px;
}
table thead th, table tbody td {
    overflow-wrap: anywhere;
}
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Manage FAQ</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{url('/seller/addfaq')}}" class="btn btn-block btn-primary">Add FAQ</a>
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
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product Name</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $srn=1;
                            @endphp
                            @if($faq)
                            @foreach($faq as $allfaq)
                            @php
                            $product=App\Product::getproduct($allfaq->product_id);
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
                                <td>{{strip_tags($allfaq->question)}}</td>
                                <td>{{strip_tags($allfaq->answer)}}</td>
                                <td>
                                    <?php
                                    if($allfaq->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/seller/inactivefaq')}}/{{$allfaq->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/seller/activefaq')}}/{{$allfaq->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{url('/seller/editfaq')}}/{{$allfaq->id}}">Edit</a>
                                </td>
                            </tr>
                            @php $srn++ @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $faq->links() !!}
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
                document.location.href = '{{url("/seller/deletefaq")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
@stop @endsection