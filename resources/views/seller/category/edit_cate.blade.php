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
            <h1>Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/seller/manage_cate')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <form method="post" action="{{url('seller/edit_cate')}}/{{@$catedetail->id}}" enctype="multipart/form-data">
              @csrf
            <div class="row">
              
              <div class="col-md-12">

                <div class="form-group">
                  <label>Category</label>
                  <input type="text" name="catname" id="catname" class="form-control" value="@if($catedetail){{$catedetail->catname}}@endif">
                  {{ $errors->first('catname') }}
                </div>

                <div class="form-group">
                  <label>Category Image</label>
                  <?php if($catedetail->categoryimg!="") 
                  { 
                  ?>
                  <img src="{{asset('public/category')}}/{{$catedetail->categoryimg}}" height="100" width="120" alt="Category Image">
                  <?php
                  }
                  ?>
                  <input type="file" class="form-control" name="categoryimg" id="categoryimg" value="<?php echo $catedetail->categoryimg;?>"/>
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

  <!-- @section('script')
  <script>
    CKEDITOR.replace( 'details' );    
</script>
  @stop -->
@endsection
  