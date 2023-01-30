@extends('frontend.layouts.app')

@section('title') {{ $data['title'] ?? 'Page header' }} @endsection

@section('meta') @endsection

@push('style')

@endpush

@section('content')
    <!--  Privacy Policy  -->
    <div class="privacy_policy_sec section">
        <div class="container">
            <div class="row">
                <div class="section_title mb-4">
                    <h5>{{ $data['row']->title ?? 'Page header' }}</h5>
                </div>
                <div class="page_content_wrap">
                    {!! $data['row']->body ?? 'Page description' !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
