<nav class="navbar navbar-default navbar-fixed-top ppes-menu-1 lecturer-navigation" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a id="menu-toggle" href="#" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="navbar-brand" href="">
                <h2><i class="icons-ppes fa fa-desktop"></i>PPES</h2>
            </a>
        </div>
        <div class="pull-right log-out"><a href="{{ url('/logout') }}">Log Out<i class="fa fa-power-off"></i></a></div>
        <div id="sidebar-wrapper" class="sidebar-toggle">
            <div class="logo-sidebar hidden-sm hidden-md hidden-lg hidden-xs"><h2><i class="icons-ppes fa fa-desktop"></i>PPES</h2></div>
            <ul>
                <li class="box-shadow-first">
                    <a href="#"><i class="fa fa-user"></i>
                        @if (Auth::check())
                            {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                        @endif
                    </a>
                    <div class="edit-profile"><a href="{{ route('lecturer.edit', ['lecturer' => Auth::id()]) }}">Edit Profile</a></div>
                </li>
                 <a href="{{ route('lecturer.activities.index', ['lecturer' => Auth::id()]) }}">
                   <li class="{{ substr(Route::currentRouteName(), 20, 7) != 'results' ? 'active' : '' }}">
                     Activities
                   </li>
                 </a>
                <a href="{{ route('lecturer.activities.results', ['lecturer' => Auth::id()]) }}">
                  <li class="{{ substr(Route::currentRouteName(), 20, 7) == 'results' ? 'active' : '' }}">
                    Results
                  </li>
                </a>
            </ul>
        </div>
    </div>
</nav>
