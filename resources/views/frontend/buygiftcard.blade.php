@extends('frontend.layouts.app')

@section('title')
    Tearm & Conditions
@endsection

@section('meta')

@endsection

@push('style')

@endpush

@section('content')
    <!--  checkout  -->
    <div class="checkout_section section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="gift_card text-center">
                        <div class="gift_card_bx mb-3">
                            <img src="{{ asset('frontend/images/gift.jpg') }}" class="img-fluid" alt="image">
                            <h5>3 Tiles</h5>
                        </div>
                        <span>Delivered by email</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="gift_card_content mb-5">
                        <h2>PosterWorks Gift Card</h2>
                        <form action="#" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Who is the gift for:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Select number of tiles:</label>
                                <strong class="mb-2 d-block">Note: Gift card tiles are always 21x21 cm.</strong>
                                <div class="tiles_radio">
                                    <div class="row g-1">
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tiles"
                                                    id="tilesGift1" checked>
                                                <label class="form-check-label" for="tilesGift1">
                                                    <strong>3 Tiles</strong> <br />
                                                    US $455
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tiles"
                                                    id="tilesGift2">
                                                <label class="form-check-label" for="tilesGift2">
                                                    <strong>6 Tiles</strong> <br />
                                                    US $555
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tiles"
                                                    id="tilesGift3">
                                                <label class="form-check-label" for="tilesGift3">
                                                    <strong>8 Tiles</strong> <br />
                                                    US $765
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tiles"
                                                    id="tilesGift4">
                                                <label class="form-check-label" for="tilesGift4">
                                                    <strong>12 Tiles</strong> <br />
                                                    US $876
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tiles"
                                                    id="tilesGift5">
                                                <label class="form-check-label" for="tilesGift5">
                                                    <strong>16 Tiles</strong> <br />
                                                    US $986
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tiles"
                                                    id="tilesGift6">
                                                <label class="form-check-label" for="tilesGift6">
                                                    <strong>20 Tiles</strong> <br />
                                                    US $1000
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p>
                                    <i class="fa fa-check"></i>
                                    Shipping Included
                                </p>
                            </div>
                            <button type="submit" class="btn btn-primary rounded">Buy</button>
                        </form>
                        <!-- how it work -->
                        <div class="how_it_work mt-5">
                            <h3>How does it work?</h3>
                            <ul>
                                <li>
                                    <img src="{{ asset('frontend/images/icons/tag.svg') }}" alt="image">
                                    1. Buy the digital gift card
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/images/icons/email.svg') }}" alt="image">
                                    2. We send it over email to your friend or family member
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/images/icons/gift-2.svg') }}" alt="image">
                                    3. They order Mixtiles and apply the gift code at checkout!
                                </li>
                            </ul>
                            <span>Any questions? <a href="#">Contact us</a></span>
                        </div>
                        <!-- how it work -->

                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
@endsection

@push('script')

@endpush
