@extends('admin.layout.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Emporium</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Emporium</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <style>
        .homelogo {
            background: #fff;
            padding: 30px;
            text-align: center;
        }
        .small-box>.small-box-footer {
            background: rgb(62 62 62 / 48%);
            color: rgba(255,255,255,.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }
        .bg-warning {
            background-color: #909090 !important;
        }
        .bg-info {
            background-color: #4a4a4a !important
        }
        .inner {
    margin-left: 30px;
}
    </style>
    <section class="content">
    <?php
    $user_id = \Auth::user()->id;
    $get_business_type = DB::table('sellers')->where('user_id',$user_id)->first();
    $business_type = '';
    if(!empty($get_business_type))
    {
        $business_type = $get_business_type->business_type;
    }
    if($user_id==1)
    {
    ?>
    <div class="container-fluid">
        <div class="row">
            <a href="{{url('/admin/manageorder')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$neworder}}</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
            <a href="{{url('/admin/manageorder')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totaloders}}<!--<sup style="font-size: 20px;">%</sup>--></h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
            <a href="{{url('/admin/manageproduct')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totalproducts}}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div></a>
            <a href="{{url('/admin/buyers')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totaluser}}</h3>
                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
        </div>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="container-fluid">
        <div class="row">
            <a href="{{url('/seller/manageorder')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$newtotalsellerorders}}</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
            <a href="{{url('/seller/manageorder')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totalsellerorders}}<!--<sup style="font-size: 20px;">%</sup>--></h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
            <a href="{{url('/seller/manageproduct')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totalsellerproducts}}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
            <?php
            if($new_end_date!='')
            {
            ?>
            <a href="{{url('/seller/managesubscription')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$new_end_date}}</h3>
                        <p>{{$subscription_name}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
            <?php
            }
            else
            {
            ?>
            <a href="{{url('/seller/managesubscription')}}">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info" style="height: 120px;text-align: center;padding-top: 40px;">
                    <div class="inner">
                        <button class="btn btn-default">Buy Subscripton</button>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            </a>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61ea3fcab9e4e21181bb19ca/1fptgicdd';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    <?php
    }
    ?>
</section>
    <!-- /.content-header -->
    <div class="container">
        <?php
        if(Auth::check())
        {
        $user_id = auth()->user()->id;
        $user_data = DB::table('users')->where(array('id'=>$user_id))->first();
        $user_type = $user_data->user_type;
        }
        if($user_type==2 || $user_type==3)
        {
        ?>
        <div class="row">
            <div class="col-md-12" style="text-align:center;">
            <a href="{{url('/seller/updatesellerprofile')}}" class="btn btn-warning">Edit Personal/Business Details</a>
            </div>
        </div>
        <?php
        }
        ?>
        <br>
            <div class="row">
            <div class="col-md-12">
                <div class="homelogo">
                    <?php
                    if($business_type == 'Business')
                    {
                    ?>
                    <img style='width: 300px;height: auto;' src="{{asset('/public/front')}}/images/EMPORIUM_Business (1).png" alt="" />
                    <?php
                    }
                    else
                    {
                    ?>
                    <img style='width: 300px;height: auto;' src="{{asset('/public/front')}}/img/individual.png" alt="" />
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 15px;">
        </div>
    </div>
</div>
    <?php
    $user_id = \Auth::user()->id;
    if($user_id==1)
    {
    ?>
   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Seller</span>
                        <span class="info-box-number">{{$totalvendor}}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Buyer</span>
                        <span class="info-box-number">{{$totalbuyer}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

    <!-- /.content -->
  </div>
 
 @endsection