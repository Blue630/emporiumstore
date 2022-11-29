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
            <h1>Edit Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/manage_slider')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <form method="post" action="{{url('admin/edit_slider')}}/{{@$sliderdetail->id}}" enctype="multipart/form-data" onsubmit="onSubmit">
              @csrf
            <div class="row">              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Image</label>
                  <?php if($sliderdetail->image!="") 
                  { 
                  ?>
                  <img src="{{asset('public/slider')}}/{{$sliderdetail->image}}" height="100" width="120" alt="Slider Image">
                  <?php
                  }
                  ?>
                  <input type="file" class="form-control" name="image" id="image" value="<?php echo $sliderdetail->image;?>"/>[size:1220*446]
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                <label>URL</label>
                <input class="form-control" type="text" value="@if($sliderdetail){{$sliderdetail->url}}@endif" id="url" name="url" placeholder="URL">
                </div>
              </div>
            </div>
            <div class="">
                  <button type="submit" class="btn_submit btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
<script>
function onSubmit() {
  $('.btn_submit').attr('disabled', true);
}
</script>
@endsection
  