@extends('frontend.layouts.app')

@section('title')
    Home
@endsection

@section('meta')

@endsection

@push('style')

@endpush

@section('content')

    <!-- ============================ Banner ================================= -->
    <div class="banner section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <div class="col-lg-7 order-lg-2 mb-3 mb-lg-0">
                    <div class="banner_content text-center text-lg-start">
                        <h1>Turn your photos into stunning wall art</h1>
                        <p>
                            Design beautiful walls filled with memories
                            <br />
                            using your favorite photos
                        </p>
                        <a href="{{ route('photos') }}" class="btn btn-primary rounded">Let's Go</a>
                        <p>
                            <img src="{{ asset('assets/images/icons/plan.svg') }}" alt="image" />
                            <strong>Free worldwide shipping!</strong>
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-1">
                    <div class="banner_img">
                        <img src="{{ asset('assets/images/banner.png') }}" class="w-100 sm-shadow" alt="image" />
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- ============================ Featured ================================= -->
    <div class="featured_section section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="featured_wrapper mb-3 mb-md-0">
                        <div class="featured_item">
                            <div class="featured_img mb-4">
                                <img src="{{ asset('assets/images/icons/No_Nails.webp') }}" alt="" />
                            </div>
                            <div class="featured_content">
                                <h3>No nails needed</h3>
                                <p>Our frames stick to any wall</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featured_wrapper mb-3 mb-md-0">
                        <div class="featured_item">
                            <div class="featured_img mb-4">
                                <img src="{{ asset('assets/images/icons/shipping.webp') }}" alt="" />
                            </div>
                            <div class="featured_content">
                                <h3>Free worldwide shipping!</h3>
                                <p>At your doorstep in a week</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featured_wrapper mb-3 mb-md-0">
                        <div class="featured_item">
                            <div class="featured_img mb-4">
                                <img src="{{ asset('assets/images/icons/face_girl.webp') }}" alt="" />
                            </div>
                            <div class="featured_content">
                                <h3>Satisfaction guaranteed</h3>
                                <p>Not satisfied? Get a full refund</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- ============================ frame banner ================================= -->
    <div class="frame_banner section">
        <!-- container -->
        <div class="container">
            <div class="frame_box">
                <!-- row -->
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="frame_video text-center text-lg-end mb-4 mb-lg-0">
                            <div class="ratio ratio-16x9">
                                <iframe class="video_tag" width="100%" src="https://www.youtube.com/embed/K1PtEC_YiYo"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen autoplay="1"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="frame_article ms-lg-5 text-center text-lg-start">
                            <h3>
                                The magic frame that
                                <br />
                                sticks to any surface
                            </h3>
                            <p>
                                Get your photos in stylish frames that stick directly to
                                <br />
                                your wall and leave no damage behind!
                            </p>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
        </div>
        <!-- container -->
    </div>

    <!-- ============================ Reviews ================================= -->
    <div class="reviews_section section">
        <!-- container -->
        <div class="container-fluid">
            <!-- section heading -->
            <div class="section_heading text-center mb-4">
                <h3>Reviews that made our day</h3>
                <p>We love seeing your beautiful PosterWorks walls!</p>
            </div>
            <!-- section heading -->
            <div class="review_wrapper owl-carousel">
                <!-- review itaem -->
                <div class="item review_item">
                    <div class="review_content">
                        <div class="review_img mb-3">
                            <img src="{{ asset('assets/images/reviews/1.jpg') }}" class="img-fluid" alt="image" />
                        </div>
                        <div class="review_article">
                            <p>
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                Animi repudiandae eos nihil iure ab, hic repellat nisi quis
                                rerum aspernatur, impedit perspiciatis totam a eius odit iste
                                minima, ullam quae!
                            </p>
                            <h3>@raising.a.girl.gang</h3>
                        </div>
                    </div>
                </div>
                <!-- review item -->
                <!-- review item -->
                <div class="item review_item">
                    <div class="review_content">
                        <div class="review_img mb-3">
                            <img src="{{ asset('assets/images/reviews/2.jpg') }}" class="img-fluid" alt="image" />
                        </div>
                        <div class="review_article">
                            <p>
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                Animi repudiandae eos nihil iure ab, hic repellat nisi quis
                                rerum aspernatur, impedit perspiciatis totam a eius odit iste
                                minima, ullam quae!
                            </p>
                            <h3>@raising.a.girl.gang</h3>
                        </div>
                    </div>
                </div>
                <!-- review item -->
                <!-- review item -->
                <div class="item review_item">
                    <div class="review_content">
                        <div class="review_img mb-3">
                            <img src="{{ asset('assets/images/reviews/3.jpg') }}" class="img-fluid" alt="image" />
                        </div>
                        <div class="review_article">
                            <p>
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                Animi repudiandae eos nihil iure ab, hic repellat nisi quis
                                rerum aspernatur, impedit perspiciatis totam a eius odit iste
                                minima, ullam quae!
                            </p>
                            <h3>@raising.a.girl.gang</h3>
                        </div>
                    </div>
                </div>
                <!-- review item -->
                <!-- review item -->
                <div class="item review_item">
                    <div class="review_content">
                        <div class="review_img mb-3">
                            <img src="{{ asset('assets/images/reviews/4.jpg') }}" class="img-fluid" alt="image" />
                        </div>
                        <div class="review_article">
                            <p>
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                Animi repudiandae eos nihil iure ab, hic repellat nisi quis
                                rerum aspernatur, impedit perspiciatis totam a eius odit iste
                                minima, ullam quae!
                            </p>
                            <h3>@raising.a.girl.gang</h3>
                        </div>
                    </div>
                </div>
                <!-- review item -->
                <!-- review item -->
                <div class="item review_item">
                    <div class="review_content">
                        <div class="review_img mb-3">
                            <img src="{{ asset('assets/images/reviews/5.jpg') }}" class="img-fluid" alt="image" />
                        </div>
                        <div class="review_article">
                            <p>
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                Animi repudiandae eos nihil iure ab, hic repellat nisi quis
                                rerum aspernatur, impedit perspiciatis totam a eius odit iste
                                minima, ullam quae!
                            </p>
                            <h3>@raising.a.girl.gang</h3>
                        </div>
                    </div>
                </div>
                <!-- review item -->
            </div>
        </div>
        <!-- container -->
    </div>

    <!-- ============================ video ================================= -->
    <div class="video_section section">
        <!-- container -->
        <div class="container">
            <div class="video_wrapper text-center" data-bs-toggle="modal" data-bs-target="#exampleModal"
                style="background-image: url('assets/images/banner.png');">
                <div class="position-relative">
                    <h3>Every year, millions of people <br /> choose PosterWorks</h3>
                    <button type="button" class="btn btn-primary rounded">Watch the video</button>
                </div>
            </div>
            <!-- Button trigger modal -->

            <!-- Video Modal -->
            <div class="video_modal modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/K1PtEC_YiYo" title="YouTube video"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video Modal -->
        </div>
        <!-- container -->
    </div>

    <!-- ============================ footer ================================= -->

@endsection

@push('script')
    <script>
        // review carousel
        $(".review_wrapper").owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            dots: false,
            nav: true,
            margin: 20,
            responsiveBaseElement: "body",
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                992: {
                    items: 3,
                },
                1220: {
                    items: 4,
                },
                1400: {
                    items: 5,
                },
            },
        });
    </script>
    <!-- Chat plugin -->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63c3f21cc2f1ac1e202daf4b/1gmqmjg19';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!-- Chat plugin -->
@endpush
