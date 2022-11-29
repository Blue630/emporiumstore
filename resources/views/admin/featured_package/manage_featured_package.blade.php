@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Manage Featured Package</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<!--<li class="breadcrumb-item"><a href="{{url('/admin/add_featured_package')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add New</a></li>-->
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
<th>Price</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@php 
$srn=1;
@endphp
@if($featured_package)
@foreach($featured_package as $allfeatured_package)
<tr>
<td>{{$srn}}</td>
<td>{{$allfeatured_package->price}}</td>
<td>
<?php
if($allfeatured_package->status==1)
{
?>
<a href="{{url('/admin/inactivefeatured_package')}}/{{$allfeatured_package->id}}">Active</a>
<?php
}
else
{
?>
<a href="{{url('/admin/activefeatured_package')}}/{{$allfeatured_package->id}}">InActive</a>
<?php
}
?>
</td>
<td><a href="{{url('/admin/edit_featured_package')}}/{{$allfeatured_package->id}}">Edit</a></td>
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
@stop @endsection