@extends('admin.layout.layout')
@section('content')
<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subscription Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/seller/managesubscription')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-body">
            @if($msg=Session::get('success'))
            <div class="alert alert-success">{{$msg}}</div>
            @endif
            <form method="post" action="{{url('admin/editsubscription')}}/{{$subscriptiondetail->id}}" enctype="multipart/form-data">
              @csrf
            <div class="content">
            <div class="container-fluid">
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Subscription</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="@if($subscriptiondetail){{$subscriptiondetail->plan_name}}@endif" id="plan_name" name="plan_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Duration(In Month)</label>
                            <input type="number" min="1" value="@if($subscriptiondetail){{$subscriptiondetail->duration}}@endif" id="duration" name="duration" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Limit(Limit to sell product per month)</label>
                            <input type="number" value="@if($subscriptiondetail){{$subscriptiondetail->product_limit}}@endif" id="product_limit" name="product_limit" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="number" min="1" id="price" value="@if($subscriptiondetail){{$subscriptiondetail->price}}@endif" name="price" class="form-control" placeholder="Amount" required>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-12">
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection