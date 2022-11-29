<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
  </nav>
  <!-- sidebar -->
  <style>
      .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;
            background-color: #007bff;
            margin-bottom: 0px;
        }
        .nav-sidebar>.nav-item {
            margin-bottom: 0;
            border-bottom: 1px dotted #33333363;
        }
        .layout-fixed .main-sidebar{
            background: #000;
            color: #fff;
        }
        .nav-pills .nav-link {
            color: #c5c5c5;
        }
        .nav-pills .nav-link:not(.active):hover {
            color: #ffffff;
        }
  </style>

  <aside class="main-sidebar elevation-4">
        <!-- Sidebar -->
    <div class="sidebar" style="margin-top: 0px;">
      <!-- Sidebar user panel (optional) -->
      <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/public/admin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> @if(Auth::check()){{auth()->user()->name}}@endif</a>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if(Auth::check())
                @if(Auth()->user()->is_admin==1)
               <h5>Admin</h5>
          <li class="nav-item">
            <a href="{{url('/admin/home')}}" class="nav-link {{ (request()->is('admin/home'))? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            
          </li>
            @else
            <h5>Seller Admin</h5>
          <li class="nav-item">
            <a href="{{url('/seller/dashboard')}}" class="nav-link {{ (request()->is('seller/dashboard'))? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
             @endif
            @endif
            
            @if(Auth::check())
                @if(Auth()->user()->is_admin==1)
                <li class="nav-item">
            <a href="{{url('/admin/manageorder')}}" class="nav-link {{ (request()->segment(2) == 'manageorder')? 'active' : ''}}">
               <i class="nav-icon fas fa-th"></i>
              <p>Orders</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('/admin/managesubscription')}}" class="nav-link {{ (request()->segment(2) == 'addsubscription' || request()->segment(2) =='managesubscription' || request()->segment(2)=='editsubscription')? 'active' : ''}}">
              <i class="nav-icon fas fa-subscript"></i>
              <p>Subscription</p>
            </a>            
          </li>
          
          <li class="nav-item">
            <a href="{{url('/admin/seller')}}" class="nav-link {{ (request()->segment(2) == 'seller' || request()->segment(2) =='seller' || request()->segment(2)=='seller')? 'active' : ''}}">
              <i class="nav-icon fas fa-portrait"></i>
              <p>Sellers</p>
            </a>            
          </li>
           
          <li class="nav-item">
            <a href="{{url('/admin/buyer')}}" class="nav-link {{ (request()->segment(2) == 'buyer' || request()->segment(2) =='buyer' || request()->segment(2)=='buyer')? 'active' : ''}}">
             <i class="nav-icon fas fa-users"></i>
              <p>Buyers</p>
            </a>
          </li>
              
          <li class="nav-item">
            <a href="{{url('/admin/manage_cate')}}" class="nav-link {{ (request()->segment(2) == 'manage_cate' || request()->segment(2) =='add_cate' || request()->segment(2)=='edit_cate')? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>Category</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{url('/admin/manage_subcat')}}" class="nav-link {{ (request()->segment(2) == 'manage_subcat' || request()->segment(2) =='add_subcat' || request()->segment(2)=='edit_subcat')? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>Subcategory</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{url('/admin/manage_specs')}}" class="nav-link {{ (request()->segment(2) == 'manage_specs' || request()->segment(2) =='add_specs' || request()->segment(2)=='edit_specs')? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>Specification</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{url('/admin/manage_option')}}" class="nav-link {{ (request()->segment(2) == 'manage_option' || request()->segment(2) =='add_option' || request()->segment(2)=='edit_option')? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>Option</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{url('/admin/manageproduct')}}" class="nav-link {{ (request()->segment(2) == 'addprodouct' || request()->segment(2) =='manageproduct' || request()->segment(2)=='editproduct')? 'active' : ''}}">
              <i class="nav-icon fas fa-box"></i>
              <p>Product</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('/admin/managecoupon')}}" class="nav-link {{ (request()->segment(2) == 'addcoupon' || request()->segment(2) =='managecoupon' || request()->segment(2)=='editcoupon')? 'active' : ''}}">
              <i class="nav-icon fas fa-percent"></i>
              <p>Discount Coupon Code</p>
            </a>            
          </li>
          
          <li class="nav-item">
            <a href="{{url('/admin/feature')}}" class="nav-link {{ (request()->segment(2) == 'feature')? 'active' : ''}}">
              <i class="nav-icon fas fa-people-carry"></i><p>Feature Sellers</p>
            </a>
          </li>
          
          
          <li class="nav-item">
            <a href="{{url('/admin/managecommission')}}" class="nav-link {{ (request()->segment(2) == 'addcommission' || request()->segment(2) =='managecommission' || request()->segment(2)=='editcommission')? 'active' : ''}}">
              <i class="fas fa-calculator"></i>
              <p>Commission</p>
            </a>            
          </li>
          
          <li class="nav-item">
            <a href="{{url('/admin/cashback')}}" class="nav-link {{ (request()->segment(2) == 'cashback')? 'active' : ''}}">
              <i class="nav-icon far fa-money-bill-alt"></i>
              <p>Cashback</p>
            </a>
            
          </li>
          
          <li class="nav-item">
            <a href="{{url('/admin/manage_pages')}}" class="nav-link {{ (request()->segment(2) == 'manage_pages')? 'active' : ''}}">
              <i class="nav-icon fas fa-file-word"></i>
              <p>Pages</p>
            </a>
            
          </li>
          
          
          @else
          <li class="nav-item">
            <a href="{{url('/seller/manageorder')}}" class="nav-link {{ (request()->segment(2) == 'manageorder')? 'active' : ''}}">
               <i class="nav-icon fas fa-th"></i>
              <p>Orders</p>
            </a>        
          </li>
              

          <li class="nav-item">
            <a href="{{url('/seller/manageproduct')}}" class="nav-link {{ (request()->segment(2) == 'addprodouct' || request()->segment(2) =='manageproduct' || request()->segment(2)=='editproduct')? 'active' : ''}}">
              <i class="nav-icon fas fa-box"></i>
              <p>Product</p>
            </a>            
          </li>

          <li class="nav-item">
            <a href="{{url('/seller/manageauction')}}" class="nav-link {{ (request()->segment(2) == 'addauction' || request()->segment(2) =='manageauction' || request()->segment(2)=='editauction')? 'active' : ''}}">
              <i class="fa fa-gavel"></i>
              <p>Auction</p>
            </a>            
          </li>
          

          @endif
          @endif

          @if(Auth::check())
          <li class="nav-item">

          <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link"> <i class="nav-icon fas fa-power-off"></i>
          <p>{{ __('Logout') }}</p>
          </a>
          <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>