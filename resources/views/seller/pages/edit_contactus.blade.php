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
            <h1>Edit {{$contactusdetail->page_name}}</h1>
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




 <table id="example1" class="table table-bordered table-striped">
     <thead>
   <tr>
     <th>S.No</th>
     <th>Content</th>
     <th>Action</th>
     </tr>
     </thead>
   <tbody>
    
         @php 
$contents = page_content::getPageContent($contactusdetail->id);
$i=1;
foreach($contents as $content){
@endphp
 <tr>
         <td>{{$i}}</td>
         <td>{{$content->heading}}</td>
         <td><a href="{{url('/admin/edit_content')}}/{{$content->id}}">Edit</a></td>
          </tr>
         @php
$i++;
}
@endphp
    
   </tbody>
     
 </table>

              </div>

            </div>
          
           
          </div>

        </div>

      </div>
    </section>

  </div>
<script>
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'description2' );
CKEDITOR.replace( 'description3' );
</script>
@endsection
  