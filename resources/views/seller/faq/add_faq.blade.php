@extends('admin.layout.layout')
@section('content')
@php
use App\Product;
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add FAQ</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/seller/dashboard')}}">Home</a></li>
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
<div class="container">
<?php
if($errors->first('question')!="")
{
?>
<div class="alert alert-danger">{{$errors->first('question')}}</div>
<?php
}
?>
</div>
@if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
@endif
<form method="post" action="{{url('seller/addfaq')}}" enctype="multipart/form-data" onsubmit="onSubmit()">
@csrf
<div class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">FAQ</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Name</label>
                            <select id="product_id" style="width: 100%;" name="product_id" class="form-control" required>
                                <option value="">Select Product</option>
                                <?php
                                $seller_id=auth()->user()->id;
                                $product = DB::table('products')->where('user_id',$seller_id)->orderBy('id','desc')->get();
                                if($product)
                                {
                                foreach($product as $allproduct)
                                {
                                ?>
                                <option value="{{$allproduct->id}}">{{$allproduct->name}}</option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Question</label>
                            <textarea id="question" class="form-control ckeditor" name="question"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea id="answer" class="form-control ckeditor" name="answer"></textarea>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn_submit btn btn-primary">Submit</button>
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
<script>
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
</script>
@endsection  