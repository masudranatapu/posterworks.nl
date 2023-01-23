@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
@section('title') Change User Plan @endsection
@section('users', 'active')
@section('content')
<div class="page-wrapper">
    {{--
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none mt-2 mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Overview') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Change Plan in User') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
--}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-12 col-lg-12">
                    <form action="{{ route('admin.update.user.plan') }}" method="post" class="card">
                        @csrf
                        <div class="card-header">
                            <div class="col">
                                <div class="float-left">
                                    {{ __('Change User Plan') }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="{{route('admin.users')}}" class="btn btn-primary">{{ __('Back')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-10">
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="user_id"
                                            placeholder="{{ __('User ID') }}..." value="{{ $user_details->id }}"
                                            readonly>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required"
                                                    for="plan_id">{{ __('Plans') }}</label>
                                                <select name="plan_id" id="plan_id" class="form-control"
                                                    required>
                                                    <option value='' disabled selected>{{ __('Plans') }}</option>
                                                    @foreach ($plans as $plan)
                                                        <option value="{{ $plan->plan_id }}"
                                                            {{ $plan->plan_id == $user_details->plan_id ? 'selected' : '' }}>
                                                            @if ($plan->plan_price == '0')
                                                            {{ $plan->plan_name}} ({{ __('Free') }})
                                                            @else
                                                            {{ $plan->plan_name }} ({{ $config[1]->config_value}} {{ $plan->plan_price }})
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6"></div>
                                        <div class="col-md-4 col-xl-4 my-3">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3">
                                                        </path>
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3">
                                                        </path>
                                                        <line x1="16" y1="5" x2="19" y2="8"></line>
                                                    </svg>
                                                    {{ __('Upgrade') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection
