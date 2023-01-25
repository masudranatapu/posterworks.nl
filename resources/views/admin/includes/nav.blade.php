<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar menu_bar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item @yield('dashboard')">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item @yield('cards')">
                        <a class="nav-link" href="{{ route('admin.cards') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="3" y="4" width="18" height="16" rx="3">
                                    </rect>
                                    <circle cx="9" cy="10" r="2"></circle>
                                    <line x1="15" y1="8" x2="17" y2="8"></line>
                                    <line x1="15" y1="12" x2="17" y2="12"></line>
                                    <line x1="7" y1="16" x2="17" y2="16"></line>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Cards') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown @yield('plans')">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-businessplan" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <ellipse cx="16" cy="6" rx="5" ry="3"></ellipse>
                                    <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                    <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                    <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                    <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                    <path d="M5 15v1m0 -8v1"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Plans') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item @yield('plan')" href="{{ route('admin.plans') }}">
                                {{ __('All Plans') }}
                            </a>
                            <a class="dropdown-item @yield('add_plan')" href="{{ route('admin.add.plan') }}">
                                {{ __('Add Plan') }}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item @yield('users')">
                        <a class="nav-link" href="{{ route('admin.user.index') }}">
                            <i class="fa fa-user-alt"></i> &nbsp;
                            <span class="nav-link-title">
                                {{ __('Users') }}
                            </span>
                        </a>
                    </li>

                    {{-- <li class="nav-item dropdown @yield('blogs')">
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">
                        <span class="nav-link-title">
                            {{ __('Blog Post') }}
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item @yield('blog')" href="{{ route('admin.blog') }}">
                            {{ __('All Post') }}
                        </a>
                        <a class="dropdown-item @yield('category')" href="{{ route('admin.category.index') }}">
                            {{ __('Post Category') }}
                        </a>
                    </div>
                </li> --}}

                    {{--
                <li class="nav-item @yield('subscribers')">
                    <a class="nav-link" href="{{ route('admin.subscriber.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Subscribers') }}</span>
                    </a>
                </li> --}}

                    <li class="nav-item @yield('reviews')">
                        <a class="nav-link" href="#">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path
                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">{{ __('Reviews') }}</span>
                        </a>
                    </li>

                    {{-- <li class="nav-item  @yield('guide')">
                        <a class="nav-link" href="{{ route('admin.user.guide') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1" stroke-linecap="square" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('User Guides') }}
                            </span>
                        </a>
                    </li> --}}
                    <li class="nav-item dropdown @yield('settings')">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                    </path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Settings') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('admin.settings') }}"
                                class="dropdown-item @yield('setting')">{{ __('General Settings') }}</a>
                            <a href="#" class="dropdown-item @yield('payment_method')">{{ __('Payment Methods') }}</a>
                            <a href="#" class="dropdown-item @yield('transaction')">{{ __('Transactions') }}</a>
                            <a href="{{ route('admin.pages') }}"
                                class="dropdown-item @yield('page')">{{ __('Pages') }}</a>
                            <a href="{{ route('admin.cpage.index') }}"
                                class="dropdown-item @yield('custom_page_list')">{{ __('Custom Pages') }}</a>
                            <a href="#" class="dropdown-item @yield('faq')">{{ __('Faqs') }}</a>
                            <a href="#" class="dropdown-item @yield('social_icon')">{{ __('Social Icon') }}</a>
                            <a href="{{ route('admin.tax.setting') }}"
                                class="dropdown-item @yield('invoice')">{{ __('Invoice & Tax') }}</a>
                            <a href="#" class="dropdown-item @yield('clear_cache')">{{ __('Clear cache') }}</a>
                            <a href="" class="dropdown-item @yield('admin-users')"><span
                                    class="nav-link-title">{{ __('Admin Users') }}</span></a>
                            <a href="#" class="dropdown-item @yield('change_password')"><span
                                    class="nav-link-title">{{ __('Change Password') }}</span></a>
                        </div>
                    </li>

                    <li class="nav-item dropdown @yield('admin')">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <img width="30" src="{{ getProfile(Auth::user()->profile_image) }}"
                                    class="img-fluid" alt="{{ auth::user()->name }}">
                            </span>
                            <span class="nav-link-title">
                                {{ auth::user()->name }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('admin.account') }}"
                                class="dropdown-item @yield('admin.account')">{{ __('Profile & account') }}</a>
                            <a href="{{ route('logout') }}" class="dropdown-item @yield('logout')"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form class="logout" id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>


                        </div>
                    </li>




                </ul>
            </div>
        </div>
    </div>
</div>
