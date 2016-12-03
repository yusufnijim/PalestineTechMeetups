<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- meta name="description" content="">
    <meta name="author" content="" -->
    <title>{{ isset($title) ? $title . " | " : ""  }} Palestine Tech Meetups</title>

    <!-- Bootstrap Core CSS -->
    <!-- link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" -->

    <!-- MetisMenu CSS -->
    <!-- link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" -->

    <!-- Custom CSS -->
    <!--link href="/dist/css/sb-admin-2.css" rel="stylesheet" -->

    <!-- Custom Fonts -->
    <!-- link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" -->
<!-- salah -->
<link href="/assets/frontend/css/providers.css" rel="stylesheet">
    <link href="/assets/frontend/css/rtl_main.css" rel="stylesheet">

<!-- salah -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
@include('partial/_slider_menu') 

@yield("content")
<!-- Footer -->
    @include('partial/_footer')
      <!-- //Footer -->
      <script src="{{url('assets/frontend/js/providers-debug.js')}}"></script>
    <script src="{{url('assets/frontend/js/client-debug.js')}}"></script>

  </body>
</html>