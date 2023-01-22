
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- about us -->
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper  mb-4 mb-md-0">
                    <div class="footer_widget mb-3">
                        <h3>About us</h3>
                    </div>
                    <div class="footer_link">
                        <ul>
                            <li><a href="{{ route('buy.gift.card') }}">Buy a Gift Card</a></li>
                            @auth
                                <li><a href="{{ route('login') }}">Profile</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Sign In</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                                @endif
                            @endauth
                            <li><a href="{{ route('faq') }}">Faq</a></li>
                            <li><a href="{{ route('photos') }}">Frame Photo</a></li>
                            <li><a href="{{ route('review') }}">Review</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- follow -->
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper  mb-4 mb-md-0">
                    <div class="footer_widget mb-3">
                        <h3>Follow Us</h3>
                    </div>
                    <div class="footer_link">
                        <ul>
                            <li><a href="#" target="_blank">Facebook</a></li>
                            <li><a href="#" target="_blank">Twitter</a></li>
                            <li><a href="#" target="_blank">Linkedin</a></li>
                            <li><a href="#" target="_blank">Whatsapp</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- need help -->
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper  mb-4 mb-md-0">
                    <div class="footer_widget mb-3">
                        <h3>Need some help?</h3>
                    </div>
                    <div class="footer_article">
                        <p>Talk to someone from our real support <br /> team, live 24/7</p>
                        <a href="#" class="btn btn-primary rounded">Chat with Us</a>
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
                        <p>&copy; Copyright 2023 PosterWorks, LTD</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center float-md-end">
                        <div class="footer_bottom_link">
                            <ul>
                                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('terms.condition') }}">Tearm & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
    </div>

