<!-- Sidebar -->
      <section class="sidebar hidden">
        <div class="sidebar--close sidebar-trigger">
          <a href="#">
            <i class="fa fa-times" aria-hidden="true"></i>
          </a>
        </div>
        <div class="sidebar--links">
          <ul class="sidebar--list">
            <li><a href="#">{{trans('frontend/index.Programs') }}</a></li>
            <li><a href="/news">{{trans('frontend/index.News') }}</a></li>
            <li><a href="/timeline">{{ trans('frontend/index.Events') }}</a></li>
            <li><a href="#">{{ trans('frontend/index.Team') }}</a></li>
            <li><a href="/about">{{trans('frontend/index.About') }}</a></li>
            <li><a href="#">{{trans('frontend/index.Contact') }}</a></li>
          </ul>
        </div>
      </section>
      <!-- //Sidebar -->

      <section class="user-section">
        <ul>
          <li>
            <a class="lang" href="#">
              عربي
            </a>
          </li>
          <li>
            <a class="user" href="#">
              User login
            </a>
          </li>
          <li>
            <a class="user-circle" href="#">
              Hi! (Salahuddin)
            </a>
          </li>
          <li>
            <a class="logout" href="#">
              Logout
            </a>
          </li>
        </ul>
      </section>

      <!-- Header and nav -->
      <section class="header">
        <div class="top-bar"></div>
        <nav class="container">
          <div class="row">
            <div class="logo-container col-md-3">
              <a href="/index">
                <img class="logo" src="{{url('assets/frontend/images/logo.png')}}" alt="" />
              </a>
            </div>
            <div class="nav-links col-md-9 hidden-sm hidden-xs">
              <ul class="navbar">
                <li><a href="#">{{trans('frontend/index.Programs') }}</a></li>
                <li><a href="/news">{{trans('frontend/index.News') }}</a></li>
                <li><a href="/timeline">{{ trans('frontend/index.Events') }}</a></li>
                <li><a href="#">{{ trans('frontend/index.Team') }}</a></li>
                <li><a href="/about">{{trans('frontend/index.About') }}</a></li>
                <li><a href="#">{{trans('frontend/index.Contact') }}</a></li>
              </ul>
            </div>
            <div class="sidebar-trigger visible-sm visible-xs">
              <a href="#">
                <img src="assets/frontend/images/bars.png" alt="" />
              </a>
            </div>
          </div>
        </nav>
      </section>
