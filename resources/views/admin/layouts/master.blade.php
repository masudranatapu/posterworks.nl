<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

        {{-- style  --}}
        @include('admin.layouts.style')

        {{-- toastr style  --}}
        <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">
        {{-- custom style  --}}
        @stack('style')

    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            {{-- header area  --}}
            @include('admin.layouts.header')
            {{-- sidebar area  --}}
            @include('admin.layouts.sidebar')
            {{-- main content  --}}
            @yield('content')
            {{-- footer  --}}
            @include('admin.layouts.footer')

            {{-- javascript  --}}
            @include('admin.layouts.script')

        </div>
        {{-- toastr javascript --}}
        <script src="{{asset('massage/toastr/toastr.js')}}"></script>
        {!! Toastr::message() !!}
        <script>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    toastr.error('{{ $error }}','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
                @endforeach
            @endif
        </script>

        {{-- custom js area  --}}
        @stack('script')

    </body>
</html>
