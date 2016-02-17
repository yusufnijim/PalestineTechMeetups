<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Bootstrap Parallax Template - Lucenta by Binarytheme</title>

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

    <!--REQUIRED STYLE SHEETS-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

    <link href="{{ asset( 'assets/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>
    <script src="{{ asset( 'assets/js/bootstrap-datepicker.js') }}"></script>
    <link href="{{ asset( 'assets/css/style.css') }}" rel="stylesheet"/>

</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    @include('partial.sidebar')
</nav>
<!--End Navigation -->


<!--words Section-->
<section class="for-full-back color-white" id="about">
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container">

        @include('partial.flash')
        @include('partial.error')

        @yield('content')

    </div>

</section>


<!--End Contact Section -->
<!--footer Section -->
<div class="for-full-back " id="footer">
    {{ date("Y") }} www.NablusTechMeetups.com | All Right Reserved

</div>
<!--End footer Section -->

</body>
</html>
