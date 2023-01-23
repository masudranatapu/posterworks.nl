<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $settings = DB::table('settings')
            ->latest()
            ->first();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | @yield('title')</title>
    <link rel="icon" href="{{ $settings->favicon }}" sizes="96x96" type="image/png" />
    <!-- CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/tabler-vendors.min.css') }}" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}"> --}}
    <link href="{{ asset('assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css?v-2') }}" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> -->
    <!-- datatable -->
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"> --}}
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
    @yield('css')
    @stack('css')
    <style>
        .card-header a.active {
            color: #656d77;
        }

        .row-cards {
            min-height: 500px;
        }
    </style>

</head>

<body class="antialiased">
    <div id="wrapper">
        @if (isset($header) && $header)
            @include('admin.includes.header')
        @endif

        @if (isset($nav) && $nav)
            @include('admin.includes.nav')
        @endif
        @yield('content')
    </div>
    <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
    {{-- @include('sweet::alert') --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <!-- Tabler Core -->
    <script type="text/javascript" src="{{ asset('assets/js/tabler.min.js') }}"></script>
    @if (isset($demo) && $demo)
        <script type="text/javascript" src="{{ asset('assets/js/admin-delete-query.js') }}"></script>
    @endif
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <!-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> -->
    <script src="{{ asset('assets/js/toastr.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

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
    @yield('scripts')
    @stack('scripts')
    <script>
        function deleteContactMsg(parameter) {
            "use strict";
            $("#contact-modal").modal("show");
            var link = document.getElementById("contact_user_id");
            link.getAttribute("href");
            link.setAttribute("href", "/admin/contacts/delete?id=" + parameter);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>

</html>
