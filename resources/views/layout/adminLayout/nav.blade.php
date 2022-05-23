<div class="topbar-left	d-none d-lg-block">
    <div class="text-center">
        
        <a href="#" class="logo"><img src="{{ asset('assets/images/logo-new.png') }}" height="30" alt="logo"></a>
    </div>
</div>

<nav class="navbar-custom">

    <ul class="list-inline float-right mb-0">
      
        <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <span style="font-size: 13px" class="badge badge-success badge-pill pt-1">{{ ucfirst(auth()->user()->user_type) }}</span>
            </a>
        </li>

        <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            role="button">
                <i class="mdi mdi-power noti-icon"></i>
            </a>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

       

        {{-- <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                <a class="dropdown-item" href="#"><span class="badge badge-success mt-1 float-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
                <a class="dropdown-item" href="#"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
            </div>
        </li> --}}

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="list-inline-item">
            <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
            </button>
        </li>
    </ul>

    <div class="clearfix"></div>

</nav>