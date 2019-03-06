<nav class="navbar navbar-fixed-top" role=navigation>
    <div class=navbar-header>
        <button type=button class=navbar-toggle data-toggle=collapse data-target=.navbar-collapse>
            <span class=sr-only>Toggle navigation</span>
            <i class=material-icons>apps</i>
        </button>
        <a class=navbar-brand href="{{ route('dashboard') }}">
            <img class=main-logo src="{{$PUBLIC_ASSETS}}/img/forweb2.jpg" alt="Quran">
        </a>
    </div>
    <div class=nav-container>
        <ul class="nav navbar-nav hidden-xs">
            <li><a id=fullscreen href="#"><i class="fa fa-arrows-alt"></i> </a></li>
            <li><a href="javascript:;" class="btn-buy hidden-xs hidden-sm hidden-md">{{ Auth::user()->name }}</a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right">
            <li class=log_out>
                <a class="dropdown-item" href="{{ route('admin-logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                     <i class=material-icons>power_settings_new</i>
                </a>
            </li>
        </ul>
    </div>
</nav>