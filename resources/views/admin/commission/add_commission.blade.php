@extends('admin.layout.layout')
@section('content')
<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<!-- Content Wrapper. Contains page content -->
<!-- Google Font: Source Sans Pro -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Commission</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<form method="post" action="{{url('admin/addcommission')}}" enctype="multipart/form-data">
@csrf
<div class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Commission</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Commission(%)</label>
                            <input type="number" min="1" id="commission" name="commission" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Subscription Commission(%)</label>
                            <input type="number" min="1" id="subscription_commission" name="subscription_commission" class="form-control" required>
                        </div>
                    </div>                    
                </div>
                <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
</form>
<!-- REQUIRED SCRIPTS -->
@endsection  