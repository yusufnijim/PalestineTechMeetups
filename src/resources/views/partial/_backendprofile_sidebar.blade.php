<nav class="navbar navbar-default" role="navigation">
    <div class="container">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- a class="navbar-brand" href="#featured">logooooo <span class="subhead">Nablus Tech meetups</span></a -->
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/index">Home</a></li>
         
          <li><a href="/event">Events </a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/about">About Us</a></li>
        <li>  <a href="/contact">Contact us </a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container 
  </nav >

<!-- div class="search-div" style="float:left">
        <form action="/search"><input name="q" type='search'></form>
    </div>

  

    <ul class="nav navbar-top-links navbar-right">

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php
                    $active_language_icon = "ps.png";
                    /*if(session('locale') == 'en') {
                        $active_language_icon = "usa.png";
                    }*/
                ?>
                <i class=""><img width=20 src="/assets/img/{{ $active_language_icon }}"></i>
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="/language/ar"><img src="/assets/img/ps.png">Arabic</a>
                </li>
                <li>
                    <a href="/language/En"><img src="/assets/img/usa.png">English</a>
                </li>

            </ul>

            <!-- /.dropdown-user -->
        <!-- /li>

        <!-- /.dropdown -->
        <!-- li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                @if(auth()->check() )
                    <li><a href="/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                @endif
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                @if(!auth()->check() )
                    <li><a href="/user/login"><i class="fa fa-sign-out fa-fw"></i> Login</a>
                @else
                    <li><a href="/user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        @endif
                    </li>
            </ul>
            <!-- /.dropdown-user -->
        <!-- /li>
        <!-- /.dropdown -->
    <!-- /ul>
    <!-- /.navbar-top-links -->
<!-- s/nav>