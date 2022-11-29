@include('front.include.header')
@yield('header')
<style>
.countdown {
    position: absolute;
}
</style>
<!-- content area start -->
<div class="h-50px d-none d-lg-block"></div>
<div class="container">
    <div class="row">
        <div class="col-lg-3" id="product_aside_bar">
            <aside id="product_aside">
                <div class="close_aside_toggle cusror-pointers float-end d-lg-none my-4">
                    <i data-feather="x-circle"></i>
                </div>
                <div class="w-100 clearfix"></div>
                <div class="related_cat d-none d-lg-block text-black">
                    <h3 class="ft-20 lh-30 text-black">Related Categories</h3>
                    <div class="parent_submenu text-black">
                        <a href="#" class="ft-18 lh-27"><i data-feather="chevron-left"></i> Electronics</a>
                        <ul class="list-unstyled ft-15 lh-22 text-secondary">
                           <?php
$subcategorycount = count($subcategory);
if($subcategorycount>0)
{
foreach ($subcategory as $subcategory_value) 
{
?>
<li><a href="{{url('subcategory/'.$subcategory_value->slug)}}" class="ft-bold active">{{$subcategory_value->name}}</a></li>
<?php
}
}
?>

                        </ul>
                    </div>
                </div>


<div id="filters">
<form name="sortbyfrm" id="sortbyfrm" method="get">
<div class="accordion" id="accordion_prod">
<?php
$a = 0;
$specifications = DB::table('specifications')->get();
/*$specdata = DB::table('specifications')
->select('*')
->whereRaw('FIND_IN_SET('.$parent_id.',cat_id)')
->get();*/
foreach ($specifications as $allspecifications) 
{
    $a++;
    $spec_id = $allspecifications->id;
?>
<div class="accordion-item  border-0 OperatingSystem_filter checkbox_filter">
<h2 class="accordion-header" id="heading<?php echo $a;?>">
<button class="accordion-button collapsed ft-20 lh-30 ft-500" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $a;?>" aria-expanded="false" aria-controls="collapse<?php echo $a;?>">
{{$allspecifications->name}}
<i data-feather="minus"></i>
<i data-feather="plus"></i>
</button>
</h2>
<div id="collapse<?php echo $a;?>" class="accordion-collapse collapse ps-4 text-secondary" aria-labelledby="heading<?php echo $a;?>">
<div class="accordion-body">
<div class="checkbox_filter_listing">
<?php
$aa="";
$aas = array();
$type="";
$type=isset($_REQUEST['sortby']);
if($type=="")
{
foreach ($_GET as $key => $value) {
    if($key!="page"){
    foreach ($value as $k => $val) {
        $aas[] = $val;  
    }
    }
}
}
$options = DB::table('options')->where('specs_id',$spec_id)->get();
foreach ($options as $key => $alloptions) 
{
$option_name = $alloptions->name;
if(in_array($option_name,$aas))
{
$checked ="checked ";
}
else
{
$checked ="";
}
?>
<div class="checkbox">
<label for="{{$option_name}}">
    <input type="checkbox" <?php echo $checked;?> onchange="javascript:document.getElementById('sortbyfrm').submit();" id="{{$option_name}}" name="{{$allspecifications->name}}[]" value="{{$option_name}}">
    <span>{{$option_name}}</span>
</label>
</div>
<?php
}
?>
</div>
</div>
</div>
</div>
<?php
}
?>

</div>
</form>
</div>


            </aside>
        </div>


        <div class="col-lg-9 ps-lg-5">
            <div class="aside_toggle cursor-pointer my-4 d-lg-none">
                <i data-feather="arrow-right-circle"></i> Advance Filter
            </div>

            <div class="breadcrumb_box">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Auction Listing</li>
                    </ol>
                </nav>
            </div>
          <form id="filterbyfrm" name="filterbyfrm" method="get">
<div class="sortby_filter ft-12">
<div class="d-flex  align-items-center justify-content-between flex-wrap">
<div class="d-flex align-items-center my-4">
<span class="labels">Sort By</span>
<div class="border radius-5">
<div class="d-flex sortby_filter_listing">
<!-- <div class="popular_filter">Popular</div> -->
<div class="newset_filter" >
<select style="border:none;" class="newset_filter" name="sortbyorder" id="sortbyorder" onchange="javascript:document.getElementById('filterbyfrm').submit();">
<!--<option value="">Sort By Order</option>-->
<option value="asc" <?php if(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder'] == "asc") { echo "SELECTED"; } ?> >Oldest</option>
<option value="desc" <?php if(isset($_REQUEST['sortbyorder']) && $_REQUEST['sortbyorder'] == "desc") { echo "SELECTED"; } ?> >Newest</option>
</select>
</div>

<!--<div class="rating_filter">Average Rating</div>-->
<div class="price_sorting">
<select style="border:none;" name="sortby" id="sortby" onchange="javascript:document.getElementById('filterbyfrm').submit();">
<!--<option value="">Sort By Price</option>-->
<option value="lowtohigh" <?php if(isset($_REQUEST['sortby']) && $_REQUEST['sortby'] == "lowtohigh") { echo "SELECTED"; } ?> >Low To High</option>
<option value="hightolow" <?php if(isset($_REQUEST['sortby']) && $_REQUEST['sortby'] == "hightolow") { echo "SELECTED"; } ?> >High To Low</option>
</select>
</div>
</div>
</div>
</div>
<div class="d-none d-md-flex gap-3 view_filter my-4 ms-auto">
<div class="border p-2 list_filter cursor-pointer">
<i data-feather="list"></i>
</div>
<div class="border p-2 grid_filter active cursor-pointer">
<i data-feather="grid"></i>
</div>
</div>
</div>
</div>
</form>

            <h1 class="mt-5">Current Auctions</h1>

            <!-- product listing -->

            <div class="product_grid product_wrapper">

                <div class="row gx-5">
<?php
$auctionsproductscount = count($auctionsproducts);
if($auctionsproductscount>0)
{
foreach ($auctionsproducts as $key=>$auctionsproducts_result) 
{
$product_id = $auctionsproducts_result->product_id;
?>                    
                    
                    
                    <div class="col-lg-4 col-6">
                        <div class="products_unit">
                            <div class="image position-relative">
                                <a href="{{url('auction-detail/'.$auctionsproducts_result->aid)}}"><img src="{{ asset('public/products/'.$auctionsproducts_result->image) }}" class="img-fluid" alt=""></a>
                                <div class="countdown">
                                    <span id="future_datep{{$key}}"></span>
                                </div>
                            </div>

                            <div class="products_desc ">
                                <!--<div class="d-flex justify-content-between ft-12 ft-500  flex-wrap">-->
                                <!--    <div class="p_Aname ">-->
                                <!--        <a href="# " class=" text-black ">Tshirt</a>-->
                                <!--    </div>-->
                                <!--    <div class="p_color ">Black</div>-->
                                <!--    <div class="p_size ">XL / L / M / S </div>-->
                                <!--</div>-->
                                <p class="ft-12 my-3 ft-500 ">{{$auctionsproducts_result->name}}</p>


                                <div class="starting_bid ft-15 ft-medium ">
                                    Starting Bid: £{{$auctionsproducts_result->minimum_cost}}
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript ">
                            $(function() {
                                $('#future_datep{{$key}}').countdowntimer({
                                    dateAndTime: '{{date_format(date_create($auctionsproducts_result->auction_time),"Y/m/d H:i:s")}}',
                                    labelsFormat: true,
                                    displayFormat: "DHMS "
                                });

                            });
                        </script>
                    </div>
<?php } }
else{

?>
            

<h3>! No auctions available right now.</h3>

<?php } ?>
    

                </div>

            </div>
            <!-- product listing end -->

            <!-- pagination -->
            <br>
            <br>
            <hr>
            <div class="d-flex gap-5 align-items-center justify-content-center flex-wrap ">
                {!! $auctionsproducts->links() !!}
                <!--<div class="go_to ">-->
                <!--    <div class="d-flex align-items-center gap-1 ">-->
                <!--        <span class="me-3 ">Go To Page</span>-->
                <!--        <input type="text ">-->
                <!--        <button>go</button>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <br>
            <br>
            <!-- pagination end-->
        </div>
    </div>
</div>
<div class="h-50px "></div>
<!-- content area End -->
@include('front.include.footer')
@yield('footer')