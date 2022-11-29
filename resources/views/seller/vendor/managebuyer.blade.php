@extends('admin.layout.layout') @section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Buyer</h1>
                </div>
                @if($success=Session::get('success'))
                <div class="alert alert-success">{{$success}}</div>
                @endif
               
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/add_healthcare')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add New</a></li>

                    </ol>
                </div> -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Distributor</button></li>

                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
 
    <!-- Buyer ============================= -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
            <div class="alert alert-success"><b>Manage Buyer</b></div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php 
                            $srn=1;
                        @endphp
                           @if($buyer)
                                @foreach($buyer as $allvendor)
                                <tr>
                                <td>{{$srn}}</td>
                                <td>{{$allvendor->name}}</td>
                                <td>{{$allvendor->email}}</td>
                                <td>{{$allvendor->phone}}</td>
                                <td>{{date('d-m-Y',strtotime($allvendor->created_date))}}</td>
                                <td>
                                    <a href="{{url('admin/vendor-buyer-details')}}/{{$allvendor->id}}">View</a>
                                    <!-- <a href="{{url('admin/approvevendor')}}/{{$allvendor->id}}">Approve</a> -->
                                    <a href="#" id="{{$allvendor->id}}" class="delete_btn">Delete</a>
                                    <!-- <a href="{{url('admin/vendorproduct')}}/{{$allvendor->id}}" id="" >View Product</a> -->
                                </td>
                            </tr>
                            @php $srn++ @endphp
                                @endforeach
                           @endif
                            
                           
                            
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created</th>
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
        $('#example2').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('.delete_btn').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure want to delete ?')) {
                document.location.href = '{{url("/admin/deletevendor")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
<!-- The Modal -->
<div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Distributor</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form action="{{url('/vendor-register')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" required/>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" placeholder="Enter Phone" name="phone" id="phone" required> 
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirmpass" id="" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Store Name" name="storename" id="storename" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Address" name="address" id="address" required>
              </div>
              <div class="form-group">
                <input type="file" class="form-control" placeholder="Enter Aadhar Card"  name="adharcarimg" id="adharcarimg" required/>
              </div>
              <div class="form-group">
                <input type="file" class="form-control" placeholder="Enter Pan Card" name="pancardimg" id="pancardimg" required>
              </div>
              <input type="hidden" name="user_type" id="user_type" value="0">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@stop @endsection