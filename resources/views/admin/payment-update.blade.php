@extends('admin/layout/layout')

@section('content')
 
 <style>
     .h6{
    font-size: 10px;
}
sup {
    top: 0px;
    left: 2px;
}
.small-box p {
    font-size: 14px;
}
td{
    padding: 0px 6px !important;
}
.payment-status{
    color:green;
}

            .payment_table tbody tr td {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .payment_table tbody tr div {
                position: relative;
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .payment_table tbody tr div .external_link {
                position: absolute;
                right: 0;
                color:#666565;
            }
      
 </style>
 
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <!-- Content Header (Page header) -->

                <div class="content-header">
    
                    <div class="container-fluid">
    
                        <div class="row mb-2">
    
                            <div class="col-sm-6">
    
                                <h1 class="m-0">Update Payment Detais</h1>
    
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

       <div class="container-fluid">
           @if($msg=Session::get('success'))
<div class="alert alert-success">{{$msg}}</div>
<script>setTimeout(function(){
    
window.location.href="{{url('admin/orders-detail')}}";
}, 1000);</script>
@endif
           <form method="post" action="{{url('admin/update-payment-details')}}">
               @csrf
        <div class="row">
<input type="hidden" name="id" value="{{$id}}">
<input type="hidden" name="type" value="{{$type}}">


            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label for="transaction_id">Transaction ID</label>
                    <input type="text" id="transaction_id" name="transaction_id" class="form-control" placeholder="Enter Transaction ID" required>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" class="form-control" id="payment_status">
                        <option value="1">Paid</option>
                        <option value="0">Unpaid</option>
                    </select>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6 mt-2">
                <button class="btn btn-warning w-100">Submit</button>
            </div>
        </div>
        </form>
    </div>






            <!-- /.content -->
 
         <script>
           
    $(function() {
  $('#date-ankur').daterangepicker({
   
    
    locale: {
      format: 'YYYY-MM-DD'
    },
   
    opens: 'left'
  }, function(start, end, label) {
     
    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
 
            
        </script>
        @endsection
    
      