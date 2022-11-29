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
            <h1>Edit Specification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/manage_specs')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <?php
            if($errors->first('specs')!="")
            {
            ?>
            <div class="alert alert-danger">{{$errors->first('specs')}}</div>
            <?php
            }
            ?>
            @if($msg=Session::get('success'))
            <div class="alert alert-success">{{$msg}}</div>
            @endif
            <form method="post" action="{{url('admin/edit_specs')}}/{{@$specsdetail->id}}" enctype="multipart/form-data" onsubmit="onSubmit()">
              @csrf
            <div class="row">
              
              <div class="col-md-12">


                <div class="form-group">
                  <label>Specification Name</label>
                  <input type="text" name="specs" id="specs" class="form-control" value="{{$specsdetail->name}}" required>
                </div>



                <div class="form-group">
                     <label>Category</label>
                    <select type="text" multiple name="cat[]" id="cat" class="form-control" required>
                    <?php
                    $cat_id = explode(',',$specsdetail->cat_id);
                    $categories = Category::getCategories();
                    foreach($categories as $category){
                    ?>
                    <option <?php if(in_array($category->id, $cat_id))
                    {
                        echo 'selected';
                    }
                    ?> value="{{$category->id}}">{{$category->catname}}</option>
                    <?php
                    }
                    ?>
                    </select>  
                  {{ $errors->first('name') }}
                </div>

                <div class="form-group">
                  <label>Specification Image</label><br>
                  <?php if($specsdetail->image!="") 
                  { 
                  ?>
                  <img src="{{asset('public/specifications')}}/{{$specsdetail->image}}" height="100" width="120" alt="Specification Image">
                  <?php
                  }
                  ?>
                  <input type="file" class="form-control" name="specsimg" id="specsimg" value="<?php echo $specsdetail->image;?>"/>
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
  