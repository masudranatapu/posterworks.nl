@extends('admin.layouts.master')

@section('title')

@endsection

@push('style')

@endpush

@section('content')
    <h1>hi, {{ Auth::user()->name }} .Welcome to admin profile </h1>

    <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endsection

@push('script')

@endpush
