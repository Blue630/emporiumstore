@extends('admin/layout/layout')

@section('content')
 
@php
use App\Transaction;

$user_id =  auth()->user()->id;


$transactions_details = Transaction::adminWallet();


$wallet = 0;
$total_commission = 0;
$total_earning = 0;

foreach($transactions_details as $transaction_detail){

$wallet += $transaction_detail->total_amount;

if($transaction_detail->type == 3 || $transaction_detail->type == 4){

$total_earning += $transaction_detail->total_amount;
}

if($transaction_detail->type == 1){

$total_commission += $transaction_detail->total_amount;

}

}

 
 @endphp
 
 
 
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <!-- Content Header (Page header) -->

                <div class="content-header">
    
                    <div class="container-fluid">
    
                        <div class="row mb-2">
    
                            <div class="col-sm-6">
    
                                <h1 class="m-0">Wallet</h1>
    
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

                        <div class="col-lg-3 col-6">

                            <!-- small box -->

                            <div class="small-box bg-info">

                                <div class="inner">

                                    <h3>£ {{$wallet}}</h3>



                                    <p>Total Balance</p>

                                </div>

                                <!--<div class="icon">

                <i class="ion ion-bag"></i>

              </div>

              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->

                            </div>

                        </div>

                        <!-- ./col -->

                        <div class="col-lg-3 col-6">

                            <!-- small box -->

                            <div class="small-box bg-success">

                                <div class="inner">

                                    <h3>£{{$total_commission}}</h3>



                                    <p>Total Commission</p>

                                </div>

                               

                            </div>

                        </div>

                        <!-- ./col -->

                        <div class="col-lg-3 col-6">

                            <!-- small box -->

                            <div class="small-box bg-warning">

                                <div class="inner">

                                    <h3>£{{$total_earning}}</h3>



                                    <p>Earning Amount</p>

                                </div>

                            </div>

                        </div>





                    </div>







                    <div class="row">

                        <div class="col-lg-12">



                            <div class="card">





                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-sm-12">
                                            <h2>Last Transactions</h2>
                                        </div>



                                    </div>



                                    <div class="card-body">

                        <form method="post" action="{{url('admin/wallet')}}">
@csrf
                          <div class="row">
                              
                               <div class="col-sm-3 date-pickme">
                      
        <select class="form-control float-right" name="transaction_type">
                            
                            <option value="">Transaction Type</option>
                            <option value="1">Order</option>
                            <option value="2">Bid</option>
                            <option value="3">Subscription</option>
                            <option value="4">Featured Product</option>
                            </select>
                              </div>
                              
                             <div class="col-sm-3 date-pickme">
                             <div class="form-group row">
                                                                         
                            <div class="input-group">
                            
                            <div class="input-group-prepend">
                            
                            <span class="input-group-text">
                            
                            <i class="far fa-calendar-alt"></i>
                            
                            </span>
                            
                            </div>
                            
                            <input type="text" class="form-control float-right" id="date-ankur" name="selected_date" value="">
                            
                            </div> </div> </div>


                                        <div class="col-sm-3">
                                        
                                        <input type="search" class="form-control" placeholder="Search" name="search">
                                        </div>
                                            
                                        <div class="col-sm-3">
                                        <button type="submit" class="btn btn-block btn-primary">Go!</button>
                                        </div>
                                       

                                        </div>

</form>

                                        <div class="">

                                            <table class="table table-bordered">

                                                <thead>

                                                    <tr>
<th>Transaction type</th>
<th>Transaction Amount</th>
<th>Earning Amount</th>
<th>Transaction id</th>
<th>Status</th>
<th>Datetime</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

@php
foreach($transactions as $transaction){
@endphp
                                                    <tr>

                                                         <td>
                        @php
                        echo ($transaction->type == 1)? "Order":"";
                        echo ($transaction->type == 2)? "Bid":"";
                        echo ($transaction->type == 3)? "Subscription":"";
                        echo ($transaction->type == 4)? "Featured Product":"";
                        @endphp
                                                            </td>

                                                       

                                                        <td>£{{$transaction->amount}}</td>
                                                         <td>£{{$transaction->admin_amount}}</td>

                                                       <td>{{$transaction->transaction_id}}</td>

                                    <td>
                                   {{$transaction->status}}
                                    </td>

                                    <td>{{$transaction->created_at}}</td>
@php
}
@endphp
                                                    </tr>


                                                </tbody>

                                            </table>

                                        </div>

<div class="row">
<div class="col-sm-12 col-md-5">
<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 entries</div>
</div>
<div class="col-sm-12 col-md-7">
<div class="table_page flt-rght">
{{ $transactions->links() }}
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
    
      