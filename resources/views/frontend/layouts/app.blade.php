<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- meta info --}}
    @yield('meta')

    {{-- style  --}}
    @include('frontend.layouts.style')

    {{-- toastr style  --}}
    {{-- <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}"> --}}

    {{-- custom style  --}}
    @stack('style')

</head>

<body>

    {{-- header section  --}}
    @include('frontend.layouts.header')

    {{-- content section  --}}
    @yield('content')

    @if (!Route::is('photos'))
        {{-- footer section  --}}
        <footer class="footer_section">
            @include('frontend.layouts.footer')
        </footer>
    @endif

    {{-- javascript  --}}
    @include('frontend.layouts.script')

    {{-- <script src="{{asset('massage/toastr/toastr.js')}}"></script>
        {!! Toastr::message() !!}
        <script>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
                @endforeach
            @endif
        </script> --}}

    {{-- custom js area  --}}
    @stack('script')

</body>

</html>
