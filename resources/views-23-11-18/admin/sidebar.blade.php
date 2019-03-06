<div class=sidebar role=navigation>
    <div class="sidebar-nav navbar-collapse">
        <ul class=nav id=side-menu>
            <li @if(admin_uri() == 'dashboard') class=active @endif><a href={{ route('dashboard') }} class=material-ripple><i class="fa fa-dashboard"></i> Dashboard</a></li>  
            @if(\Auth::user()->role == 3)
            @php
                if(admin_uri() == 'add-admin' OR admin_uri() == 'all-admins' OR admin_uri() == 'edit-user')
                    $selected = true;
                else
                    $selected = false;
            @endphp
            <li @if($selected) 
                class=active @endif>
                <a href="#" class="material-ripple" aria-expanded="@if($selected) true @else false @endif"><div class="material-ink animate" style="height: 247px; width: 247px; top: -88.5px; left: 15.5px;"></div><i class="fa fa-leanpub"></i> Admin<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse @if($selected) in @endif" aria-expanded="@if($selected) true @else false @endif" @if($selected) style @else style="height: 0px;"@endif>
                    <li class={{ (admin_uri() == 'add-admin')? 'active' : '' }}><a href="{{ route('add-admin') }}"><i class="fa fa-plus"></i> Add</a></li>
                    <li class={{ (admin_uri() == 'all-admins')? 'active' : '' }}><a href="{{ route('all-admin') }}"><i class="fa fa-bars"></i> All<span class="nav-tag red pull-right">{{ users_count() }}</span></a></li>
                </ul>
            </li>
            @endif
            @php
                if(admin_uri() == 'add-surah' OR admin_uri() == 'all-surahs' OR admin_uri() == 'edit-surah' OR admin_uri() == 'add-verse' OR admin_uri() == 'all-verses' OR admin_uri() == 'edit-verse')
                    $selected = true;
                else
                    $selected = false;
            @endphp
            <li @if($selected) 
                class=active @endif>
                <a href="#" class="material-ripple" aria-expanded="@if($selected) true @else false @endif"><div class="material-ink animate" style="height: 247px; width: 247px; top: -88.5px; left: 15.5px;"></div><i class="fa fa-leanpub"></i> Surah<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse @if($selected) in @endif" aria-expanded="@if($selected) true @else false @endif" @if($selected) style @else style="height: 0px;"@endif>
                    <li class={{ (admin_uri() == 'add-surah')? 'active' : '' }}><a href="{{ route('add-surah') }}"><i class="fa fa-plus"></i> Add</a></li>
                    <li class={{ (admin_uri() == 'all-surahs')? 'active' : '' }}><a href="{{ route('all-surahs') }}"><i class="fa fa-bars"></i> All<span class="nav-tag red pull-right">{{ surahs_count() }}</span></a></li>
                </ul>
            </li>

            @php
                if(admin_uri() == 'add-juz' OR admin_uri() == 'all-juzs' OR admin_uri() == 'edit-juz')
                    $selected = true;
                else
                    $selected = false;
            @endphp
            <li @if($selected) 
                class=active @endif>
                <a href="#" class="material-ripple" aria-expanded="@if($selected) true @else false @endif"><div class="material-ink animate" style="height: 247px; width: 247px; top: -88.5px; left: 15.5px;"></div><i class="fa fa-leanpub"></i> Juz<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse @if($selected) in @endif" aria-expanded="@if($selected) true @else false @endif" @if($selected) style @else style="height: 0px;"@endif>
                    <li class={{ (admin_uri() == 'add-juz')? 'active' : '' }}><a href="{{ route('add-juz') }}"><i class="fa fa-plus"></i> Add</a></li>
                    <li class={{ (admin_uri() == 'all-juzs')? 'active' : '' }}><a href="{{ route('all-juzs') }}"><i class="fa fa-bars"></i> All<span class="nav-tag red pull-right">{{ juzs_count() }}</span></a></li>
                </ul>
            </li>
            @php
                if(admin_uri() == 'all-bug-reports')
                    $selected = true;
                else
                    $selected = false;
            @endphp
            <li @if($selected) 
                class=active @endif>
                <a href="#" class="material-ripple" aria-expanded="@if($selected) true @else false @endif"><div class="material-ink animate" style="height: 247px; width: 247px; top: -88.5px; left: 15.5px;"></div><i class="fa fa-bug"></i> Bug Reports<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse @if($selected) in @endif" aria-expanded="@if($selected) true @else false @endif" @if($selected) style @else style="height: 0px;"@endif>
                    <li class={{ (admin_uri() == 'all-bug-reports')? 'active' : '' }}><a href="{{ route('all-bug-reports') }}"><i class="fa fa-bars"></i> All<span class="nav-tag red pull-right">{{ reports_count() }}</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>