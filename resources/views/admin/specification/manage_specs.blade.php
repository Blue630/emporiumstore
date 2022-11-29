@extends('admin.layout.layout') @section('content')
@php
use App\Category;
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Specification</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/add_specs')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add New</a></li>

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
                                <th>Specification</th>
                                <th>Category</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php 
                            $srn=1;
                        @endphp
                           @if($specification)
                                @foreach($specification as $allspecs)
                                <tr>
                                <td>{{$srn}}</td>
                                <td>{{$allspecs->name}}</td>
                                
                        @php 
                        $category_data = Category::getproduct_category($allspecs->cat_id);
                        if($category_data!='')
                        {
                        $category = $category_data->catname;
                        }
                        else
                        {
                        $category = '';
                        }
                        @endphp
                                <td>{{$category}}</td>
                                <td>{{date('d-m-Y',strtotime($allspecs->created_at))}}</td>
                                <td><a href="{{url('/admin/edit_specs')}}/{{$allspecs->id}}">Edit</a> &nbsp; 
                                <a href="{{url('/admin/deletespecs')}}/{{$allspecs->id}}" onclick="return confirm('Are you sure you want to delete?')" class="delete_btn" id="{{$allspecs->id}}">Delete</a></td>
                            </tr>
                            @php $srn++ @endphp
                                @endforeach
                           @endif
                            
                           
                            
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Specification</th>
                                <th>Category</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>


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
                document.location.href = '{{url("/admin/deletespecs")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
@stop @endsection