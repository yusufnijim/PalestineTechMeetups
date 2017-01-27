<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield("title")

    <link href="{{url('/assets/frontend/css/providers.css')}}" rel="stylesheet">
    <link href="{{url('/assets/frontend/css/rtl_main.css')}}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Sidebar -->
@include('partial/_slider_menu')
<!-- //Header and nav -->

@include('partial/_flash')
@include('partial/_error')

@yield("content")

@include('partial/_footer')
<script src="{{url('assets/frontend/js/providers-debug.js')}}"></script>
<script src="{{url('assets/frontend/js/client-debug.js')}}"></script>

</body>
</html>