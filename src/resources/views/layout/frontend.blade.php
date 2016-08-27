<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{ isset($title) ? $title . " | " : ""  }} Nablus Tech Meetups</title>

    <!-- Bootstrap Core CSS -->

    <!-- I have changed the url to reach the css files -->

      <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/styles.css">

    <!-- link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" -->

    <!-- MetisMenu CSS -->
    <!-- link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" -->

    <!-- Custom CSS -->
    <!-- link href="/dist/css/sb-admin-2.css" rel="stylesheet" -->

    <!-- Custom Fonts -->
    <!-- link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<script type="text/javascript" src="js/jssor.slider.min.js"></script>
    <!-- use jssor.slider.debug.js instead for debug -->
    <script type="text/javascript" src="js/teamslider.js"></script>

<div class="container">
<div class="row">
<div class="logo col-lg-3 col-xs-6"> <img src="images/en2.png"> </div>

<div class="language logo col-lg-3  col-lg-offset-6 col-xs-6 " ><p> language  </p></div>
</div>

</div>
@include('partial/_profile_sidebar')



<!-- div id="wrapper" -->

    
    <!-- Page Content -->
    <!-- div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" -->
                    <!-- h1 class="page-header">{{ @$title }}toot</h1 -->

                    @include('partial/_error')
                    @include('partial/_flash')
                    @yield('content')

         

</body>

</html>
