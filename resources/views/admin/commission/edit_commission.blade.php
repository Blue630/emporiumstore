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
            <h1>Edit Commission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/managecommission')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <form method="post" action="{{url('admin/editcommission')}}/{{$commissiondetail->id}}" enctype="multipart/form-data">
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
                            <input type="text" value="@if($commissiondetail){{$commissiondetail->commission}}@endif" id="commission" name="commission" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Subscription Commission(%)</label>
                            <input type="text" value="@if($commissiondetail){{$commissiondetail->subscription_commission}}@endif" id="subscription_commission" name="subscription_commission" class="form-control" required>
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