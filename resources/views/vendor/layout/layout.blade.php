<!DOCTYPE html>
<html lang="en">
<head>
 @include('vendor.includes.head')
 @yield('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">
@include('vendor.includes.header')
   @yield('header')
  <!-- <div class="content-wrapper"> -->
   @yield('content')
  
 
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
    @include('vendor.includes.footer')
   @yield('footer')
  <!-- Main Footer -->
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
@include('vendor.includes.script')
@yield('script')

</body>
</html>
