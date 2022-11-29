@extends('vendor.layout.layout')
 @section('content')
 <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Store Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @if(Session()->has('logged_vendor'))
            @php $vendorprofile=Session()->get('logged_vendor')->storeslug@endphp
          @endif
              <li class="breadcrumb-item"><a href="{{url('/vendor-profile')}}/{{$vendorprofile}}" class="btn btn-primary" target="_blank"><i class="fas fa-eye"></i>&nbsp;</i>View Store</a></li>
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
            <form method="post" action="{{url('vendor/storeupdate')}}" enctype="multipart/form-data">
              @csrf
            <div class="row">
              
              <div class="col-md-12">

                <div class="form-group">
                  <label>Store Information</label>
                  <textarea name="storedetail" id="storedetail" cols="30" rows="10">@if($storedata){{ $storedata->storedetail }}@endif</textarea>
                </div>

              </div>

            </div>
            <div class="">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
           
          </div>

        </div>

      </div>
    </section>

  </div>

  @section('script')
  <script>
    CKEDITOR.replace( 'storedetail' );    
</script>
  @stop
@endsection
  