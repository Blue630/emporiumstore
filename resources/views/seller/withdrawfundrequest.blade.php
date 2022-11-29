@extends('admin.layout.layout') @section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Withdraw Funds Request</h1>
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
                                <!--<form method="post" action="{{url('/admin/withdrawfundrequest')}}">
                                @csrf
                                <div class="row">
                                <?php
                                /*if(isset($_GET['page']) && $_GET['page']!="")
                                {*/
                                ?>                  
                                <div class="col-sm-3 sortby">
                                <div class="flt-lft">
                                <label>Status
                                <select class="form-control" style="width:140px;" name="seller_status">
                                <option value="">--Select--</option>
                                <option value=1>Active</option>
                                <option value=0>Inactive</option>
                                </select>
                                
                                </label>
                                </div>
                                </div>
                                <?php
                                /*}
                                else
                                {
                                $sellerstatusactive = "";
                                $sellerstatusinactive = "";
                                if($_GET)
                                {
                                if($_REQUEST['seller_status']==1)
                                {
                                $sellerstatusactive = "selected";
                                }
                                if($_REQUEST['seller_status']==0)
                                {
                                $sellerstatusinactive = "selected";
                                }
                                }*/
                                ?>
                                <div class="col-sm-3 sortby">
                                <div class="flt-lft">
                                <label>Status
                                <select class="form-control" style="width:140px;" name="seller_status">
                                <option value="">--Select--</option>
                                <option <?php //echo $sellerstatusactive;?> value=1>Active</option>
                                <option <?php //echo $sellerstatusinactive;?> value=0>Inactive</option>
                                </select>
                                
                                </label>
                                </div>
                                </div>
                                <?php
                                /*}*/
                                ?>
                                <div class="col-sm-4 date-pickme">
                                <div class="flt-lft">
                                <label class="d-flex align-items-center">Date: 
                                
                                <div class="input-group date reservationdate" data-target-input="nearest">
                                <input type="date" class="form-control" name="date" />
                                
                                </div>
                                
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
                                </form>-->
                                    <div class="">
                                        <table class="table table-bordered table-responsive"  style="font-size:14px;">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Request Number</th>
                                                    <th>Product Name</th>
                                                    <th>Seller Name</th>
                                                    <th>Email</th>
                                                    <th>Country</th>
                                                    <th>Region</th>
                                                    <th>City</th>
                                                    <th>Postcode</th>
                                                    <th>Address</th>
                                                    <th>Request Amount</th>
                                                    <th>Payment Gateway</th>
                                                    <th>Payment Status</th>
                                                    <th>Date</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach($withdrawfundrequests as $key=>$withdrawfundrequest)
                                                {
                                                    $key++;
                                                ?>
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td class="seller_id">{{$withdrawfundrequest->request_number}}</td>
                                                    <?php
                                                    $exp_product_id = explode(',' ,$withdrawfundrequest->product_id);
                                                    $product = DB::table('products')->whereIn('id',$exp_product_id)->orderBy('id','desc')->get();
                                                    ?>
                                                    <td>
                                                     <?php
                                                    foreach($product as $key=>$res)
                                                    {
                                                    $product_name= $res->name.',';
                                                    echo $product_name;
                                                    }
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $sellerdata = DB::table('sellers')->where('user_id',$withdrawfundrequest->user_id)->first();
                                                        echo $seller_name = $sellerdata->first_name .' '. $sellerdata->middle_name .' '. $sellerdata->last_name;
                                                        ?>
                                                    </td>
                                                    <td>{{$withdrawfundrequest->email}}</td>
                                                    <td>{{$withdrawfundrequest->country}}</td>
                                                    <td>{{$withdrawfundrequest->state}}</td>
                                                    <td>{{$withdrawfundrequest->city}}</td>
                                                    <td>{{$withdrawfundrequest->pincode}}</td>
                                                    <td>{{$withdrawfundrequest->address}}</td>
                                                    <td>{{$withdrawfundrequest->req_amount}}</td>
                                                    <td>{{$withdrawfundrequest->payment_gateway_type}}</td>
                                                    <td>
                                                        <?php
                                                        if($withdrawfundrequest->payment_status==0)
                                                        {
                                                            $status = "Unpaid";
                                                        }
                                                        else
                                                        {
                                                            $status = "Paid";
                                                        }
                                                        
                                                        ?>
                                                        {{$status}}
                                                        </td>
                                                    <td>{{$withdrawfundrequest->created_date}}</td>

                                                   </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                        
                                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="table_page flt-rght">
                                            <!--{{ $withdrawfundrequests->links() }}-->
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
@endsection