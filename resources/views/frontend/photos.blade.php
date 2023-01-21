@extends('frontend.layouts.app')

@section('title')
    Frame Photo
@endsection

@section('meta')

@endsection

@push('style')

@endpush

@section('content')

    <!--  Change Promo Code Modal  -->
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
    <!--  Change Promo Code Modal  -->
    <!--  photo frame  -->
    <div class="photo_frame_sec">
        <!-- container -->
        <div class="container">
            <!-- show frame design -->
            <div class="frame_design" style="display: none;">
                <img id="output" src="assets/images/default-user.png" class="img-fluid" alt="image" />
                <!-- black shadow frame -->
                <div class="black_shadow">
                    <svg shape-rendering="geometricPrecision" style="height: 100%; width: 100%;">
                        <path
                            d="M360,0 L360,360 L367.57894736842104,370.10526315789474 L367.57894736842104,10.105263157894736 Z"
                            fill="#4D4D4D"></path>
                        <path
                            d="M0,360 L7.578947368421052,370.10526315789474 L367.57894736842104,370.10526315789474 L360,360 Z"
                            fill="#333333"></path>
                    </svg>
                </div>
                <!-- white shadow frame -->
                <div class="white_shadow d-none">
                    <svg shape-rendering="geometricPrecision" style="height: 100%; width: 100%;">
                        <path
                            d="M360,0 L360,360 L367.57894736842104,370.10526315789474 L367.57894736842104,10.105263157894736 Z"
                            fill="#bfbfbf"></path>
                        <path
                            d="M0,360 L7.578947368421052,370.10526315789474 L367.57894736842104,370.10526315789474 L360,360 Z"
                            fill="#808080"></path>
                    </svg>
                </div>

                <!-- delete & update photo -->
                <div class="frame_group_btn mt-4">
                    <!-- delete btn -->
                    <button class="btn btn-danger delete_img me-4">
                        <i class="fa fa-trash"></i>
                    </button>
                    <!-- update photo btn -->
                    <form action="#" method="post" class="mb-3" enctype="multipart/form-data">
                        <label for="photo"><i class="fa fa-plus"></i></label>
                        <input type="file" name="photo" onchange="loadFile(event)" id="photo" hidden />
                    </form>
                </div>
                <!-- delete & update photo -->
            </div>
            <!-- show frame design -->

            <!-- upload photo -->
            <div class="upload_photo text-center">
                <form action="#" method="post" class="mb-3" enctype="multipart/form-data">
                    <label for="photo"><i class="fa fa-plus"></i></label>
                    <input type="file" name="photo" onchange="loadFile(event)" id="photo" hidden />
                </form>
                <p>
                    Pick some photos
                    <br />
                    to get started
                </p>
            </div>
            <!-- upload photo -->
        </div>
        <!-- container -->
    </div>
    <!--  photo frame  -->
    <!--  footer  -->
    <div class="footer_frame_sec fixed-bottom" style="display: none; z-index: 1;">
        <!-- container -->
        <div class="container">
            <div class="frame_nav text-center">
                <ul>
                    <li>
                        <a data-bs-toggle="offcanvas" href="#frameModal" role="button" aria-controls="offcanvasExample">
                            <img src="assets/images/icons/frame-2.svg" alt="frame" />
                            Frame
                        </a>
                        <a data-bs-toggle="offcanvas" href="#filterModal" role="button"
                            aria-controls="offcanvasExample">
                            <img src="assets/images/icons/filter.svg" alt="filter" />
                            Filter
                        </a>
                        <a data-bs-toggle="offcanvas" href="#matModal" role="button" aria-controls="offcanvasExample">
                            <img src="assets/images/icons/mat.svg" alt="mat" />
                            Mat
                        </a>
                    </li>
                </ul>

                <!-- checkout button -->
                <div class="ceckout_btn text-center mt-4">
                    <a href="{{ route('checkout') }}" class="btn btn-primary rounded">Checkout</a>
                </div>
                <!-- checkout button -->

            </div>
        </div>
        <!-- container -->
    </div>
    <!--  footer  -->
    <!--  Frame Modal Start  -->
    <div class="offcanvs_modal frame_modal offcanvas offcanvas-bottom" data-bs-backdrop="true" tabindex="-1"
        id="frameModal" aria-labelledby="offcanvasExampleLabel">
        <form action="#" method="post">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    Select Frame
                </h5>
                <button type="submit" class="text-primary">Done</button>
            </div>
            <div class="offcanvas-body">
                <div class="dropdown">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="frame" id="frameOne" value="none" />
                                <label class="form-check-label" for="frameOne">
                                    <img src="assets/images/frame/1.webp" alt="image" />
                                </label>
                                <span>None</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="frame" id="frameTwo" value="white" />
                                <label class="form-check-label" for="frameTwo">
                                    <img src="assets/images/frame/2.webp" alt="image" />
                                </label>
                                <span>White</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="frame" id="frameThree"
                                    value="black" />
                                <label class="form-check-label" for="frameThree">
                                    <img src="assets/images/frame/3.webp" alt="image" />
                                </label>
                                <span>Black</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--  Frame Modal End  -->
    <!--  Filter Modal Start  -->
    <div class="offcanvs_modal filter_modal offcanvas offcanvas-bottom" data-bs-backdrop="true" tabindex="-1"
        id="filterModal" aria-labelledby="offcanvasExampleLabel">
        <form action="#" method="post">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    Select Filter
                </h5>
                <button type="submit" class="text-primary">Done</button>
            </div>
            <div class="offcanvas-body">
                <div class="dropdown">
                    <div class="row row-cols-6 g-3">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filter" id="filterOne" value="" />
                                <label class="form-check-label" for="filterOne">
                                    <img src="assets/images/frame/4.webp" alt="image" />
                                </label>
                                <span>None</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filter" id="filterTwo" value="" />
                                <label class="form-check-label" for="filterTwo">
                                    <img src="assets/images/frame/5.jpg" alt="image" />
                                </label>
                                <span>Noir</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filter" id="filterThree" value="" />
                                <label class="form-check-label" for="filterThree">
                                    <img src="assets/images/frame/6.jpg" alt="image" />
                                </label>
                                <span>Silver</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filter" id="filterFour" value="" />
                                <label class="form-check-label" for="filterFour">
                                    <img src="assets/images/frame/7.jpg" alt="image" />
                                </label>
                                <span>Dramatic</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filter" id="filterFive" value="" />
                                <label class="form-check-label" for="filterFive">
                                    <img src="assets/images/frame/8.jpg" alt="image" />
                                </label>
                                <span>Vivid</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="filter" id="filterSix" value="" />
                                <label class="form-check-label" for="filterSix">
                                    <img src="assets/images/frame/9.jpg" alt="image" />
                                </label>
                                <span>Winter</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--  Filter Modal End  -->
    <!--  Mat Modal Start  -->
    <div class="offcanvs_modal mat_modal offcanvas offcanvas-bottom" data-bs-backdrop="true" tabindex="-1" id="matModal"
        aria-labelledby="offcanvasExampleLabel">
        <form action="#" method="post">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Select Mat</h5>
                <button type="submit" class="text-primary">Done</button>
            </div>
            <div class="offcanvas-body">
                <div class="dropdown">
                    <div class="row row-cols-4 g-3">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mat" id="matOne" value="" />
                                <label class="form-check-label p-0" for="matOne">
                                    <img src="assets/images/frame/4.webp" alt="image" />
                                </label>
                                <span>None</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mat" id="matTwo" value="" />
                                <label class="form-check-label p-1" for="matTwo">
                                    <img src="assets/images/frame/5.jpg" alt="image" />
                                </label>
                                <span>Shallow</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mat" id="matThree" value="" />
                                <label class="form-check-label p-2" for="matThree">
                                    <img src="assets/images/frame/6.jpg" alt="image" />
                                </label>
                                <span>Medium</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mat" id="matFour" value="" />
                                <label class="form-check-label p-3" for="matFour">
                                    <img src="assets/images/frame/7.jpg" alt="image" />
                                </label>
                                <span>Deep</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--  Mat Modal End  -->
@endsection

@push('script')
    <script>
        let loadFile = function (event) {
            // show frame photo
            let image = document.getElementById('output')
            image.src = URL.createObjectURL(event.target.files[0])
            $('.frame_design').fadeIn()

            // show footer frame desgin section
            $('.footer_frame_sec').fadeIn()

            // hide upload photo field
            $('.upload_photo').fadeOut()
        }

        // remove image
        $('.delete_img').on('click', function () {
            let image = document.getElementById('output')
            image.src = 'assets/images/default-user.png'
        });

        $("input[name='frame']").on('click', function () {
            if ($(this).val() == 'none') {
                // add no frame
                $('.frame_design').addClass('no_frame')
                $('.white_shadow').addClass('d-none')
                $('.black_shadow').removeClass('d-none')

                // remove class
                $('.frame_design').removeClass('black_frame')
                $('.frame_design').removeClass('white_frame')

            } else if ($(this).val() == 'white') {
                // add white frame
                $('.frame_design').addClass('white_frame')
                $('.white_shadow').removeClass('d-none')
                $('.black_shadow').addClass('d-none')

                // remove class
                $('.frame_design').removeClass('black_frame')
                $('.frame_design').removeClass('no_frame')

            } else if ($(this).val() == 'black') {
                // add black frame
                $('.frame_design').addClass('black_frame')
                $('.black_shadow').removeClass('d-none')
                $('.white_shadow').addClass('d-none')

                // remove class
                $('.frame_design').removeClass('white_frame')
                $('.frame_design').removeClass('no_frame')
            }
        });
    </script>
@endpush
