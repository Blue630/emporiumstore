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
        <h1 class="m-0">Manage Cashback</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{url('/admin/addcashback')}}" class="btn btn-block btn-primary">Add Cashback</a>
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
                                <th>Category</th>
                                <th>Cashback(%)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $srn=1;
                            if($cashback)
                            {
                            foreach($cashback as $allcashback)
                            {
                            $catid = $allcashback->catid;
                            $category=DB::table('category')->where('id',$catid)->orderBy('id','desc')->first();
                            ?>
                            <tr>
                                <td>{{$srn}}</td>
                                <td>{{$category->catname}}</td>
                                <td>{{$allcashback->cashback}}</td>
                                <td>
                                    <?php
                                    if($allcashback->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/admin/inactivecashback')}}/{{$allcashback->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/admin/activecashback')}}/{{$allcashback->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{url('/admin/editcashback')}}/{{$allcashback->id}}">Edit</a>&nbsp; <a href="#" class="delete_btn" id="{{$allcashback->id}}">Delete</a>
                                </td>
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
                    {!! $cashback->links() !!}
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
                document.location.href = '{{url("/admin/deletecashback")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
@stop @endsection