<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- style  --}}
    @include('admin.layouts.style')

    {{-- toastr style  --}}
    <link rel="stylesheet" href="{{ asset('massage/toastr/toastr.css') }}">
    {{-- custom style  --}}
    @stack('style')

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            @include('admin.layouts.header')
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('admin.layouts.sidebar')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            @include('admin.layouts.footer')
        </footer>
    </div>
    <!-- ./wrapper -->
    @include('admin.layouts.script')

    {{-- toastr javascript --}}
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

    {{-- custom js area  --}}
    @stack('script')

</body>

</html>
