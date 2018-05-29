<ul id="menu" class="page-sidebar-menu">
    <!-- DASHBOARD -->
    <li {!! (Request::is('dashboard') ? 'class="active"' : '') !!}>
        <a href="{{ route('investor-dashboard') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>

    <!-- FIND INVESTMENT -->
    <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="rocket" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Investments</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('groups') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ route('investments-admin-all-investments') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Get All Investments
                </a>
            </li>
        </ul>
        <ul class="sub-menu">
            <li {!! (Request::is('groups') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ route('investments-admin-create-investments') }}">
                    <i class="fa fa-angle-double-right"></i>
                    New Investments
                </a>
            </li>
        </ul>
    </li>
    
    <!-- BLANK PAGE -->
    <li {!! (Request::is('blank') ? 'class="active"' : '') !!}>
        <a href="{{ URL::to('blank') }}">
            <i class="livicon" data-name="flag" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Blank Page</span>
        </a>
    </li>

    <!-- Menus generated by CRUD generator -->
    @include('layouts/menu')
</ul>
