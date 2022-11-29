@extends('admin.layout.layout')
@section('content')
@php
use App\Category;
@endphp
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Subcategory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/manage_subcat')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <div class="container">
            <?php
            if($errors->first('subcat')!="")
            {
            ?>
            <div class="alert alert-danger">{{$errors->first('subcat')}}</div>
            <?php
            }
            ?>
            </div>
            @if($msg=Session::get('success'))
            <div class="alert alert-success">{{$msg}}</div>
            @endif
            <form method="post" action="{{url('admin/add_subcat')}}" enctype="multipart/form-data" onsubmit="onSubmit()">
              @csrf
            <div class="row">
              
              
                <div class="col-md-12">
                <div class="form-group">
                  <label>Subcategory Name</label>
                  <input type="text" name="subcat" id="subcat" class="form-control" required>
                </div>
              </div>
              
              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Category</label>
                  <select type="text" name="cat" id="cat" class="form-control" required>
                      
@php 

$categories = Category::getCategories();
foreach($categories as $category){
@endphp

<option value="{{$category->id}}">{{$category->catname}}</option>
@php
}
@endphp
                      
                      
                      
                  </select>  
                </div>
              </div>
              
            

              <div class="col-md-12">
                <div class="form-group">
                  <label>Subcategory Image</label>
                  <input type="file" class="form-control" name="subcatimg" id="subcatimg" required/>
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