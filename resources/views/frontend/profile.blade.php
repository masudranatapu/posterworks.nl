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
            <h1>hi, {{ Auth::user()->name }} .Welcome to admin profile </h1>

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')

@endpush
