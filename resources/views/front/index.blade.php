@include('front.include.header')
@php
use App\Product;
use App\OrderDetail;
@endphp
@yield('header')
<style type="text/css">

/*@media(max-width:599px) {*/
/*    #home_slideshow {*/
/*    padding: 25px 35px;*/
/*}*/
.rat{
    padding-right: 1rem !important;
    padding-left: 1rem !important;
}
}

</style>
<!-- content area start -->
<div class="container px-5 rat">
    <section id="home_slideshow">
        <div id="owl_slideshow" class="owl-carousel owl-theme big_arrow">
            <?php
            if($slider)
            {
            foreach($slider as $slider_result)
            {
            ?>
            <div class="item">
                <a href="{{$slider_result->url}}"><img style="width:100%;" src="{{asset('public/slider/'.$slider_result->image) }}" alt=""></a>
            </div>
            <?php
            }
            }
            ?>
        </div>
    </section>
</div>
<?php
$count_featured_product = count($featuredproduct);
if($count_featured_product>0)
{
?>
<div class="container">
    <section id="featured_prod" class="slider_sec">
        <div class="row align-items-center">
            <div class="col-lg-3 pb-5 pb-lg-0">
                <h3 class="ft-25 text-white m-0">Featured Products</h3>
            </div>
            <div class="col-lg-9">
                <div class="owl-carousel boxed_arrow" id="stagepadding1">
                    <?php
                    $currentDate = date('Y-m-d');
                    foreach($featuredproduct as $featuredproduct_result)
                    {
                    $seller_id = $featuredproduct_result->user_id;
                    $newseller_id = explode(',', $seller_id);
                    $checkfeaturedproductdate = DB::table('seller_featured_subscription')->where('seller_id',$newseller_id)->orderBy('id','desc')->first();
                    if(!empty($checkfeaturedproductdate))
                    {
                    $end_date = $checkfeaturedproductdate->end_date;
                    if($end_date>=$currentDate)
                    {
                    ?>
                    <div class="item">
                        <a href="{{url('product-detail/'.$featuredproduct_result->slug)}}">
                            <img style="width:240px;height:240px;" src="{{ asset('public/products/'.$featuredproduct_result->image) }}" class="shadow"
                                alt="{{$featuredproduct_result->name}}" />
                        </a>
                    </div>
                    <?php
                    }
                    else
                    {
                        $updateData=array(
                        'is_featured'=>0,
                        );
                        DB::table('products')->where(array('user_id'=>$newseller_id))->update($updateData);
                    }
                    }
                    else
                    {
                    ?>
                    <div class="item">
                        <a href="{{url('product-detail/'.$featuredproduct_result->slug)}}">
                            <img style="width:240px;height:240px;" src="{{ asset('public/products/'.$featuredproduct_result->image) }}" class="shadow"
                                alt="{{$featuredproduct_result->name}}" />
                        </a>
                    </div>
                    <?php
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="text-end pt-4 pe-5"><a href="{{url('/featured-products')}}" class="ft-18 text-white">VIEW ALL</a></div>
    </section>
</div>
<?php
}
else
{
?>
<br>
<div class="container">
<div class="alert alert-danger" style="text-align:center;">We are arranging featured products for you.</div>
</div>
<?php
}
?>
<div class="container">
    <section id="category-list">
        <h3 class="text-center ft-25 my-5 pt-3">CATEGORIES</h3>
        <div id="category_list" class="owl-carousel owl-theme big_arrow arrow_padding">
            <?php
            if($category!="")
            {
            foreach ($category as $allcategory) 
            {
            ?>
            <div class="item">
                <a href="{{url('category/'.$allcategory->slug)}}"><img style="width:174px;height:174px;"
                        src="{{asset('public/category/'.$allcategory->categoryimg)}}" class="rounded-circle shadow"
                        alt="" />
                    <p class="ft-18 mt-4 text-black text-center">{{$allcategory->catname}}</p>
                </a>
            </div>
            <?php
            }
            }
            ?>
        </div>
    </section>
    <div class="text-end pt-4 pe-5"><a href="{{url('categories/')}}" class="ft-18 pr-30 text-black">VIEW ALL</a></div>
</div>
<?php
$counttodaydealproducts = count($todaydealproducts);
if($counttodaydealproducts>0)
{
?>
<div class="container mt-5 pt-4">
    <section id="todays-deal" class="slider_sec shadow-set px-30 py-20 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-3 pb-5 pb-lg-0">
                <h3 class="ft-25 text-black m-0">Today’s deal</h3>
            </div>
            <div class="col-lg-9">
                <div class="owl-carousel boxed_arrow boxed_arrow_black" id="todaysDeal">
                    <?php
                    foreach($todaydealproducts as $todaydealproductsresult)
                    {
                    ?>
                    <div class="item">
                        <a href="{{url('product-detail/'.$todaydealproductsresult->slug)}}"><img style="width:240px;height:240px;" src="{{ asset('public/products/'.$todaydealproductsresult->image) }}" class="shadow"
                                alt="{{$todaydealproductsresult->name}}" /></a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="text-end pt-4 pe-5"><a href="{{url('today-deal/')}}" class="ft-18 text-black">VIEW ALL</a></div>
    </section>
</div>
<?php
}
else
{
?>
<div class="container mt-5 pt-4">
<div style="text-align:center;" class="alert alert-danger">There is no product.</div>
</div>
<?php
}
?>
<div class="container mt-5 pt-4">
    <section id="best-seller">
        <h3 class="text-center ft-25 my-5 pt-3">OUR BEST SELLER</h3>
        <div id="bestseller" class="owl-carousel owl-theme big_arrow arrow_padding">
            <?php
            $allsellers = DB::table('sellers')->orderBy('id','desc')->get();
            foreach($allsellers as $seller_result)
            {
            $seller_id = $seller_result->user_id;
            $storename = $seller_result->storename;
            $newseller_id = implode(",",(array)$seller_id);
            $x = explode(",",$newseller_id);
            $seller_data = DB::table('users')->where('id',$x)->get();
            foreach($seller_data as $seller_result1)
            {
            $seller_name = strtolower($seller_result1->name);
            $seller_u_id = $seller_result1->u_id;
            $seller_business_type = $seller_result->business_type;
            $image = $seller_result->image;
            $totalsellerorders = DB::table('order_detail')->where('seller_id',$x)->groupBy('order_id')->get()->count();
            if($totalsellerorders>5)
            {
            ?>
            <div class="item">
                <a href="{{url('best-seller-product/'.$seller_result1->u_id)}}">
                    <?php
                    if($image!='')
                    {
                    ?>
                    <img src="{{asset('/public/front')}}/img/{{$seller_result->image}}" class="rounded-circle shadow"
                        alt="{{$seller_name}}" title="{{$storename}}">
                        <?php
                    }
                    elseif($image=='seller.png'){
                        ?>
                        <img src="{{asset('/public/front')}}/img/user.png" class="rounded-circle shadow"
                        alt="{{$seller_name}}" title="{{$storename}}">
                        <?php
                    }
                        ?>
                </a>
            </div>
            <?php
            }
            }
            }
            ?>
        </div>
    </section>
    <div class="text-end pt-4 pe-5"><a href="{{url('best-sellers/')}}" class="ft-18 pr-30 text-black">VIEW ALL</a></div>
</div>
<?php
$counttopratedproduct = count($topratedproduct);
if($counttopratedproduct>0)
{
?>
<div class="container mt-5 pt-4">
    <section id="top-rated" class="slider_sec shadow-set px-30 py-20 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-2 pb-5 pb-lg-0">
                <h3 class="ft-25 text-black m-0">Top Rated</h3>
            </div>
            <div class="col-lg-10">
                <div class="owl-carousel boxed_arrow boxed_arrow_black" id="toprated">
                    <?php
                    foreach($topratedproduct as $topratedproduct_result)
                    {
                    $product_id = $topratedproduct_result->product_id;
                    $topproduct = DB::table('products')->select('products.*')->join('users','users.id','=','products.user_id')->where(array('products.id'=>$product_id,'products.status'=>1,'users.status'=>1))->orderBy('products.id','desc')->limit(10)->get();
                    if(isset($topproduct[0]))
                    {
                    foreach($topproduct as $topproduct_result)
                    {
                    ?>
                    <div class="item">
                        <a href="{{url('product-detail/'.$topproduct_result->slug)}}">
                            <p>{{$topproduct_result->name}}</p>
                            <img style="width:226px;height:197px;" src="{{ asset('public/products/'.$topproduct_result->image) }}" class="shadow" alt="{{$topproduct_result->name}}" />
                        </a>
                    </div>
                    <?php
                    }
                    }
                    else
                    {
                    ?>
                    <div class="alert alert-danger" style="text-align:center;">No product found</div>
                    <?php
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        if(isset($topproduct[0]))
        {
        ?>
        <div class="text-end pt-4 pe-5"><a href="{{url('top-rated/')}}" class="ft-18 text-black">VIEW ALL</a></div>
        <?php
        }
        ?>
    </section>
</div>
<?php
}
?>
<div class="container mt-5 pt-4">
    <section id="just-launched">
        <h3 class="text-center ft-20 my-5 pt-3">JUST LAUNCHED/ Just in/ newly ADDED</h3>
        <div id="justlaunched" class="owl-carousel owl-theme big_arrow arrow_padding">
            @php
            $newproducts = Product::fetchNewlyAddProducts();
            foreach($newproducts as $newproduct){
            $seller_id = $newproduct->user_id;
            $get_seller_status = DB::table('sellers')->WhereRaw("user_id= $seller_id")->first();
            if($get_seller_status->status==1)
            {
            @endphp
            <div class="item">
            <a href="{{url('product-detail/')}}/{{$newproduct->slug}}"><img src="{{asset('/public/products')}}/{{$newproduct->image}}" class="rounded-circle shadow new-launched-home" alt="" style="height:170px;object-fit:contain" /></a>
            </div>
            @php
            }
            }
            @endphp
        </div>
    </section>
    <div class="text-end pt-4 pe-5"><a href="{{url('just-launched/')}}" class="ft-18 pr-30 text-black">VIEW ALL</a></div>
</div>
<?php
$countweeklydealsproduct = count($weeklydealsproduct);
if($countweeklydealsproduct>0)
{ 
?>
<div class="container my-5 pt-5">
    <section id="weekly-deals" class="slider_sec shadow-set px-30 py-20 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-3 pb-5 pb-lg-0">
                <h3 class="ft-25 text-black m-0">Weekly Deals</h3>
            </div>
            <div class="col-lg-9">
                <div class="owl-carousel boxed_arrow boxed_arrow_black" id="weeklydeals">
                    <?php
                    foreach($weeklydealsproduct as $weeklydealsproduct_result)
                    {
                    ?>
                    <div class="item">
                        <a href="{{url('product-detail/'.$weeklydealsproduct_result->slug)}}"><img style="width:240px;height:240px;" src="{{ asset('public/products/'.$weeklydealsproduct_result->image) }}" class="shadow"
                                alt="{{$weeklydealsproduct_result->name}}" /></a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="text-end pt-4 pe-5"><a href="{{url('weekly-deals/')}}" class="ft-18 text-black">VIEW ALL</a></div>
    </section>
</div>
<?php
}
?>
<?php
$count_season_product = count($seasonalproduct);
if($count_season_product>0)
{
?>
<div class="container mt-5 pt-4">
    <section id="early-sale">
        <h3 class="text-center ft-20 my-5 pt-3">Early Winter Sale/ Summer Sale/ Autumn Sale/ rainy Season deals</h3>
        <div id="earlysale" class="owl-carousel owl-theme big_arrow arrow_padding">
            <?php
            foreach($seasonalproduct as $season_product_result)
            {
            ?>
            <div class="item">
                <a href="{{url('product-detail/'.$season_product_result->slug)}}">
                    <img style="width:174px;height:174px;" src="{{ asset('public/products/'.$season_product_result->image) }}" class="rounded-circle shadow"
                        alt="{{$season_product_result->name}}" />
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
    <div class="text-end pt-4 pe-5"><a href="{{url('seasonal-products/')}}" class="ft-18 pr-30 text-black">VIEW ALL</a></div>
</div>
<?php
}
?>
@php
if(Auth::check())
{
$user_id = auth()->user()->id;
$unrated_products = OrderDetail::GetUnratedProduct($user_id);
if(!empty($unrated_products[0])){
@endphp
<div class="container mt-5 py-5">
    <div class="row">
        <div class="col-lg-10 col-xl-8 mx-auto">
            <section class="rate_purchase border p-lg-5">
                <div class="p-4">
                    <h2 class="ft-35 text-black text-center pb-5">RATE YOUR PURCHASE</h2>
                          <div id="ratepurchase" class="owl-carousel owl-theme big_arrow arrow_padding">
@php
foreach($unrated_products as $unrated_product){
@endphp
                              
                            <div class="item">
                                <div class="row pt-4">
                                    <div class="col-md-3 text-center">
                                       <img src="{{asset('/public/products')}}/{{$unrated_product->image}}" class="img-fluid mb-4" alt="">
                                    </div>
                                    <div class="col-md-9 px-4">
                                        <form method="post" action="{{url('/rate-unrated-product/')}}">
                                        @csrf
                                        <h3 class="ft-25 text-black text-center">{{$unrated_product->name}}</h3>
                                        <div class="d-flex align-items-start justify-content-center starbox gap-5 py-5">
                                        @php
                                        $ratearr = array('HATED IT','DIDN’T LIKE','WAS OKAY','LIKED','LOVED IT');
                                        for($i=0;$i<5;$i++){
                                        @endphp
                                        <div class="star{{$i}}">
                                        <label for="{{$i}}star">
                                            <input type="radio" id="{{$i}}star" name="starrating[{{$i}}]">
                                            <span class="show_star"></span></label>
                                        <p class="ft-13 ft-light">
                                        
                                        {{$ratearr[$i]}}</p>
                                        <input type="hidden" name="unrated_product_id" value="{{$unrated_product->product_id}}">
                                        <input type="hidden" name="unrated_user_id" value="{{$user_id}}">
                                        <input type="hidden" name="unrated_orderdetail_id" value="{{$unrated_product->order_detail_id}}">                                  </div>
                                        @php 
                                        }
                                        @endphp
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="px-5">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
 @php } } @endphp                            
                             
                        </div>
                </div>
            </section>
        </div>
    </div>
</div>
@php } @endphp

<?php 
$countmonthlydealsproduct = count($monthlydealsproduct);
if($countmonthlydealsproduct>0){ 
?>
<div class="container my-5 pt-5">
    <section id="month-deals" class="slider_sec shadow-set px-30 py-20 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-3 pb-5 pb-lg-0">
                <h3 class="ft-25 text-black m-0">DEAL OF THE MONTH</h3>
            </div>
            <div class="col-lg-9">
                <div class="owl-carousel boxed_arrow boxed_arrow_black" id="monthdeals">
                    <?php
                    foreach($monthlydealsproduct as $monthlydealsproduct_result)
                    {
                    ?>
                    <div class="item">
                        <a href="{{url('product-detail/'.$monthlydealsproduct_result->slug)}}"><img src="{{ asset('public/products/'.$monthlydealsproduct_result->image) }}" class="shadow"
                                alt="{{$monthlydealsproduct_result->name}}" /></a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="text-end pt-4 pe-5"><a href="{{url('/deal-of-the-month')}}" class="ft-18 text-black">VIEW ALL</a></div>
    </section>
</div>
<?php
}
?>
<?php if(!empty($mostViewedProducts)){ ?>
<div class="container mt-5 pt-4">
    <section id="top-picks">
        <h3 class="text-center ft-20 my-5 pt-3">TOP PICKS FOR YOU</h3>
        <div id="toppicks" class="owl-carousel owl-theme big_arrow arrow_padding">
            <?php
            foreach ($mostViewedProducts as $product) 
            {
            ?>
            <div class="item">
                <a href="{{url('product-detail/'.$product->slug)}}">
                    <img style="width:174px;height:174px;" src="{{asset('public/products/'.$product->image)}}" class="rounded-circle shadow" alt=""
                         />
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
</div>
<?php } ?>
<?php if(!empty($recentlyViewedProducts)){ ?>
<div class="container my-5 pt-5">
    <h3 class="ft-25 text-black my-5 p-4">CONTINUE WHERE YOU LEFT</h3>
    <section id="continue-left" class="slider_sec shadow-set px-30 py-20 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="owl-carousel boxed_arrow boxed_arrow_black" id="continueleft">
                    <?php
                    foreach ($recentlyViewedProducts as $product) 
                    {
                    ?>
                    <div class="item">
                        <a href="{{url('product-detail/'.$product->slug)}}">
                            <img style="width:174px;height:174px;" src="{{asset('public/products/'.$product->image)}}" class="rounded-circle shadow" alt=""/>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php } ?>
<div class="h-50px"></div>
<section id="signup_newsletter" class="my-5 py-5 px-5">
    <div class="d-lg-flex align-items-center justify-content-center">
        <h2 class="ft-35 lh-50 text-black text-center pb-4 pb-lg-0">Sign-Up to Our Newsletter</h2>
        <div class="sub_button ps-lg-5 ms-lg-5">
            <a href="javascript:void(0);" class="blue_btn btn-large ft-35 text-center" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            SUBSCRIBE
            </a>
        </div>
    </div><br>
    <div class="d-lg-flex align-items-center justify-content-center">
    @if($msg=Session::get('success'))<span style="color:green">{{$msg}}</span>@endif</div>
</section>
<!-- Button trigger modal -->
<?php
if(Auth::check())
{
$email = '';
$user_id = auth()->user()->id;
$useremail = DB::table('users')->where('id',$user_id)->first();
$email = $useremail->email;
}
else
{
    $email = '';
}
?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="login" method="post" action="{{url('newsletter')}}">
        @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Sign Up to Our Newsletter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="email" value="{{$email}}" placeholder="Email Id" name="email" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    </form>
  </div>
</div>
<div class="h-50px"></div>

@include('front.include.footer')
@yield('footer')