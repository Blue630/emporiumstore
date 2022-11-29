@extends('admin.layout.layout') @section('content')
<!-- Content Wrapper. Contains page content -->
<style>
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }
        
        a,
        a:active,
        a:focus {
            color: #333;
            text-decoration: none;
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }
        
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        img {
    max-width: 100%;
    height: auto;
}
/*--blog----*/

.sec-title{
  position:relative;
  margin-bottom:70px;
}

.sec-title .title{
  position: relative;
  display: block;
  font-size: 16px;
  line-height: 1em;
  color: #ff8a01;
  font-weight: 500;
  background: rgb(247,0,104);
  background: -moz-linear-gradient(to left, rgba(247,0,104,1) 0%, rgba(68,16,102,1) 25%, rgba(247,0,104,1) 75%, rgba(68,16,102,1) 100%);
  background: -webkit-linear-gradient(to left, rgba(247,0,104,1) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);
  background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#F70068', endColorstr='#441066',GradientType=1 );
  color: transparent;
  -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  text-transform: uppercase;
  letter-spacing: 5px;
  margin-bottom: 15px;
}

.sec-title h2{
  position:relative;
  display: inline-block;
  font-size:48px;
  line-height:1.2em;
  color:#1e1f36;
  font-weight:700;
}

.sec-title .text{
  position: relative;
  font-size: 16px;
  line-height: 28px;
  color: #888888;
  margin-top: 30px;
}

.sec-title.light h2,
.sec-title.light .title{
  color: #ffffff;
  -webkit-text-fill-color:inherit; 
}
.pricing-section {
    position: relative;
    padding: 100px 0 80px;
    overflow: hidden;
}
.pricing-section .outer-box{
  max-width: 1100px;
  margin: 0 auto;
}


.pricing-section .row{
  margin: 0 -30px;
}

.pricing-block{
  position: relative;
  padding: 0 30px;
  margin-bottom: 40px;
}

.pricing-block .inner-box{
  position: relative;
  background-color: #ffffff;
  box-shadow: 0 20px 40px rgba(0,0,0,0.08);
  padding: 0 0 30px;
  max-width: 370px;
  margin: 0 auto;
  border-bottom: 20px solid #40cbb4;
}

.pricing-block .icon-box{
  position: relative;
  padding: 50px 30px 0;
  background-color: #40cbb4;
  text-align: center;
}

.pricing-block .icon-box:before{
  position: absolute;
  left: 0;
  bottom: 0;
  height: 75px;
  width: 100%;
  border-radius: 50% 50% 0 0;
  background-color: #ffffff;
  content: "";
}


.pricing-block .icon-box .icon-outer{
  position: relative;
  height: 150px;
  width: 150px;
  background-color: #ffffff;
  border-radius: 50%;
  margin: 0 auto;
  padding: 10px;
}

.pricing-block .icon-box i{
  position: relative;
  display: block;
  height: 130px;
  width: 130px;
  line-height: 120px;
  border: 5px solid #40cbb4;
  border-radius: 50%;
  font-size: 50px;
  color: #40cbb4;
  -webkit-transition:all 600ms ease;
  -ms-transition:all 600ms ease;
  -o-transition:all 600ms ease;
  -moz-transition:all 600ms ease;
  transition:all 600ms ease;
}

.pricing-block .inner-box:hover .icon-box i{
  transform:rotate(360deg);
}

.pricing-block .price-box{
  position: relative;
  text-align: center;
  padding: 10px 20px;
}

.pricing-block .title{
  position: relative;
  display: block;
  font-size: 24px;
  line-height: 1.2em;
  color: #222222;
  font-weight: 600;
}

.pricing-block .price{
  display: block;
  font-size: 30px;
  color: #222222;
  font-weight: 700;
  color: #40cbb4;
}


.pricing-block .features{
  position: relative;
  max-width: 200px;
  margin: 0 auto 20px;
}

.pricing-block .features li{
  position: relative;
  display: block;
  font-size: 14px;
  line-height: 30px;
  color: #848484;
  font-weight: 500;
  padding: 5px 0;
  padding-left: 30px;
  border-bottom: 1px dashed #dddddd;
}
.pricing-block .features li:before {
    position: absolute;
    left: 0;
    top: 50%;
    font-size: 16px;
    color: #2bd40f;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    content: "\f058";
    font-family: "Font Awesome 5 Free";
    margin-top: -8px;
}
.pricing-block .features li.false:before{
  color: #e1137b;
  content: "\f057";
}

.pricing-block .features li a{
  color: #848484;
}

.pricing-block .features li:last-child{
  border-bottom: 0;
}

.pricing-block .btn-box{
  position: relative;
  text-align: center;
}

.pricing-block .btn-box button{
  position: relative;
  display: inline-block;
  font-size: 14px;
  line-height: 25px;
  color: #ffffff;
  font-weight: 500;
  padding: 8px 30px;
  background-color: #40cbb4;
  border-radius: 10px;
  border-top:2px solid transparent;
  border-bottom:2px solid transparent;
  -webkit-transition: all 400ms ease;
  -moz-transition: all 400ms ease;
  -ms-transition: all 400ms ease;
  -o-transition: all 400ms ease;
  transition: all 300ms ease;
}

.pricing-block .btn-box a:hover{
  color: #ffffff;
}

.pricing-block .inner-box:hover .btn-box a{
  color:#40cbb4;
  background:none;
  border-radius:0px;
  border-color:#40cbb4;
}

.pricing-block:nth-child(2) .icon-box i,
.pricing-block:nth-child(2) .inner-box{
  border-color: #1d95d2;
}

.pricing-block:nth-child(2) .btn-box a,
.pricing-block:nth-child(2) .icon-box{
  background-color: #1d95d2;
}

.pricing-block:nth-child(2) .inner-box:hover .btn-box a{
  color:#1d95d2;
  background:none;
  border-radius:0px;
  border-color:#1d95d2;
}

.pricing-block:nth-child(2) .icon-box i,
.pricing-block:nth-child(2) .price{
  color: #1d95d2;
}

.pricing-block:nth-child(3) .icon-box i,
.pricing-block:nth-child(3) .inner-box{
  border-color: #ffc20b;
}

.pricing-block:nth-child(3) .btn-box a,
.pricing-block:nth-child(3) .icon-box{
  background-color: #ffc20b;
}

.pricing-block:nth-child(3) .icon-box i,
.pricing-block:nth-child(3) .price{
  color: #ffc20b;
}

.pricing-block:nth-child(3) .inner-box:hover .btn-box a{
  color:#ffc20b;
  background:none;
  border-radius:0px;
  border-color:#ffc20b;
}

</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Manage Subscription</h1>
    </div>
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
                <div class="">
                    <section class="pricing-section">
        <div class="container">
            <div class="sec-title text-center">
                <span class="title">Get subscription</span>
                <h2>Choose a Subscription</h2>
            </div>
            <!-- <form name="subscribenow" id="subscribenow" method="post" action="{{url('seller/subscribenow')}}">
            @csrf -->
            <div class="outer-box">
                <div class="row">
                    <?php
                    $a = 'fas fa-gem';
                    $b = 'fas fa-paper-plane';
                    $c = 'fas fa-rocket';

                    $currentDate = date('Y-m-d H:i:s');
                    $whereRaw = 'seller_id='.$user_id.' and end_date >= "'.$currentDate.'" ORDER BY id DESC';
                    $query_chkdup = DB::table('seller_subscriptions')->whereRaw($whereRaw)->first();

                    if(!empty($query_chkdup))
                    {
                      $subscription_id = $query_chkdup->subscription_id;
                    }
                    else
                    {
                    $subscription_id = 0;
                    }

                    $subscription_data = DB::table('subscriptions')->where('status',1)->get();
                    foreach ($subscription_data as $subscription_data_value) 
                    {
                    $subscribeid = $subscription_data_value->id;
                    ?>
                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><i class="fas fa-rocket"></i></div>
                            </div>
                            <div class="price-box">
                                <div class="title">{{$subscription_data_value->plan_name}}</div>
                                <h4 class="price">£{{$subscription_data_value->price}}</h4>
                            </div>
                            <ul class="features">
                                <li class="true">Duration : {{$subscription_data_value->duration}} Month</li>
                                <li class="true">Product Limit : {{$subscription_data_value->product_limit}}</li>
                            </ul>
                            <div class="btn-box">
                                <input type="hidden" name="seller_id" id="seller_id" value="{{$user_id}}">
                                <input type="hidden" name="subscribe_amount" id="subscribe_amount" value="{{$subscription_data_value->price}}">
                                <?php
                                $sellerdetail = DB::table('sellers')->where(array('user_id'=>$user_id))->first();
                                /*$subscription_id = $sellerdetail->seller_subscription_id;
                                if($subscription_id!='')
                                {
                                $seller_subscription_data = DB::table('seller_subscriptions')->where(array('seller_id'=>$user_id, 'id'=>$subscription_id))->first();
                                $subscription_start_date = $seller_subscription_data->start_date;
                                $subscription_end_date = $seller_subscription_data->end_date;
                                $subscription_auto_id = $seller_subscription_data->subscription_id;
                                }*/
                                ?>
                                <?php
                                
                                if($subscription_id==$subscribeid)
                                {
                                ?>
                                <hr>
                                <button class="theme-btn" disabled="">Already Subscribe</button>
                                <?php
                                }
                                else
                                {
                                ?>
                                <hr>
                                <input type="radio" name="payment_method" id="payment_method" value="Paypal" required=""> <b>Paypal</b> &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="payment_method" id="payment_method" value="Stripe"> <b>Stripe</b><hr>
                                <button type="button" onClick="subscription('<?php echo $subscription_data_value->price; ?>');" value="subscribenow" name="subscribenow" class="theme-btn">Subscribe Now</button>                                
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <!-- </form> -->
        </div>
    </section>
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
@section('script')
@stop @endsection
<script type="text/javascript">
function subscription(price)
{
var user_id = '{{$user_id}}';
//var payment_method = $("input[type='radio'][name='payment_method']:checked").val();
var payment_method = $('[name="payment_method"]:checked').val(); 
if(!payment_method){
    alert("Please select any one payment method.");
    return false;
}
$(document).ready(function()
{
    $.ajax({
            url:'{{ url("/seller/addsubscription/") }}',
            method:'get',
            data:{price:price, user_id:user_id, payment_method:payment_method},
            success:function(data){
                //alert(data);                
                top.location.href='{{url("/seller/subscribenow")}}' +'?price='+price+'&userid='+user_id+'&payment_method='+payment_method;  //redirection
                //window.location.href='{{url("/seller/subscribenow")}}';
            }
    });
});
}
</script>