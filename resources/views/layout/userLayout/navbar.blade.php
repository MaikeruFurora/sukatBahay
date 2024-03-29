<nav class="navbar navbar-expand-lg {{  Request::segment(1)==''?'navbar-light':'navbar-green ' }} ">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            Sukat Bahay
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 py-2 mb-lg-0">
               <li class="nav-item">
                    <a class="nav-link" href="{{ route('aboutUs') }}">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Implementing Rules &amp; Regulations 
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 13px;">
                        @forelse ($menu as $item)
                        <li class="dropdown-submenu">
                            <a class="dropdown-item di-width" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $item->title }}
                                {{-- @if (count($item['sections'])>0)
                                    <i class="fas fa-angle-double-right float-end"></i>
                                @endif --}}
                            </a>
                            @if (count($item['sections'])>0)
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 13px">
                                @forelse ($item['sections'] as $sub)
                                    <li><a class="dropdown-item di-width" href="{{ url("rule-content/".$item->slug."/".$sub->slug) }}">{{ $sub->section_title }}</a></li>
                                @empty
                                    <li> <a class="dropdown-item di-width" href="#"> Nothing else here</a></li>
                                @endforelse
                            </ul>
                            @endif
                        </li>
                        @empty
                        <li> <a class="dropdown-item di-width" href="#"> Nothing else here</a></li>
                        @endforelse

                    </ul>
                </li>
              
            </ul>
            <ul class="d-flex navbar-nav mb-2 mb-lg-0">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.register') }}">Register</a>
                </li>
                @endguest
                @auth
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" style="padding: 12px" href="{{ route('user.profile') }}"><i class="far fa-user-circle"></i>&nbsp;&nbsp;Profile</a></li>
                      {{-- <li><hr class="dropdown-divider"></li> --}}
                      <li>
                        <a class="dropdown-item" 
                        style="padding: 12px"
                        href="{{ route('auth.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        ><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Logout</a>
                          <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    </ul>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="far fa-bookmark" style="font-size: 16px"></i> Bookmark</a>
                </li>
                @endauth
            </ul>
            </ul>
        </div>
    </div>
</nav>