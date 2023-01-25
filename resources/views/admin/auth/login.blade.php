<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>
            PosterWorks - Sign In
        </title>
        @include('frontend.layouts.style')
    </head>
    <body>
        <!--  SignIn  -->
        <div class="signin_sec">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-lg-5 col-xl-5">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="signin_form p-5 bg-white">
                                <div class="mb-5 text-center">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/images/logo.png') }}" width="150" alt="logo">
                                    </a>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Admin Email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter your email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Admin Password</label>
                                    <input type="password"name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- <div class="create_account text-center">
                                    @if (Route::has('register'))
                                        <p>Don't have an accoutn? <a href="{{ route('register') }}">Sign Up</a></p>
                                    @endif
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>

                            {{-- <div class="create_account text-center mt-2">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- js file -->
        @include('frontend.layouts.script')
    </body>
</html>
