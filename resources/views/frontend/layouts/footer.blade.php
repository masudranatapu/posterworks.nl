@php
$settings = getSetting();
@endphp

    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- about us -->
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper  mb-4 mb-md-0">
                    <div class="footer_widget mb-3">
                        <h3>{{ __('About us') }}</h3>
                    </div>
                    <div class="footer_link">
                        <ul>
                            <li><a href="{{ route('buy-gift-card') }}">{{ __('Buy a Gift Card') }}</a></li>
                            @auth
                                <li><a href="{{ route('login') }}">{{ __('Profile') }}</a></li>
                            @else
                                <li><a href="{{ route('login') }}">{{ __('Sign In') }}</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}">{{ __('Sign Up') }}</a></li>
                                @endif
                            @endauth
                            <li><a href="{{ route('faq') }}">{{ __('Faq') }}</a></li>
                            <li><a href="{{ route('photos') }}">{{ __('Frame Photo') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- follow -->
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper  mb-4 mb-md-0">
                    <div class="footer_widget mb-3">
                        <h3>{{ __('Follow Us') }}</h3>
                    </div>
                    <div class="footer_link">
                        <ul>
                            @if($settings->facebook_url)
                            <li><a href="{{ $settings->facebook_url }}" target="_blank">Facebook</a></li>
                            @endif
                            @if($settings->twitter_url)
                            <li><a href="{{ $settings->twitter_url }}" target="_blank">Twitter</a></li>
                            @endif
                            @if($settings->linkedin_url)
                            <li><a href="{{ $settings->linkedin_url }}" target="_blank">Linkedin</a></li>
                            @endif
                            @if($settings->whatsapp_number)
                            <li><a href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp_number }}" target="_blank">Whatsapp</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- need help -->
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper  mb-4 mb-md-0">
                    <div class="footer_widget mb-3">
                        <h3>{{ __('Need some help?') }}</h3>
                    </div>
                    <div class="footer_article">
                        <p>{{ __('Talk to someone from our real support') }} <br /> {{ __('team, live 24/7') }}</p>
                        <a href="{{ route('contact-us') }}" class="btn btn-primary rounded">{{ __('Contact with Us') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <!-- footer bottom -->
        <div class="footer_bottom text-md-center">
            <!-- row -->
            <div class="row g-3 d-flex align-items-center">
                <div class="col-md-6">
                    <div class="copyright_text text-center float-md-start">
                        <p>&copy; Copyright {{ date('Y') }} {{ $settings->site_name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center float-md-end">
                        <div class="footer_bottom_link">
                            <ul>
                                <li><a href="{{ route('privacy-policy') }}">{{ __('Privacy Policy') }}</a></li>
                                <li><a href="{{ route('terms-condition') }}">{{ __('Tearm & Conditions') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
    </div>

