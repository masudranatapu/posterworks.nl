@extends('frontend.layouts.app')

@section('title')
@endsection

@section('meta')
@endsection

@push('style')
@endpush

@section('content')
    <div class="terms_condition_sec section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>hi, {{ Auth::user()->name }} .Welcome to admin profile sadsad</h1>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <div class="col-md-12">
                    @if (Auth::user()->provider_id)
                        <img src="{{ Auth::user()->image }}" alt="sadsadsadasd">
                    @else
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            alt="sadsadsadasd">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
