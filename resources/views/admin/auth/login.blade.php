@php
$settings = getSetting();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? 'en' }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $settings->site_name }}</title>
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
                                        <img src="{{ getLogo($settings->site_logo) }}" width="150" alt="logo">
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
                                    <label for="password" class="form-label">{{ __('Admin Password') }}</label>
                                    <input type="password"name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">{{ __('Sign In') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- js file -->
        @include('frontend.layouts.script')
    </body>
</html>
