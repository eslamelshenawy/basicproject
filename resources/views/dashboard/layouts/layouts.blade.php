<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    @include('dashboard.includes.head')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- start Navbar -->
    @include('dashboard.includes.navbar')
    <!-- end Navbar -->
    
    <!-- start Sidebar -->
    @include('dashboard.includes.Sidebar')
    <!-- end Sidebar -->

    <div class="content-wrapper">

    <!-- start header -->
    @include('dashboard.includes.header')
    <!-- end header -->

    <!-- Content Section -->
    @yield('content')
    <!-- end of Content Section -->

    </div>
        <!-- start footer -->
    @include('dashboard.includes.footer')
         <!-- end footer -->

</div>
    @include('dashboard.includes.foot')

    @yield('js')

</body>
</html>
