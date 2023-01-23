@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
@section('users', 'active')
@section('title') User Edit @endsection
@section('page-name') User Edit @endsection
<?php
$plan_details = json_decode($user_details->plan_details);
?>
@section('edit_user', 'active')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
                        {{ __('Edit User') }}
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

                    <div class="card">
                          <div class="card-header">
                            <div class="col">
                                <div class="float-left">
                                    {{ __('Edit User') }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="{{route('admin.users')}}" class="btn btn-primary">{{ __('Back')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update.user') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user_details->id }}" />
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-xl-10">
                                            <div class="row">
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label required">{{ __('Full Name') }}</label>
                                                        <input type="text" class="form-control" name="full_name"
                                                            placeholder="{{ __('Full Name') }}..."
                                                            value="{{ $user_details->name }}" required>
                                                            {!! $errors->first('full_name', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label required">{{ __('Email') }} </label>
                                                        <input type="text" class="form-control" name="email"
                                                            placeholder="{{ __('Email') }}..."
                                                            value="{{ $user_details->email }}" required>
                                                            {!! $errors->first('email', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="plan_validity">{{ __('Plan validity') }} </label>
                                                        <input type="text" class="form-control" id="datepicker" name="plan_validity" placeholder="{{ __('DD-MM-YYYY') }}..."
                                                            value="{{ $user_details->plan_validity }}" readonly>
                                                        {!! $errors->first('plan_validity', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="billing_address">{{ __('Billing Address') }} </label>
                                                        <input type="text" class="form-control" name="billing_address" placeholder="{{ __('Billing address') }}..."
                                                            value="{{ $user_details->billing_address }}">
                                                        {!! $errors->first('billing_address', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="billing_city">{{ __('Billing city') }} </label>
                                                        <input type="text" class="form-control" name="billing_city" placeholder="{{ __('Billing city') }}..."
                                                            value="{{ $user_details->billing_city }}">
                                                        {!! $errors->first('billing_city', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="billing_state">{{ __('Billing state') }} </label>
                                                        <input type="text" class="form-control" name="billing_state" placeholder="{{ __('Billing state') }}..."
                                                            value="{{ $user_details->billing_state }}">
                                                        {!! $errors->first('billing_state', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="billing_zipcode">{{ __('Billing zipcode') }} </label>
                                                        <input type="text" class="form-control" name="billing_zipcode" placeholder="{{ __('Billing zipcode') }}..."
                                                            value="{{ $user_details->billing_zipcode }}">
                                                        {!! $errors->first('billing_zipcode', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="billing_country">{{ __('Billing country') }} </label>
                                                        <input type="text" class="form-control" name="billing_country" placeholder="{{ __('Billing country') }}..."
                                                            value="{{ $user_details->billing_country }}">
                                                        {!! $errors->first('billing_country', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="phone">{{ __('Phone') }} </label>
                                                        <input type="text" class="form-control" name="phone" placeholder="{{ __('Phone') }}..."
                                                            value="{{ $user_details->phone }}">
                                                        {!! $errors->first('phone', '<label class="help-block text-danger">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="designation">{{ __('Designation') }} </label>
                                                        <input type="text" class="form-control" name="designation" placeholder="{{ __('Designation') }}..."
                                                            value="{{ $user_details->designation }}">
                                                        {!! $errors->first('designation', '<label class="help-block text-danger">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="company_name">{{ __('Company name') }} </label>
                                                        <input type="text" class="form-control" name="company_name" placeholder="{{ __('Company name') }}..."
                                                            value="{{ $user_details->company_name }}">
                                                        {!! $errors->first('company_name', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="company_websitelink">{{ __('Company website') }} </label>
                                                        <input type="url" class="form-control" name="company_websitelink" placeholder="{{ __('Company website') }}..."
                                                            value="{{ $user_details->company_websitelink }}">
                                                        {!! $errors->first('company_websitelink', '<label class="help-block text-danger">:message</label>') !!}
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" id="no_of_vcards">{{ __('Total Cards') }} </label>
                                                        <input type="number" class="form-control" name="no_of_vcards" placeholder="{{ __('Total Card') }}..."
                                                            value="{{ $plan_details->no_of_vcards ?? NULL }}">
                                                        {!! $errors->first('no_of_vcards', '<label class="help-block text-danger">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <h2 class="page-title my-3">
                                                    {{ __('Change Password') }}
                                                </h2>
                                                <div class="col-md-6 col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('New Password') }} </label>
                                                        <input type="password" class="form-control" name="password" placeholder="{{ __('New Password') }}..." autocomplete="new-password">
                                                        {!! $errors->first('password', '<label class="help-block text-danger">:message</label>') !!}

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label required" for="status">{{ __('Status') }} </label>
                                                            <select id="status" class="form-control" name="status">
                                                                <option value="1" {{ $user_details->status==1 ? 'selected': '' }}>Active</option>
                                                                <option value="0" {{ $user_details->status==0 ? 'selected': '' }}>Inactive</option>
                                                            </select>
                                                            {!! $errors->first('status', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label required" for="user_type">{{ __('User type') }} </label>
                                                            <select id="user_type" class="form-control" name="user_type">
                                                                <option value="1" {{ $user_details->user_type==1 ? 'selected': '' }}>Admin</option>
                                                                <option value="2" {{ $user_details->user_type==2 ? 'selected': '' }}>User</option>
                                                            </select>
                                                            {!! $errors->first('user_type', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
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
                                                            {{ __('Update') }}
                                                        </button>
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
        </div>
    </div>
    @include('admin.includes.footer')
</div>
<script>
    $( function() {
        $('#datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onSelect: function(selectedDate) {
                 // we can write code here
             }
      });
    } );
    </script>
@endsection
