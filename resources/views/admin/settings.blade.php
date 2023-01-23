@extends('admin.layouts.master')

@section('settings', 'active')
@section('title') Admin|Settings @endsection

@push('style')
@endpush

@section('content')
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">{{ __('Settings') }}</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                  <li class="breadcrumb-item active">{{ __('Settings') }}</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="m-0">{{ __('Web settings') }}</h5>
                  </div>
                  <div class="card-body">


                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('script')
@endpush
