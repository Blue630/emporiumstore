@extends('vendor.layout.layout') @section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/vendor/addproduct')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add New</a></li>
                        <li class="breadcrumb-item"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-upload">&nbsp;</i>Import Bulk Product</a></li>

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
                                <th>Status</th>
                                <th>Action</th>
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
                                <td>@if($allproduct->status==1){{"Available"}}@else {{"Sold"}}@endif</td>
                                <td><a href="{{url('/vendor/editproduct')}}/{{$allproduct->id}}">Edit</a></td>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>


                    </table>

                </div>

            </div>

        </div>
    </section>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Bulk of Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{url('/vendor/importcsvproduct')}}" enctype="multipart/form-data">
        @csrf
       
            <div class="form-group">
              <label>Browse Csv File</label>
            <input type="file" class="form-control" id="importcsv" name="importcsv" required accept="csv">
            </div>

            
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
     
    </div>
  </div>
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