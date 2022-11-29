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
            <h1>@if($vendordetail->user_type==1){{"Vendor"}} @endif @if($vendordetail->user_type==0){{"Buyer"}} @endif Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/managevendor')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <div class="row">
              <div class="col-md-12">
              Please make order detail layout page here
               </div>

            </div>
            @if($vendordetail)
              <p>Name: {{$vendordetail->name}}</p>
              <p>email: {{$vendordetail->email}}</p>
              <p>phone: {{$vendordetail->phone}}</p>
              <p>store: {{$vendordetail->storename}}</p>
              <p>address: {{$vendordetail->address}}</p>
              <p>createdate: {{$vendordetail->created_date}}</p>
              

              <img src="{{asset('public/vendor')}}/{{$vendordetail->adharcarimg}}" height="200" width="200" alt="Addhar card img">
              
              <img src="{{asset('public/vendor')}}/{{$vendordetail->pancardimg}}" height="200" width="200" alt="Pand card img">


            @endif
           
           
          </div>

        </div>

      </div>
    </section>

  </div>
  
@endsection
  