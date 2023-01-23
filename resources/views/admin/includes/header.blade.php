<header class="navbar top_header navbar-expand-md navbar-light d-print-none d-md-none d-lg-none d-xl-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('home') }}">
                <img src="{{ asset($settings->site_logo) }}" width="110" height="32"
                    alt="{{ $settings->site_name }}" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            {{-- @if (count(config('app.languages')) > 1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-language" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 7h7m-2 -2v2a5 8 0 0 1 -5 8m1 -4a7 4 0 0 0 6.7 4"></path>
                            <path d="M11 19l4 -9l4 9m-.9 -2h-6.2"></path>
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        {{ strtoupper(app()->getLocale()) }}
                    </span>
                </a>
                <div class="dropdown-menu language_dropdown">
                    <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            @foreach (config('app.languages') as $langLocale => $langName)
                            <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">
                                {{ strtoupper($langLocale) }} ({{ $langName }})
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>
            @endif --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="">
                        @if (Auth::user()->profile_image)
                            <img src="{{ asset(Auth::user()->profile_image) }}" alt="{{ auth::user()->name }}"
                                class="avatar avatar-sm avatar-rounded">
                        @else
                            <img src="{{ asset('assets/img/avatar/1.jpg') }}" alt="{{ auth::user()->name }}"
                                class="avatar avatar-sm avatar-rounded">
                        @endif
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-muted">{{ __('Administrator') }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('admin.account') }}" class="dropdown-item">{{ __('Profile & account') }}</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form class="logout" id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
