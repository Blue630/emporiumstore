@extends('admin.layout.layout')
@section('content')
 
@php
use App\page_content;
@endphp
 
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Content</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/manage_pages')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
           
            <div class="row">
              
              <div class="col-md-12">

 <form method="post" action="{{url('admin/edit_content')}}/{{@$content->id}}" enctype="multipart/form-data">
              @csrf

            <div class="form-group">
            <label>Icon</label><br>
            <?php if($content->image!="") 
            { 
            ?>
            <img src="{{asset('public/pages')}}/{{$content->image}}" height="100" width="120" alt="Icon Image">
            <?php
            }
            ?>
            <input type="file" class="form-control" name="image" id="image" value="<?php echo $content->image;?>"/>
            </div>
            
            
            <div class="form-group">
            <label>Heading</label>
            <input type="text" name="heading" id="heading" class="form-control" value="{{$content->heading}}">
            </div>
            
            
              <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" id="description">{{$content->description}}</textarea>
            </div>
            
             <div class="form-group">
            <label>Bottom Heading</label>
            <input type="text" name="bottom_heading" id="bottom_heading" class="form-control" value="{{$content->bottom_heading}}">
            </div>
            
              <div class="">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            

              </div>

            </div>
          
           
          </div>

        </div>

      </div>
    </section>

  </div>
<script>
CKEDITOR.replace( 'description' );
</script>
@endsection
  