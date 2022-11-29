@extends('admin.layout.layout') @section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendor Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/managevendor')}}" class="btn btn-primary"><i class="fa fa-backward">&nbsp;</i>Back</a></li>

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
                                <th>Category</th>
                                <th>Product</th>
                                <th>Created Date</th>
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                        @php 
                            $srn=1;
                        @endphp
                           @if($product)
                                @foreach($product as $allproduct)
                                
                                    @php
                                    $category=App\Category::getproduct_category($allproduct->catid);
                                    if($category!='')
                                    {
                                        $categoryname=$category->catname;
                                    }
                                    else
                                    {
                                        $categoryname="";
                                    }
                                    @endphp
                                <tr>
                                <td>{{$srn}}</td>
                                <td>{{$categoryname}}</td>
                                <td>{{$allproduct->productnumber}}</td>
                                <td>{{date('d-m-Y',strtotime($allproduct->created_at))}}</td>
                                <!--<td><a href="{{url('/admin/editproduct')}}/{{$allproduct->id}}">Edit</a></td>-->
                            </tr>
                            @php $srn++ @endphp
                                @endforeach
                           @endif
                            
                           
                            
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Created Date</th>
                                <!--<th>Action</th>-->
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
                document.location.href = '{{url("/admin/delete_healthcare")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
@stop @endsection