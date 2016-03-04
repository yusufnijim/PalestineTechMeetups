<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"
           href="/">YOUR LOGO </a>
    </div>
    <!-- Collect the nav links for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="/">Home</a>
            <li><a href="/event">Events</a>
            <li><a href="/blog">Blog</a>
            <li><a href="/user">Users</a>
            </li>
                @if(auth()->check())
                <li>
                    <a href="/user/profile">
                        My Profile
                    </a>
                </li>
                <li>
                    <a href="/logout">log out</a>
                </li>
                @else
                    <li>
                        <a href="/user/register">Sign up</a>
                    </li>
                @endif

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container -->
