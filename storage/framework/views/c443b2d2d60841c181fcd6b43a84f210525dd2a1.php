<?php
$category = DB::table('category')->where('status',1)->orderBy('id','desc')->get();
$menucategory = DB::table('category')->where('status',1)->where('show_in_menu',1)->get();
?>
<?php
$currentURL = URL::current();
if(Auth::check())
{
$user_id = auth()->user()->id;
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" content="public">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <!-- JSDelivr -->
    <link href='https://cdn.jsdelivr.net/npm/css.gg/icons/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo e(asset('/public/front')); ?>/css/lightbox/css/lightbox.css">
    <link rel="stylesheet" href="<?php echo e(asset('/public/front')); ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo e(asset('/public/front')); ?>/css/IE.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Emporium</title>
    
</head>
<style>  
 @media  only screen and (min-width:1500px){
        .logo {
    min-width: 16%;
}

    }
    @media  only screen and (min-width:2000px){
        .logo {
    min-width: 22%;
}
}
</style>
<body>
    <!-- Header start -->
    <header id="main-header">
        <div class="container-fluid">
            <div class="headersec_1">
                <div class="d-flex align-items-center gap-lg-5 child_flex">
                    <div class="logo">
                        <a href="<?php echo e(url('/')); ?>"><img style="margin-left: 20px;" src="<?php echo e(asset('/public/front')); ?>/img/logo.png" class="img-fluid" alt="Logo"></a>
                    </div>
                    <div class="search_form">
                        <form action="<?php echo e(url('/search')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <select class="select-search-category ft-10" name="term">
                                <?php
                                if($category!="")
                                {
                                foreach ($category as $allcategory) 
                                {
                                ?>
                                <option value="<?php echo e($allcategory->id); ?>"><?php echo e($allcategory->catname); ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                            <span class="mx-4 ft-24 text-light-grey ft-100">|</span>
                            <div class="search-content w-100 d-flex">
                                <input type="text" value="" name="searchdata" class="w-100 ft-13" placeholder="I'm searching for..." autocomplete="off">
                                <button type="submit" title="Search" value="Search"><i data-feather="search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="right-header">
                        <div class="d-flex justify-content-evenly pe-4">
                            <?php
                            if(Auth::check())
                            {
                                $user_id = auth()->user()->id;
                            ?>
                            <?php
                            if($user_id!=1)
                            {
                            ?>
                            <a title="Seller Dashboard" href="javascript:void(0);" onclick="switchtoseller(<?php echo e($user_id); ?>,this);"><span class="d-none d-lg-block">Seller Dashboard</span><i class="fas fa-tachometer d-lg-none ft-30"></i></a>
                            <?php
                            }
                            ?>
                            <a href="<?php echo e(url('/userlogout')); ?>">Signout</a>
                            <!-- <a href="<?php echo e(url('/buyer-profile')); ?>">My Orders</a> -->
                            <?php
                            }
                            else
                            {
                            ?>  
                            <a href="<?php echo e(url('/login')); ?>">Sign in</a>
                            <?php
                            }
                            ?>
                            <?php
                            $user_id = '';
                            if(Auth::check())
                            {
                                $user_id = auth()->user()->id;
                            }
                            $cartcount = DB::table('cart')->where(array('user_id'=>$user_id,'status'=>1))->get();
                            $newcountcart = count($cartcount);
                            ?>
                            <a href="<?php echo e(url('/cart')); ?>" class="d-flex align-items-center gap-1 cart_icon">
                                <span>Cart</span>
                                <div class="position-relative">
                                    <span class="add_product_count"><?php echo e($newcountcart); ?></span>
                                    <i data-feather="shopping-cart"></i>
                                </div>
                            </a>
                            <?php
                            if(Auth::check())
                            {
                            $user_id = auth()->user()->id;
                            $wishlist_query_chkdup = DB::table('wishlist')->where('user_id',$user_id)->get();
                            $wishlist_count = count($wishlist_query_chkdup);
                            ?>
                            <a href="<?php echo e(url('/wishlist')); ?>" class="wishlist_header">
                                <div class=" position-relative">
                                    <span><?php echo e($wishlist_count); ?></span>
                                    <i class="fas fa-heart"></i>
                                </div>
                            </a>
                            <?php
                            }
                            else{
                            ?>
                            <a href="<?php echo e(url('/wishlist')); ?>" class="wishlist_header">
                                <div class=" position-relative">
                                    <span>0</span>
                                    <i class="fas fa-heart"></i>
                                </div>
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="seperator_blue" />

        <div class="container-fluid">
            <div class="headersec_2">
                <div class="d-flex align-items-center justify-content-between position-relative">
                    <div class="nav_icon hitasidemenu">
                        <div class="d-flex align-items-center cusror-pointers text-white">
                            <i data-feather="menu"></i>
                            <span class="lh-10"> ALL</span>
                        </div>
                    </div>
                    <aside id="asideMenumain">
                        <?php 
                        if(Auth::check())
                        {
                        $user_id = auth()->user()->id;
                        $userdata = DB::table('users')->where('id',$user_id)->first();
                        ?>
                        <p class="asideheader">Hello, <strong class="ft-20">
                        <?php echo $userdata->name;
                        } 
                        ?></strong></p>
                        
                        <nav class="firstasidemenu">
                            <ul class="list-unstyled">
                                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                <li><a href="#">Top Picks</a></li>
                                <li><a href="<?php echo e(url('today-deal/')); ?>">Today's Deal</a></li>
                                <li><a href="<?php echo e(url('/auction-listing')); ?>">Current Auctions</a></li>
                            </ul>
                        </nav>
                        <hr class="my-4">
                        <div class="asidemenupart">
                            <strong class="ft-normal mb-4">Shop by Category</strong>
                            <div class="asidenavlisting">
                                <?php
                                if($category!="")
                                {
                                foreach ($category as $n=>$allcategory) 
                                {
                                if ($n % 3) 
                                {
                                    $pos = 'hideGroupAll';
                                }
                                else
                                {
                                    $pos = '';
                                }
                                ?>
                                <div class="menu_group <?php echo $pos;?>">
                                    <a href="javascript:void(0)" class="d-flex">
                                        <span><?php echo e($allcategory->catname); ?></span>
                                        <i data-feather="chevron-right"></i>
                                    </a>
                                    <ul class="list-unstyled">
                                        <?php
                                        $subcategory = DB::table('sub_category')->where('cat_id',$allcategory->id)->orderBy('id','desc')->get();
                                        foreach ($subcategory as $subcategoryvalue) 
                                        {
                                        ?>
                                        <li class="">
                                            <a href="<?php echo e(url('subcategory/'.$subcategoryvalue->slug)); ?>" class="d-flex">
                                                <span><?php echo e($subcategoryvalue->name); ?></span>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <?php
                                }
                                }
                                ?>
                                <a href="javascript:void(0)" class="ft-10-important showAllmenuGroup"> <span>View All </span><i data-feather="chevron-down" width="18px"></i></a>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="asidemenupart">
                            <strong class="ft-normal mb-4">Payments</strong>
                            <div class="asidenavlisting">
                                <div class="">
                                    <a href="<?php echo e(url('/my-account')); ?>" class="d-flex justify-content-between">
                                        <span>Account</span>
                                        <i data-feather="chevron-right"></i>
                                    </a>
                                </div>
                                <?php
                                if(Auth::check())
                                {
                                ?>
                                <div class="">
                                    <a href="javascript:void(0);" onclick="switchtoseller(<?php echo e($user_id); ?>,this);" class="d-flex justify-content-between">
                                        <span>Seller Dashboard</span>
                                        <i data-feather="chevron-right"></i>
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="">
                                    <a href="<?php echo e(url('/contact-us')); ?>" class="d-flex justify-content-between">
                                        <span>Contact Us <i class="fas fa-headphones-alt"></i></span>
                                        <i data-feather="chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </aside>


                    <div class="emp-menu mx-xl-auto">
                        <nav class="navbar navbar-expand-xl">
                            <div class="container-fluid">
                                <button class="navbar-toggler text-white d-flex align-items-center p-0 d-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                    <i data-feather="menu"></i>  <span class="ft-16 ms-2">ALL</span>
                              </button>
                                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                    <div class="navbar-nav">
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk") { ?>active<?php } ?>" aria-current="page" href="<?php echo e(url('/')); ?>">Home</a>
                                        <?php
                                        if($menucategory!="")
                                        {
                                        foreach ($menucategory as $allmenucategory) 
                                        {
                                            $slug = $allmenucategory->slug;
                                        ?>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/category/$slug") { ?>active<?php } ?>" href="<?php echo e(url('category/'.$allmenucategory->slug)); ?>"><?php echo e($allmenucategory->catname); ?></a>
                                        <?php
                                        }
                                        }
                                        ?>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/today-deal") { ?>active<?php } ?>" href="<?php echo e(url('today-deal/')); ?>">Today's Deals</a>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/suggested-products") { ?>active<?php } ?>" href="<?php echo e(url('suggested-products/')); ?>">Suggested for you</a>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/trending") { ?>active<?php } ?>" href="<?php echo e(url('trending/')); ?>">Trending</a>
                                        <!--<a class="nav-link" href="#">Saved</a>-->
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/wishlist") { ?>active<?php } ?>" href="<?php echo e(url('/wishlist')); ?>">Wishlisted</a>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/auction-listing") { ?>active<?php } ?>" href="<?php echo e(url('/auction-listing')); ?>">Current Auctions</a>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/seller-login") { ?>active<?php } ?>" href="<?php echo e(url('/seller-login')); ?>">Sell on Emporium</a>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/best-sellers") { ?>active<?php } ?>" href="<?php echo e(url('best-sellers/')); ?>">Best Seller</a>
                                        <a class="nav-link <?php if($currentURL=="https://emporiumstore.co.uk/subscribe-save") { ?>active<?php } ?>" href="<?php echo e(url('/subscribe-save')); ?>">Subscribe & Save</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="dropdown my_Account_menu pe-4 pb-2">
                        <button class="dropdown-toggle border-0" type="button" id="toggleaccoountmenu" data-bs-toggle="dropdown" aria-expanded="false">
                          
                        </button>
                        <ul id="myAccountmenu" class="dropdown-menu  bg-white shadow radius-5 p-4 " aria-labelledby="toggleaccoountmenu">
                            <li><a href="<?php echo e(url('/my-account')); ?>">My Account</a></li>
                            <li><a href="<?php echo e(url('/myorders')); ?>">Orders</a></li>
                            <li><a href="<?php echo e(url('/wishlist')); ?>">Wishlist</a></li>
                            <li><a href="<?php echo e(url('/update-profile')); ?>">Wallet</a></li>
                            <li><a href="javascript:void(0);" onclick="switchtoseller(<?php echo e($user_id); ?>,this);">Switch to Seller Profile</a></li>
                            <?php
                            if(Auth::check())
                            {
                            ?>
                            <li><a href="<?php echo e(url('/userlogout')); ?>" class="text-danger">Sign Out</a></li>
                            <?php
                            }
                            else
                            {
                            ?>
                            <li><a href="<?php echo e(url('/login')); ?>" class="text-danger">Sign In</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php
    if(Auth::check())
    {
    ?>
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
    <script>
    function switchtoseller(id, ele)
    {
        var user_id = '<?php echo e($user_id); ?>';
        $.ajax({
            type: "post",
            url: "<?php echo e(url('/insertseller')); ?>",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                "user_id": user_id
            },
            success: function(data) {
                //window.location.href = '<?php echo e(url("/seller/dashboard")); ?>';
                window.open('<?php echo e(url("/seller/dashboard")); ?>', '_blank');
            }
        })
    }
    </script>
    <!-- Header End --><?php /**PATH D:\Works\Work-2022\laravel\resources\views/front/include/header.blade.php ENDPATH**/ ?>