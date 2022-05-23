 <!-- Start main left sidebar menu -->
 <div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">SUKATBAHAY</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">SB</a>
        </div>
     
        <ul class="sidebar-menu">
            <li class="menu-header ">Main</li>
                <li class="{{ Request::segment(2)=='dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-fire"></i><span>Dashboard</span>
                    </a>
                </li>
            <li>
            <li class="menu-header ">Management</li>
                <li class="{{ Request::segment(2)=='user' ? 'active' : '' }}">
                    <a href="{{ route('admin.user') }}" class="nav-link">
                        <i class="fas fa-users"></i><span>Users</span>
                    </a>
                </li>
                <li class="{{ (Request::segment(2)=='rule' || Request::segment(2)=='section') ? 'active' : '' }}">
                    <a href="{{ route('admin.rule') }}" class="nav-link">
                        <i class="fas fa-book-reader"></i><span>Rule</span>
                    </a>
                </li>
                <li class="{{ Request::segment(2)=='account' ? 'active' : '' }}">
                    <a href="{{ route('admin.account') }}" class="nav-link">
                        <i class="fas fa-user-shield"></i><span>Account</span>
                    </a>
                </li>
               
            <li class="menu-header ">Exercises</li>
            @foreach ($rulesList as $item)
            <li class="{{ (Request::segment(2)=='exercises' && Request::segment(3)==$item->id) ? 'active' : '' }}">
                <a href="{{ route('admin.exercises',$item->id) }}" class="nav-link">
                    <i class="far fa-dot-circle"></i><span>{{ ucfirst(strtolower(explode("-",$item->title)[0])) }}</span>
                </a>
            </li>     
            @endforeach
           
            <li>
                <a class="nav-link text-danger" href="{{ route('auth.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
            </li>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                @csrf
            </form>   
        </ul>
      
    </aside>
</div>