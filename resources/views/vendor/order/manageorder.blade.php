@extends('vendor.layout.layout') @section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Order</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/add_healthcare')}}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;</i>Add New</a></li>

                    </ol>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            @if($success=Session::get('success'))
    <div class="alert alert-primary">{{$success}}</div>
    @endif
            <div class="card card-default">
            <div class="alert alert-warning"><b>Manage Customer Orders</b></div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Payment Id</th>
                                <th>Order No.</th>
                                <th>Product</th>
                                 <th>Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php 
                            $srn=1;
                        @endphp
                           @if($order)
                                @foreach($order as $allorder)
                                <tr>
                                <td>{{$srn}}</td>
                                <td>{{$allorder->payment_id}}</td>
                                <td>{{$allorder->orderid}}</td>
                                <td>{{$allorder->productname}}</td>
                                <td>{{ucwords($allorder->first_name)}}&nbsp;{{ucwords($allorder->last_name)}}</td>
                                <td>@if($allorder->porting_status==0){{"Pending"}}@endif @if($allorder->porting_status==1){{"Success"}}@endif</td>
                                <td>{{date('d-m-Y',strtotime($allorder->created_at))}}</td>
                                <td>
                                 <a href="{{url('/vendor/manageorder/details')}}/{{$allorder->orderid}}">View Details</a> 
                                <a href="#" data-toggle="modal" data-target="#exampleModalCenter" class="portingcode" id="{{$allorder->id}}">Porting Code</a>
                                </td>
                                <input type="hidden" name="proname" id="proname_{{$allorder->id}}" value="{{$allorder->productname}}">
                                <input type="hidden" name="toemail" id="toemail_{{$allorder->id}}" value="{{$allorder->email}}">
                            </tr>
                            @php $srn++ @endphp
                                @endforeach
                           @endif
                            
                           
                            
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                 <th>S.No.</th>
                                <td>Payment Id</td>
                                <th>Order No.</th>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Status</th>
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
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Send Porting Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{url('/vendor/sendportingcode')}}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <label>Email To</label>
            <input type="text" class="form-control" id="sendto" name="sendto" required >
            </div>

            <div class="form-group">
              <label>Product Number</label>
            <input type="text" class="form-control" id="prodnumber" name="prodnumber" readonly>
            </div>
            <div class="form-group">
              <label>Porting Code</label>
            <input type="text" class="form-control" id="portingcode" name="portingcode" required>
            </div>

            <button type="submit" class="btn btn-primary">Send Code</button>
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
        $('#example2').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('.delete_btn').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure want to delete ?')) {
                document.location.href = '{{url("/admin/")}}' + '/' + id;
            } else {
                return false;
            }
        });
    });
</script>
<script>
$(document).ready(function(){
    $('.portingcode').click(function(){
        let id=$(this).attr('id');
        //alert(id);
        let proname=$('#proname_'+id).val();
        let toemail=$('#toemail_'+id).val();
        $('#prodnumber').val(proname);
        $('#sendto').val(toemail);
    });
});
</script>
@stop @endsection