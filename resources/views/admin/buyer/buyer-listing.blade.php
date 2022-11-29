@extends('admin.layout.layout') @section('content')

   
   
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Buyers</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="post" action="{{url('/admin/buyers')}}">
                                @csrf
                                    <div class="row">
                                       
                                        <div class="col-sm-3 sortby">
                                            <div class="flt-lft">
                                                <label>Status
                        <select class="form-control" style="width:140px;" name="buyer_status">
                    <option selected="selected">--Select--</option>
                    <option value=1>Active</option>
                    <option value=0>Inactive</option>
                    </select>
                       </label>
                                            </div>
                                        </div>
                    <div class="col-sm-4 date-pickme">
                    <div class="flt-lft">
                    <!--<label class="d-flex align-items-center">Date: 
                    <div class="input-group date reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" name="date" data-target="#reservationdate"/>
                    <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    </div>-->

                    </label>

                    </div>
                    </div>
                                        <div class="col-sm-3 search-ord">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-block btn-primary">Go!</button>
                                        </div>

                                    </div>
                                    </form>
                                    <div class="">
                                        <table class="table table-bordered table-responsive"  style="font-size:14px;">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Buyer Id</th>
                                                    <th>Buyer Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No</th>
                                                    <th>Address</th>
                                                    <th>Postcode</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Buyer Details</th>
                                                    <!-- <th>Action</th> -->
                                                    </tr>
                                            </thead>
                                            <tbody>

@foreach($buyers as $key=>$buyer)
@php
$key++;
@endphp

                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td class="buyer_id">{{$buyer->uid}}</td>
                                                    <td>{{$buyer->name}}</td>
                                                    <td>{{$buyer->email}}</td>
                                                    <td>{{$buyer->phone}}</td>
                                                    <td>{{$buyer->address}}</td>
                                                    <td>{{$buyer->pincode}}</td>
                                                    <td>{{$buyer->ucreatedat}}</td>
                                                    <td style="width:160px;">
                                                    <select class="form-control w-100 active-drop">
                                                        
                    <option @if($buyer->bstatus == 1) selected @endif value="1">Active</option>
                    <option @if($buyer->bstatus == 0) selected @endif value="0">Inactive</option>
                    </select></td>
                    <td><i class="fa fa-list-alt show-buyer-popup" aria-hidden="true"></i></td>
                    <!-- <td><i class="fas fa-trash-alt delete-buyer"></i></td> -->
                                                   </tr>
@endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                        
                                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="table_page flt-rght">
                                            {{ $buyers->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <div class="modal fade show-slide-modal" id="showSlide" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
          
            <div class="modal-header"> 
              <h4 class="modal-title" id="exampleModalLongTitle" style="text-align:center">Buyer  Details <?php //echo $statetable;?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="buyer_details_div">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>


        </div>
        <script>

// buyer CHANGE STATUS
$('.active-drop').change(function(){
let formdata = new FormData();
let buyer_id = $(this).parent().parent().find(".buyer_id").text();
let status = $(this).val();

formdata.append("change_buyer_id",buyer_id);
formdata.append("change_status",status);
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
})

$.ajax({
type: "post",
url: "{{url('/admin/buyers')}}",
data:{"change_buyer_id":buyer_id,"change_status":status},
success: function(data){
    alert("Status Updated Successfully");
}
})
})


// buyer DETAILS POPUP
$('.show-buyer-popup').click(function(){
let buyer_id = $(this).parent().parent().find(".buyer_id").text();
    
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
})

$.ajax({
type: "post",
url: "{{url('/admin/buyer-details')}}",
data:{"buyer_id":buyer_id},
success: function(data){
document.querySelector("#buyer_details_div").innerHTML = data;
$("#showSlide").modal("show");
}
})
})

// DELETE buyer
$('.delete-buyer').click(function(){
let buyer_id = $(this).parent().parent().find(".buyer_id").text();

if (confirm('Are you sure you want to permanently delete this buyer ?')) {

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
})

$.ajax({
type: "post",
url: "{{url('/admin/buyers')}}",
data:{"delete_buyer_id":buyer_id},
success: function(data){
    location.reload();
}
})
}
})


</script>
@endsection
 