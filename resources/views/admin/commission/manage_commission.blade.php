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
        <h1 class="m-0">Manage Commission</h1>
    </div>
    <!-- /.col -->
    <!-- <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{url('/admin/addcommission')}}" class="btn btn-block btn-primary">Add Commission</a>
        </ol>
    </div> -->
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
                                <th>Commission(%)</th>
                                <th>Subscription Commission(%)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $srn=1;
                            @endphp
                            @if($commission)
                            @foreach($commission as $allcommission)
                            <tr>
                                <td>{{$srn}}</td>
                                <td>{{$allcommission->commission}}</td>
                                <td>{{$allcommission->subscription_commission}}</td>
                                <td>
                                    <?php
                                    if($allcommission->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/admin/inactivecommission')}}/{{$allcommission->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/admin/activecommission')}}/{{$allcommission->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{url('/admin/editcommission')}}/{{$allcommission->id}}">Edit</a>
                                </td>
                            </tr>
                            @php $srn++ @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $commission->links() !!}
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
                document.location.href = '{{url("/admin/inactivecommission")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
@stop @endsection