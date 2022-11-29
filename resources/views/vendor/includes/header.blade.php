
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
          <li class="nav-item">
            <a href="{{url('/vendor/dashboard')}}" class="nav-link {{ (request()->segment(2)=='dashboard')? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            
          </li>

          <li class="nav-item">
            <a href="{{url('/vendor/manageproduct')}}" class="nav-link {{ (request()->segment(2) == 'addprodouct' || request()->segment(2) =='manageproduct' || request()->segment(2)=='editproduct')? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manage Product
              </p>
            </a>
            
          </li>
        

          <li class="nav-item">
            <a href="{{url('/vendor/manageorder')}}" class="nav-link {{ (request()->segment(2) == 'manageorder')? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manage Customer Orders
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{url('/vendor/managebuyerorder')}}" class="nav-link {{ (request()->segment(2) == 'managebuyerorder')? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manage Buyer Orders
              </p>
            </a>
            
          </li>
          @if(Session()->has('logged_vendor'))
            @php $vendorprofile=Session()->get('logged_vendor')->storeslug@endphp
          @endif
          <li class="nav-item">
            <a href="{{url('/vendor/storeupdate')}}" class="nav-link {{ (request()->segment(2) == 'storeupdate')? 'active' : ''}}" >
              <i class="nav-icon fas fa-th"></i>
              <p>
                Update Store
              </p>
            </a>
            
          </li>

          <li class="nav-item">
            <a href="{{url('/vendor/vendorlogout')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Logout
              </p>
            </a>
            
          </li>          
         
        
        
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>