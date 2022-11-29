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
            <h1>Edit {{$aboutusdetail->page_name}}</h1>
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
            <form method="post" action="{{url('admin')}}/{{$aboutusdetail->page_url}}/{{@$aboutusdetail->id}}" enctype="multipart/form-data">
              @csrf
            <div class="row">
              
              <div class="col-md-12">


                <div class="form-group">
                  <label>Page Name</label>
                  <input type="text" name="page_name" id="page_name" class="form-control" value="{{$aboutusdetail->page_name}}">
                </div>

            <div class="form-group">
            <label>Banner Image</label><br>
            <?php if($aboutusdetail->banner_image!="") 
            { 
            ?>
            <img src="{{asset('public/pages')}}/{{$aboutusdetail->banner_image}}" height="100" width="120" alt="Banner Image">
            <?php
            }
            ?>
            <input type="file" class="form-control" name="banner_image" id="banner_image" value="<?php echo $aboutusdetail->banner_image;?>"/>
            </div>
            
            
            <div class="form-group">
            <label>About Emporium</label>
            <input type="text" name="heading" id="heading" class="form-control" value="{{$aboutusdetail->heading}}">
            </div>
            
            
            <div class="form-group">
            <label>About Content</label>
            <textarea name="content" class="form-control" id="content">{{$aboutusdetail->content}}</textarea>
            </div>

            <div class="form-group">
            <label>About Content</label>
            <textarea name="short_desc" class="form-control ckeditor" id="short_desc">{{$aboutusdetail->short_desc}}</textarea>
            </div>
            
             <div class="form-group">
            <label>Our History</label>
            <input type="text" name="heading2" id="heading2" class="form-control" value="{{$aboutusdetail->heading2}}">
            </div>
            
              <div class="form-group">
            <label>History Image</label><br>
            <?php if($aboutusdetail->heading2_image!="") 
            { 
            ?>
            <img src="{{asset('public/pages')}}/{{$aboutusdetail->heading2_image}}" height="100" width="120" alt="History Image">
            <?php
            }
            ?>
            <input type="file" class="form-control" name="heading2_image" id="heading2_image" value="<?php echo $aboutusdetail->heading2_image;?>"/>
            </div>
            
            
            <div class="form-group">
            <label>Emporium Difference</label>
            <input type="text" name="heading3" id="heading3" class="form-control" value="{{$aboutusdetail->heading3}}">
            </div>
            
            
              <div class="form-group">
            <label>Emporium Difference Content</label>
            <textarea name="content2" class="form-control" id="content2">{{$aboutusdetail->content2}}</textarea>
            </div>

            <div class="form-group">
            <label>About Content</label>
            <textarea name="content6" class="form-control ckeditor" id="content6">{{$aboutusdetail->content6}}</textarea>
            </div>

            <div class="form-group">
            <label>About Content</label>
            <textarea name="content4" class="form-control ckeditor" id="content4">{{$aboutusdetail->content4}}</textarea>
            </div>

            <div class="form-group">
            <label>About Content</label>
            <textarea name="content5" class="form-control ckeditor" id="content5">{{$aboutusdetail->content5}}</textarea>
            </div>
            
            
              <div class="form-group">
            <label>Reward Heading</label>
            <input type="text" name="heading4" id="heading4" class="form-control" value="{{$aboutusdetail->heading4}}">
            </div>
            
            
            <div class="form-group">
            <label>Reward Content</label>
            <textarea name="content3" class="form-control" id="content3">{{$aboutusdetail->content3}}</textarea>
            </div>

            <div class="form-group">
            <label>Reward Content</label>
            <textarea name="content7" class="form-control ckeditor" id="content7">{{$aboutusdetail->content7}}</textarea>
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
<script>
CKEDITOR.replace( 'content' );
CKEDITOR.replace( 'content2' );
CKEDITOR.replace( 'content3' );
</script>
@endsection
  