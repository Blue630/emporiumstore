@extends('admin/layout/layout')

@section('content')
 
@php

use App\Transaction;
$user_id =  auth()->user()->id;


$transactions_details = Transaction::adminWallet();


$wallet = 0;
$total_commission = 0;
$total_earning = 0;
$seller_paid = 0;
$seller_unpaid = 0;
$seller_unpaid_count =0;

foreach($transactions_details as $transaction_detail){
$wallet += $transaction_detail->total_amount;

if($transaction_detail->type == 3 || $transaction_detail->type == 4){

$total_earning += $transaction_detail->total_amount;
}

if($transaction_detail->type == 1){

$total_commission += $transaction_detail->total_amount;

}

}



$seller_amt_data = DB::table('transaction_history')->get();
foreach($seller_amt_data as $seller_amt){

if($seller_amt->seller_paid == 1){
$seller_paid += $seller_amt->seller_amount;
}else if($seller_amt->seller_paid == 0){
$seller_unpaid += $seller_amt->seller_amount;
//Checking seller unpaid count
$seller_unpaid_count++;
}
}


$cashback_paid_amt = 0;
$cashback_notpaid_amt = 0;
$cashback_unpaid_count =0;
$cashback_data = DB::table('cart')->get();
foreach($cashback_data as $cashback){
if($cashback->cashback_paid == 0){
$cashback_notpaid_amt +=  $cashback->cashback;
$cashback_unpaid_count++;
}
else if($cashback->cashback_paid == 1){
$cashback_paid_amt +=  $cashback->cashback;
}
}


 
 @endphp
 
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
    
                                <h1 class="m-0">Wallet <strong>&</strong> Payments</h1>
    
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

     <div class="container">

        <div class="row">

            <div class="col-lg-4 col-xl-3 col-md-6 mb-4">

                <!-- small box -->

                <div class="small-box bg-info radius-5 shadow  text-white">

                    <div class="inner">

                        <h3>£ {{$wallet}}</h3>



                        <p class="h6">Total Balance</p>
                        <div class="d-flex justify-content-end">
                            <!--<a href="#" class="text-white py-1 m-0 h6"><u>all transactions <i class="fas fa-angle-double-right" style="font-size: 10px;"></i></u>   </a>-->
                        </div>
                    </div>

                    <!--<div class="icon">

    <i class="ion ion-bag"></i>

  </div>

  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->

                </div>

            </div>

            <!-- ./col -->

            <div class="col-lg-4 col-xl-3 col-md-6 mb-4">

                <!-- small box -->

                <div class="small-box bg-success radius-5 shadow  text-white">

                    <div class="inner">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>

                                <h3>£{{$total_commission}}</h3>



                                <p class="h6">Total Commission</p>
                            </div>
                            <div>
                                <a href="https://www.paypal.com/" class="bg-white h6 text-black py-1 px-3 radius-5">Withdraw</a>

                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <!--<a href="#" class="text-white py-1 m-0 h6"><u>all transactions <i class="fas fa-angle-double-right" style="font-size: 10px;"></i></u>   </a>-->
                        </div>
                    </div>



                </div>

            </div>

            <!-- ./col -->

            <div class="col-lg-4 col-xl-3 col-md-6 mb-4">

                <!-- small box -->

                <div class="small-box bg-warning  radius-5 shadow ">

                    <div class="inner">

                        <h3>£{{$seller_paid}}</h3>



                        <p class="h6">Total <strong>Sales</strong> amount paid to vendor.</p>
                        <div class="d-flex justify-content-end">
                            <!--<a href="#" class="text-white py-1 m-0 h6"><u>all transactions <i class="fas fa-angle-double-right" style="font-size: 10px;"></i></u>   </a>-->
                        </div>
                    </div>

                </div>

            </div>

            <!-- ./col -->

            <div class="col-lg-4 col-xl-3 col-md-6 mb-4">

                <!-- small box -->

                <div class="small-box bg-orange  radius-5 shadow  text-white" style="background: #ec6a2c;">

                    <div class="inner">

                        <h3>£{{$cashback_paid_amt}}</h3>



                        <p class="h6">Total <strong>Cashback</strong> paid to buyers</p>
                        <div class="d-flex justify-content-end">
                            <!--<a href="#" class="text-white py-1 m-0 h6"><u>all transactions <i class="fas fa-angle-double-right" style="font-size: 10px;"></i></u>   </a>-->
                        </div>
                    </div>

                </div>

            </div>

            <!-- ./col -->

            <div class="col-lg-4 col-xl-3 col-md-6 mb-4">

                <!-- small box -->

                <div class="small-box bg-light  radius-5  shadow">

                    <div class="inner">

                        <h3>£{{$seller_unpaid}}</h3>



                        <p class="h6"><strong>{{$seller_unpaid_count}} pending orders payments</strong><sup><i class="fa fa-clock text-warning" aria-hidden="true"></i></sup></p>
                        <div class="d-flex justify-content-end">
                            <a href="https://www.paypal.com/" class="bg-success h6 text-white py-1 px-3 radius-5 m-0">Pay Now</a>
                        </div>
                    </div>

                </div>

            </div>

            <!-- ./col -->

            <div class="col-lg-4 col-xl-3 col-md-6 mb-4">

                <!-- small box -->

                <div class="small-box bg-light  radius-5  shadow">

                    <div class="inner">

                        <h3>£{{$cashback_notpaid_amt}}</h3>



                        <p class="h6"><strong>{{$cashback_unpaid_count}} pending cashback payments</strong><sup><i class="fa fa-clock text-warning" aria-hidden="true"></i></sup></p>
                        <div class="d-flex justify-content-end">
                            <a href="https://www.paypal.com/" class="bg-success h6 text-white py-1 px-3 radius-5 m-0">Pay Now</a>
                        </div>
                    </div>

                </div>

            </div>





        </div>


        <div class="row">
            <div class="col-12 text-black p-5 mx-auto">
                <h1 class="ft-20 lh-30 text-center mb-5 ft-bold">Payment Details</h1>

 <form method="post" action="{{url('admin/orders-detail')}}">
@csrf
                          <div class="row">
                              
                               <div class="col-sm-4 date-pickme">
                      
                <select class="form-control float-right" name="transaction_type">
                            <option value="">Choose</option>
                            <option value="1">Paid Cashback</option>
                            <option value="">Paid Orders</option>
                            <option value="3">Pending Order Payments</option>
                            <option value="4">Pending Cashback Payments</option>
                            <option value="">Commission Recieved</option>
                            </select>
                              </div>
                              
                             <div class="col-sm-4 date-pickme">
                             <div class="form-group row">
                                                                         
                            <div class="input-group">
                            
                            <div class="input-group-prepend">
                            
                            <span class="input-group-text">
                            
                            <i class="far fa-calendar-alt"></i>
                            
                            </span>
                            
                            </div>
                            
                            <input type="text" class="form-control float-right" id="date-ankur" name="selected_date" value="">
                            
                            </div> </div> </div>


                                       
                                            
                                        <div class="col-sm-4">
                                        <button type="submit" class="btn btn-block btn-primary">Go!</button>
                                        </div>
                                       

                                        </div>

</form>

                <div class="table-responsive">
                    <table class="table-bordered table lh-15 payment_table" style="font-size: 11px;">
                        <thead>
                            <tr>
                                <th class="text-center">Order ID & Status</th>
                                <th class="text-center col-3">Order Details</th>
                                <th class="text-center">Vendor Payment Status</th>
                                <th class="text-center">Cashback Payment Status</th>
                                <th class="text-center">Commission Status</th>
                            </tr>
                        </thead>
                        <tbody>
            @php 
            
            foreach($orderdetail as $order){
            $date_time = explode(" ",$order->order_created_at);
            $date = date("d-m-Y", strtotime($order->ocreated_at));
            
            @endphp
                            <tr>
                                <td class="text-center py-4">
                                    <div>
                                    Date: {{$date}}<br>
                                    Time: {{$date_time[1]}}
                                    <br></br>
                                    Order ID: {{$order->ouid}}<br>
                                    Status: <strong class="text-danger">
                                        @php
                                        echo ($order->payment_status == 'Pending'?'UNPAID':'PAID')
                                        @endphp</strong>
                                        </div>
                                </td>
                                <td class="text-center py-4">
                                    <div>
                                     <a href="{{url('/admin/orderdetails')}}/{{$order->order_id}}" class="external_link"><i class="fas fa-external-link-alt"></i></a>
                                    <strong>{{$order->pname}},
                                    <br>
                                    Price- &#163;{{$order->price}}<br>
                                    @php
                                        echo ($order->payment_status != 'Pending' ? "(<span class='payment-status'>Payment successful on " .$date."</span>)":'')
                                        @endphp
                                    </strong><br>Vendor Name: @php echo $order->first_name. $order->middle_name. $order->last_name.' ('.$order->su_id.')';
                                    @endphp
                                    <br>
                                    Buyer's Details: @php echo $order->bname .' ('.$order->buid.')'; @endphp
                                    </div>
                                </td>
                                <td class="text-center py-4">
                                    <div>
                                     
                                    @php
                                    if($order->seller_paid == 1){
                                    $seller_date_time = explode(" ",$order->seller_paid_on);
                                    $seller_date = date("d-M-Y", strtotime($seller_date_time[0]));
                                    @endphp
                                <strong class="text-success">Paid</strong><br>
                                    <strong>&#163;{{$order->seller_amount}}</strong><br>
                                    <span class="text-grey">Transfer on</span> {{$seller_date}}({{$seller_date_time[1]}})<br>
                                    @php
                                    }
                                    else{
                                    @endphp
                                    <a href="{{url('admin/vendor-payment_update')}}/{{$order->trans_id}}/1" class="external_link"><i class="fas fa-external-link-alt"></i></a>
                                     <strong class="text-danger">Unpaid</strong><br>
                                    <strong>&#163;{{$order->seller_amount}}</strong><br>
                                    <a href="https://www.paypal.com/" target="_blank" class="border border-dark px-5 py-1 text-black d-inline-block my-2">Pay Now</a>
                                    @php
                                    }
                                    
                                    
$cashback_data = DB::table('cart')->where('product_id','=',$order->product_id)->where('orderid','=',$order->order_id)->first();
                                 
                                    @endphp
                                    </div>
                                </td>
                                <td class="text-center py-4">
                                    <div>
                                     
                                    @php
                                    
                                    if($cashback_data->cashback_paid == 1){
                                    $cashback_date_time = explode(" ",$cashback_data->cashback_paid_on);
                                    $cashback_date = date("d-M-Y", strtotime($cashback_date_time[0]));
                                    
                                    @endphp
                                    <strong class="text-success">Paid</strong><br>
                                    <strong>&#163;{{$cashback_data->cashback}}</strong><br>
                                    <span class="text-grey">Transfer on</span> {{$cashback_date}}({{$cashback_date_time[1]}})<br>
                                    @php
                                    
                                    }
                                    else{
                                    @endphp
                                    <a href="{{url('admin/buyer-cashback-update')}}/{{$cashback_data->id}}/2" class="external_link"><i class="fas fa-external-link-alt"></i></a>
                                    <strong class="text-danger">Unpaid</strong><br>
                                    <strong>&#163;{{$cashback_data->cashback}}</strong><br>
                                    <a href="https://www.paypal.com/" target="_blank" class="border border-dark px-5 py-1 text-black d-inline-block my-2">Pay Now</a>
                                        @php
                                    
                                    }
                                    
                                    @endphp
                                    </div>
                                </td>
                               @php
                                    
                                    
                                   $transaction_date_time = explode(" ",$order->tdate);
                                    $transaction_date = date("d-M-Y", strtotime($transaction_date_time[0]));
                                    
                                    @endphp
                                <td class="text-center py-4">
                                    <div>
                                    <strong class="text-green">Transferred to Bank Account</strong><br>
                                    <strong>&#163;{{$order->admin_amount}}</strong><br>
                                    
                                    <span class="text-grey">Deposited on</span> {{$transaction_date}} ({{$transaction_date_time[1]}})<br>
                                    </div>
                                </td>
                            </tr>
                            
                    @php 
                    }
                    @endphp
                        </tbody>
                    </table>
                    <div class="table_page flt-rght">
{{ $orderdetail->links() }}
</div>

                </div>

            </div>

        </div>
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
    
      