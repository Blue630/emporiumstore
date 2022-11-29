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
        <h1 class="m-0">Manage Subscription</h1>
    </div>
    <!-- /.col -->
    <!--<div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{url('/admin/addsubscription')}}" class="btn btn-block btn-primary">Add Subscription</a>
        </ol>
    </div>-->
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
                <form name="sortbyfrm" id="sortbyfrm" method="get" action="{{url('admin/managesubscription')}}">
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
                                <th>Name</th>
                                <th>Amount</th>
                                <th>No Of Products</th>
                                <th>No Of Month</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $srn=1;
                            @endphp
                            @if($subscription)
                            @foreach($subscription as $allsubscription)
                            <tr>
                                <td>{{$srn}}</td>
                                <td>{{$allsubscription->plan_name}}</td>
                                <td>{{$allsubscription->price}}</td>
                                <?php
                                if($allsubscription->product_limit==0)
                                {
                                ?>
                                <td>Unlimited</td>
                                <?php
                                }
                                else
                                {
                                ?>
                                <td>{{$allsubscription->product_limit}}</td>
                                <?php
                                }
                                ?>

                                <td>{{$allsubscription->duration}}</td>
                                <td>
                                    <?php
                                    if($allsubscription->status==1)
                                    {
                                    ?>
                                    <a href="{{url('/admin/inactivesubscription')}}/{{$allsubscription->id}}">Active</a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="{{url('/admin/activesubscription')}}/{{$allsubscription->id}}">InActive</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{url('/admin/editsubscription')}}/{{$allsubscription->id}}">Edit</a><!--&nbsp; <a href="#" class="delete_btn" id="{{$allsubscription->id}}">Delete</a>-->
                                </td>
                            </tr>
                            @php $srn++ @endphp
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                    {!! $subscription->links() !!}
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
                document.location.href = '{{url("/admin/inactivesubscription")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
@stop @endsection