<?php

use App\Models\Admin;

$admin=Admin::first();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Creamee</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}" >
    <link rel="shortcut icon" href="{{ asset('images/creamee_logo.png')}}" />

    @yield('head')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="#">
          <h4 style="color:white">CREAMEE</h4>
            <!-- <img src="{{ asset('images/logo2.png')}}" alt="logo" class="logo-dark" /> -->
          </a>
          <a class="navbar-brand brand-logo-mini" href="#">
          <!-- <img src="{{ asset('images/creamee_logo.png')}}" alt="logo" /> -->
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome CREAMEE dashboard!</h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">
            <!-- <form class="search-form d-none d-md-block" action="#">
              <i class="icon-magnifier"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form> -->

            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ml-2" src="{{asset('images/portfolio/admin-profile.png')}}" alt="Profile image"> <span class="font-weight-normal"> Admin </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="{{asset('images/portfolio/admin-profile.png')}}" style="width:20%" alt="Profile image">
                  <p class="mb-1 mt-3">Admin</p>
                  <p class="font-weight-light text-muted mb-0">{{$admin->email}}</p>
                </div>
                <a class="dropdown-item" href="{{url('/profile')}}"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form-admin-id').submit();">
                                                     <i class="dropdown-item-icon icon-power text-primary"></i>Log Out</a>
              </div>
              <form id="logout-form-admin-id" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
            </form>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper" style="padding-left:0px">

    <!-- Sidebar Menu -->
    @include('layouts.admin-sidebar')
    <div class="main-panel">
          <div class="content-wrapper">
@yield("content")
          </div>
    </div>

</div>

      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js')}}"></script>
    <script src="{{ asset('js/misc.js')}}"></script>
    <!-- endinject -->
    @yield('script')
  </body>
</html>