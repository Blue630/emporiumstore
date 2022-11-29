@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Manage Slider</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="{{url('/admin/add_slider')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add New</a></li>
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
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>S.No.</th>
<th>Image</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@php 
$srn=1;
@endphp
@if($slider)
@foreach($slider as $allslider)
<tr>
<td>{{$srn}}</td>
<td><img style="width:50px;" src="{{ asset('public/slider/'.$allslider->image) }}" alt="Slider Image"></td>
<td>
<?php
if($allslider->status==1)
{
?>
<a href="{{url('/admin/inactiveslider')}}/{{$allslider->id}}">Active</a>
<?php
}
else
{
?>
<a href="{{url('/admin/activeslider')}}/{{$allslider->id}}">InActive</a>
<?php
}
?>
</td>
<td><a href="{{url('/admin/edit_slider')}}/{{$allslider->id}}">Edit</a> &nbsp; <a href="#" class="delete_btn" id="{{$allslider->id}}">Delete</a></td>
</tr>
@php $srn++ @endphp
@endforeach
@endif
</tbody>
</table>
</div>
</div>
</div>
</section>
</div>
@section('script')
<!-- page script -->
<script>
$(document).ready(function() {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
});
$(document).ready(function() {
$('#example1').DataTable();
});
</script>
<script>
$(document).ready(function() {
$('.delete_btn').click(function() {
var id = $(this).attr('id');
if (confirm('Are you sure want to delete ?')) {
document.location.href = '{{url("/admin/deleteslider")}}' + '/' + id;
} else {
return false;
}
});
});
</script>
@stop @endsection