<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>{{ config('app.name', 'Creamee') }}</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/flexslider.css">
        <link rel="stylesheet" href="css/jquery.fancybox.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-icon.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style type="text/css">
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
   
        
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<!-- <html class="no-js" lang=""> -->
<!--<![endif]-->
<!-- <head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Adriya - Minimal, Creative, One Page Bootstrap Template</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/animate.min.css">
<link rel="stylesheet" href="css/font-icon.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body> -->
<!-- header top section -->
<body>
<!-- header top section --> 
<!-- header content section -->
<section id="hero" class="section ">
  <div class="container">
    <div class="row">
      <div>
        <div class="hero-content">
        <div style="display:block;text-align:left"><img align="left" src="{{asset('images/portfolio/download.png')}}" alt="" width="15%"><br><h2>Online Cake Ordering</h2>
</div>
          

        </div>
      </div>
    </div>
  </div>
</section>
<!-- header content section --> 
<!-- portfolio grid section -->
<section id="portfolio">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <hr class="section">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 portfolio-item"> <a href="{{ route('vendorLogin') }}" class="portfolio-link">
        <div class="caption">
          <div class="caption-content">
            <h3>Sign in as Cake Vendor</h3>
            <!-- <h4>Branding/Graphic</h4> -->
          </div>
        </div>
        <img src="{{asset('images/portfolio/vendor.png')}}" class="img-responsive" alt=""> </a> </div>
      <div class="col-sm-6 portfolio-item"> <a href="{{ route('adminLogin') }}" class="portfolio-link">
        <div class="caption">
          <div class="caption-content">
            <h3>Sign in as Admin</h3>
            <!-- <h4>Branding</h4> -->
          </div>
        </div>
        <img src="{{asset('images/portfolio/admin.png')}}" class="img-responsive" alt=""> </a> </div>
    </div>
  </div>
</section>

<!-- service section --> 
<!-- footer section -->
<footer class="footer">
  <div class="container">
    <div class="col-md-6 left">
      <h4>Final Year Project</h4>
    </div>
    <div class="col-md-6 right">
      <p>© 2021 All rights reserved. All Rights Reserved<br>
        Made with <i class="fa fa-heart pulse"></i> by __ping</p>
    </div>
  </div>
</footer>
<!-- footer section --> 

<!-- JS FILES --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.fancybox.pack.js"></script> 
<script src="js/retina.min.js"></script> 
<script src="js/modernizr.js"></script> 
<script src="js/main.js"></script>



        </div>
    </body>
</html>
