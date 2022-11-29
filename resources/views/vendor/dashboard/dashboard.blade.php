 @extends('vendor.layout.layout')

 @section('content')
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Book VIP Number</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Book VIP Number</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <style>
        .homelogo {
            background: #fff;
            padding: 150px;
            text-align: center;
        }
    </style>
    <!-- /.content-header -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="homelogo">
                    <img src="{{asset('/public/front')}}/images/logo-1.png" alt="" />
                </div>
            </div>
        </div>
    </div>

  </div>
 
 @endsection