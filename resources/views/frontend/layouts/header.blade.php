
@php
$settings = getSetting();
@endphp

<header class="header_section section sticky-top">
    <!-- container-fluid -->
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-4">
                <!-- offcanvas menu -->
                <div class="sidebar_menu">
                    <a data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu"
                        aria-labelledby="staticBackdropLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                                <a href="{{ route('home') }}">
                                    <img src="{{ getLogo($settings->site_logo) }}" class="img-fluid" width="120"
                                        alt="logo" />
                                </a>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">
                            <div class="offcanvas_menu">
                                <div class="header">
                                    @auth
                                        <div class="d-flex position-relative align-items-center">
                                            <img src="{{ getProfile($settings->site_logo) }}" width="50"
                                                alt="image">
                                            <div class="user_info">
                                                <h5>{{ Auth::user()->name }}</h5>
                                                <a href="{{ route('logout') }}"  class="text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <p><strong>{{ __('Sign Up') }}</strong>to save your progress & track orders</p>
                                        <a href="{{ route('login') }}" class="btn btn-primary">{{ __('Sign up') }} / {{ __('Sign in') }}</a>
                                    @endauth
                                </div>
                                <ul>
                                    <li>
                                        <a href="{{ route('photos') }}">
                                            <img src="{{ asset('assets/images/icons/frame.svg') }}" alt="icon" />
                                            <span>Frame Your Photos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('buy-gift-card') }}">
                                            <img src="{{ asset('assets/images/icons/gift.svg') }}" alt="icon" />
                                            <span>Buy a Gift Card</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#promocodeModal">
                                            <img src="{{ asset('assets/images/icons/promo_code.svg') }}"
                                                alt="icon" />
                                            <span>Change Promo Code</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('checkout') }}">
                                            <img src="{{ asset('assets/images/icons/orders.svg') }}" alt="icon" />
                                            <span>Checkout</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faq') }}">
                                            <img src="{{ asset('assets/images/icons/faq.svg') }}" alt="icon" />
                                            <span>{{ __('Frequent Questions') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('assets/images/icons/chat.svg') }}" alt="icon" />
                                            <span>Chat with us</span>
                                        </a>
                                    </li>
                                    <div class="mt-2 mb-2">
                                        <hr>
                                    </div>
                                    <li class="ps-1">
                                        <a href="{{ route('privacy-policy') }}">
                                            <span>{{ __('Privacy Policy') }}</span>
                                        </a>
                                    </li>
                                    <li class="ps-1">
                                        <a href="{{ route('terms-condition') }}">
                                            <span>{{ __('Terms & Conditons') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- offcanvas menu -->
            </div>
            <div class="col-4">
                <!-- logo -->
                <div class="logo text-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" width="120"
                            alt="logo" />
                    </a>
                </div>
                <!-- logo -->
            </div>
            <div class="col-4">
                <!-- chat icon -->
                <div class="chat_icon float-end">
                    <a href="javascript:void(0)">
                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="width: 32px; height: 32px; color: rgb(43, 5, 20);">
                            <path
                                d="M12.0002 16.0999C12.7402 16.0999 13.3402 15.5 13.3402 14.7599C13.3402 14.0199 12.7402 13.4199 12.0002 13.4199C11.2601 13.4199 10.6602 14.0199 10.6602 14.7599C10.6602 15.5 11.2601 16.0999 12.0002 16.0999Z"
                                fill="currentColor"></path>
                            <path
                                d="M15.9801 16.0999C16.7202 16.0999 17.3201 15.5 17.3201 14.7599C17.3201 14.0199 16.7202 13.4199 15.9801 13.4199C15.2401 13.4199 14.6401 14.0199 14.6401 14.7599C14.6401 15.5 15.2401 16.0999 15.9801 16.0999Z"
                                fill="currentColor"></path>
                            <path
                                d="M20.0002 16.0999C20.7402 16.0999 21.3402 15.5 21.3402 14.7599C21.3402 14.0199 20.7402 13.4199 20.0002 13.4199C19.2601 13.4199 18.6602 14.0199 18.6602 14.7599C18.6602 15.5 19.2601 16.0999 20.0002 16.0999Z"
                                fill="currentColor"></path>
                            <path
                                d="M22.59 20.44H11.15L9.06 23.02C8.66 23.4 8 23.12 8 22.18L8.04 10.02C8.04 9.63 8.67 9 9.45 9H22.63C23.41 9 24 9.62 24 10.4V19.04C24 19.82 23.37 20.45 22.59 20.45V20.44Z"
                                stroke="currentColor" stroke-width="2" stroke-miterlimit="10"></path>
                        </svg>
                    </a>
                </div>
                <!-- chat icon -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container-fluid -->
</header>

<div class="modal fade" id="promocodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Promo Code</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="promo_code" class="form-label">Your Code</label>
                        <input type="text" name="promo_code" id="promo_code" class="form-control"
                            placeholder="Enter here..." required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary rounded">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
