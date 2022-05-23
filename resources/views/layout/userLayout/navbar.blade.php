<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        {{-- <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo/sb.png') }}" width="150" height="40" alt="">
          </a> --}}
        <a class="navbar-brand" href="#">
            Sukat<span style="color: green;">Bahay</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">About Us</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Implementing Rules &amp; Regulations 
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 12px">
                        @forelse ($menu as $item)
                        <li class="nav-item dropdown drop-down02">
                            <a class="nav-link add-padding" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $item->title }}
                                @if (count($item['sections'])>0)
                                    <i class="fas fa-angle-double-right float-end"></i>
                                @endif
                            </a>
                            @if (count($item['sections'])>0)
                            <ul class="dropdown-menu sub-menu02" aria-labelledby="navbarDropdown" style="font-size: 12px">
                                @forelse ($item['sections'] as $sub)
                                    <li><a class="dropdown-item" href="#">{{ $sub->section_title }}</a></li>
                                @empty
                                    <li> <a class="dropdown-item" href="#"> Nothing else here</a></li>
                                @endforelse
                            </ul>
                            @endif
                        </li>
                        @empty
                        <li> <a class="dropdown-item" href="#"> Nothing else here</a></li>
                        @endforelse

                    </ul>
                </li>
            </ul>
            <ul class="d-flex navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.register') }}">Register</a>
                </li>
            </ul>
            </ul>
        </div>
    </div>
</nav>