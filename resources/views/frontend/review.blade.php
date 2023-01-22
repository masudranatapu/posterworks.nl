@extends('frontend.layouts.app')

@section('title')
    Review
@endsection

@section('meta')
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">
    <style>
        .mymodal {
            border-radius: 0;
        }
        .loginmodal h1{
            margin-left: 25px !important;
         }
    </style>
@endpush

@section('content')
    <!--  Terms & Conditons  -->
    <div class="terms_condition_sec section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 mb-3 mb-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h3>Contact Info</h3>
                                </div>
                            </div>

                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h3>Write a review</h3>
                                </div>
                            </div>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Review </label>
                                        <textarea name="details" class="form-control @error('details') is-invalid @enderror" cols="30" rows="10"
                                            onkeyup="countChars(this);">{{ old('details') }}</textarea>
                                        <p id="charNum"></p>
                                        @error('details')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3 text-center">
                                        @auth
                                            <button type="submit" class="btn btn-primary rounded">Submit Review</button>
                                        @else
                                            <button class="btn btn-primary rounded" type="button" data-bs-toggle="modal" data-bs-target="#reviewLoginModal">Submit Review</button>
                                        @endauth
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reviewLoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mymodal">
                <div class="modal-header loginmodal">
                    <h1 class="modal-title ml-3" id="exampleModalLabel">Sign in your account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reviewLogin">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary rounded">Sign in</button>
                        </div>
                    </form>
                    <div class="create_account text-center mt-2">
                        @if (Route::has('register'))
                            <p>Don't have an accoutn? <a href="{{ route('register') }}">Sign Up</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('massage/toastr/toastr.js') }}"></script>
    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            @endforeach
        @endif
    </script>

    <script>
        function countChars(obj) {
            var maxLength = 200;
            var strLength = obj.value.length;

            if (strLength > maxLength) {
                document.getElementById("charNum").innerHTML = '<span style="color: red;">' + strLength + ' out of ' +
                    maxLength + ' characters</span>';
            } else {
                document.getElementById("charNum").innerHTML = '<span style="color: green;">' + strLength + ' out of ' +
                    maxLength + ' characters</span>';
            }

        };

        $("#reviewLogin").on('submit', function(e) {
            e.preventDefault();

            let email = $('#email').val();
            let password = $('#password').val();

            $.ajax({
                url: "{{ route('review.login') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email,
                    password: password,
                },
                success: function(data) {

                    console.log(data);

                    if (data.result == 1) {

                        toastr.info(data.success, 'Success', {
                            closeButton: true,
                            progressBar: true,
                        });

                    }else if(data.result == 2) {

                        toastr.error(data.success, 'Success', {
                            closeButton: true,
                            progressBar: true,
                        });

                    }else if(data.result == 3) {

                        toastr.success(data.success, 'Success', {
                            closeButton: true,
                            progressBar: true,
                        });

                        setTimeout(function(){
                            location.reload();
                        }, 700);

                    }else {
                        var errors = data.errors;
                        for(var i = 0; i < errors.length; i++){
                            toastr.error( errors[i] , 'Error', {
                                closeButton:true,
                                progressBar:true,
                            });
                        }
                    }
                },
            });

        });
    </script>
@endpush
