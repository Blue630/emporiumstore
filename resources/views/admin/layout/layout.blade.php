<!DOCTYPE html>
<html lang="en">
<head>
 @include('admin.includes.head')
 @yield('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">
@include('admin.includes.header')
   @yield('header')
  <!-- <div class="content-wrapper"> -->
   @yield('content')
  
 
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
    @include('admin.includes.footer')
   @yield('footer')
  <!-- Main Footer -->
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
@include('admin.includes.script')
@yield('script')

</body>
</html>
