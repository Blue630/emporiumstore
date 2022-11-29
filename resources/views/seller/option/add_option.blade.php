@extends('admin.layout.layout')
@section('content')
@php
use App\Specification;
@endphp
 <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Option</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/manage_option')}}" class="btn btn-primary"><i class="fas fa-backward"></i>&nbsp;</i>Back</a></li>
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
            <form method="post" action="{{url('admin/add_option')}}" enctype="multipart/form-data">
              @csrf
            <div class="row">
              
              
                <div class="col-md-12">
                <div class="form-group">
                  <label>Option Name</label>
                  <input type="text" name="option" id="option" class="form-control" required>
                </div>
              </div>
              
              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Specification</label>
                  <select type="text" name="specs" id="specs" class="form-control" required>
                      
@php 

$specifications = Specification::getspecifications();
foreach($specifications as $specification){
@endphp

<option value="{{$specification->id}}">{{$specification->name}}</option>
@php
}
@endphp
                      
                      
                      
                  </select>  
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
  