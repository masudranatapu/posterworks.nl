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
                        <h1 class="m-0">{{ __('Custom page') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Custom page') }}</li>
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
                                <h5 class="m-0">{{ __('Custom page list') }}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.change.settings') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label required"
                                                    for="app_type">{{ __('Application Type') }}</label>
                                                <select name="app_type" id="app_type" class="form-control" required>
                                                    <option value="VCARD"
                                                        {{ $settings->application_type == 'VCARD' ? ' selected' : '' }}>
                                                        {{ __('vCarv') }}</option>
                                                    {{-- <option value="STORE"
                                                      {{ $settings->application_type == 'STORE' ? ' selected' : '' }}>
                                                  {{ __('WhatsApp Store Only') }}</option>
                                                  <option value="BOTH"
                                                      {{ $settings->application_type == 'BOTH' ? ' selected' : '' }}>
                                                  {{ __('Both') }}</option> --}}
                                                </select>
                                                @error('app_type')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label required"
                                                    for="timezone">{{ __('Timezone') }}</label>
                                                <select name="timezone" id="timezone" class="form-control" required>
                                                    @foreach (timezone_identifiers_list() as $timezone)
                                                        <option value="{{ $timezone }}"
                                                            {{ $config[2]->config_value == $timezone ? ' selected' : '' }}>
                                                            {{ $timezone }}</option>
                                                    @endforeach
                                                </select>
                                                @error('timezone')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label required"
                                                    for="currency">{{ __('Currency') }}</label>
                                                <select name="currency" id="currency" class="form-control" required>
                                                    @foreach ($currencies as $currency)
                                                        <option value="{{ $currency->iso_code }}"
                                                            {{ $config[1]->config_value == $currency->iso_code ? ' selected' : '' }}>
                                                            {{ $currency->name }} ({{ $currency->symbol }})</option>
                                                    @endforeach
                                                </select>
                                                @error('currency')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Email') }}</div>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $settings->email }}">
                                                @error('email')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Phone No') }}</div>
                                                <input type="phone_no" name="phone_no" class="form-control"
                                                    value="{{ $settings->phone_no }}">
                                                @error('phone_no')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Office Address') }}</div>
                                                <input type="office_address" name="office_address" class="form-control"
                                                    value="{{ $settings->office_address }}">
                                                @error('office_address')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Support Email') }}</div>
                                                <input type="support_email" name="support_email" class="form-control"
                                                    value="{{ $settings->support_email }}">
                                                @error('support_email')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <h2 class="page-title my-3">
                                            {{ __('Paypal Settings') }}
                                        </h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Mode') }}</label>
                                                <select type="text" class="form-select"
                                                    placeholder="Select a payment mode" id="select-tags-advanced"
                                                    name="paypal_mode" required>
                                                    <option value="sandbox"
                                                        {{ $config[3]->config_value == 'sandbox' ? 'selected' : '' }}>
                                                        {{ __('Sandbox') }}</option>
                                                    <option value="live"
                                                        {{ $config[3]->config_value == 'live' ? 'selected' : '' }}>
                                                        {{ __('Live') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Client Key') }}</label>
                                                <input type="text" class="form-control" name="paypal_client_key"
                                                    value="{{ $config[4]->config_value }}"
                                                    placeholder="{{ __('Client Key') }}..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label" required>{{ __('Secret') }}</label>
                                                <input type="text" class="form-control" name="paypal_secret"
                                                    value="{{ $config[5]->config_value }}"
                                                    placeholder="{{ __('Secret') }}..." required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="page-title my-3">
                                                {{ __('Stripe Settings') }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Publishable Key') }}</label>
                                                <input type="text" class="form-control" name="stripe_publishable_key"
                                                    value="{{ $config[9]->config_value }}"
                                                    placeholder="{{ __('Publishable Key') }}..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Secret') }}</label>
                                                <input type="text" class="form-control" name="stripe_secret"
                                                    value="{{ $config[10]->config_value }}"
                                                    placeholder="{{ __('Secret') }}..." required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="page-title my-3">
                                                {{ __('Site Settings') }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xl-6">
                                            @if ($settings->seo_image)
                                                <img src="{{ asset($settings->seo_image) }}" class="img-fluid"
                                                    width="50px" />
                                            @endif
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('SEO image') }} <span class="text-danger">
                                                        ({{ __('Recommended size : 728x680') }})</span></div>
                                                <input type="file" class="form-control" name="seo_image"
                                                    placeholder="{{ __('SEO image') }}..."
                                                    accept=".png,.jpg,.jpeg,.gif,.svg" />
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6 col-xl-6">
                                          <div class="mb-3">
                                              <div class="form-label">{{ __('Login & Register Image') }} <span
                                                  class="text-danger"> ({{ __('Recommended size : 728x680') }})
                                              </span></div>
                                              <input type="file" class="form-control" name="secondary_image"
                                              placeholder="{{ __('Login & Register Image') }}..."
                                              accept=".png,.jpg,.jpeg,.gif,.svg" />
                                          </div>
                                      </div> --}}
                                        <div class="col-md-6 col-xl-6">
                                            @if ($settings->site_logo)
                                                <img src="{{ asset($settings->site_logo) }}" class="img-fluid"
                                                    width="150px" />
                                            @endif
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Site Logo') }} <span class="text-danger">
                                                        ({{ __('Recommended size : 180x60') }})</span></div>
                                                <input type="file" class="form-control" name="site_logo"
                                                    placeholder="{{ __('Site Logo') }}..."
                                                    accept=".png,.jpg,.jpeg,.gif,.svg" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            @if ($settings->favicon)
                                                <img src="{{ asset($settings->favicon) }}" class="img-fluid"
                                                    width="50px" />
                                            @endif
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Favicon') }} <span class="text-danger">
                                                        ({{ __('Recommended size : 200x200') }})</span></div>
                                                <input type="file" class="form-control" name="favi_icon"
                                                    placeholder="{{ __('Favicon') }}..."
                                                    accept=".png,.jpg,.jpeg,.gif,.svg" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('App Name') }}</label>
                                                <input type="text" class="form-control" name="app_name"
                                                    value="{{ config('app.name') }}"
                                                    placeholder="{{ __('App Name') }}..." readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Site Name') }}</label>
                                                <input type="text" class="form-control" name="site_name"
                                                    value="{{ $settings->site_name }}"
                                                    placeholder="{{ __('Site Name') }}..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Site Title') }}</label>
                                                <input type="text" class="form-control" name="site_title"
                                                    value="{{ $settings->site_title }}"
                                                    placeholder="{{ __('Site Title') }}..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label required">{{ __('SEO Meta Description') }}</label>
                                                <textarea class="form-control" name="seo_meta_desc" rows="3" placeholder="{{ __('SEO Meta Description') }}"
                                                    required>{{ $settings->seo_meta_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('SEO Keywords') }}</label>
                                                <textarea class="form-control required" name="meta_keywords" rows="3"
                                                    placeholder="{{ __('SEO Keywords (Keyword 1, Keyword 2)') }}" required>{{ $settings->seo_keywords }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Main Motto') }}</label>
                                                <textarea class="form-control required" name="main_motto" rows="3" placeholder="{{ __('Main moto') }}"
                                                    required>{{ $settings->main_motto }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="page-title my-3">
                                                {{ __('Share Content Settings') }}
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Share Content') }}</label>
                                                <textarea class="form-control" name="share_content" id="share_content" cols="10" rows="3"
                                                    placeholder="{{ __('Share Content') }}..." required>{{ $config[30]->config_value }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <h2 class="text-danger"> {{ __('Short Codes :') }} </h2>
                                            <span><span class="font-weight-bold">{ business_name }</span> -
                                                {{ __('Business Name') }}</span><br>
                                            <span><span class="font-weight-bold">{ business_url }</span> -
                                                {{ __('Business URL or Address') }}</span><br>
                                            <span><span class="font-weight-bold">{ appName }</span> -
                                                {{ __('App Name') }}</span>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="page-title my-3">
                                                {{ __('Email Configuration Settings') }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Sender Name') }}</label>
                                                <input type="text" class="form-control" name="mail_sender"
                                                    value="{{ $settings->name }}"
                                                    placeholder="{{ __('Sender Name') }}...">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Sender Email Address') }}</label>
                                                <input type="text" class="form-control" name="mail_address"
                                                    value="{{ $settings->address }}"
                                                    placeholder="{{ __('Sender Email Address') }}...">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Mailer Driver') }}</label>
                                                <input type="text" class="form-control" name="mail_driver"
                                                    value="{{ $settings->driver }}"
                                                    placeholder="{{ __('Mailer Driver') }}...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Mailer Host') }}</label>
                                                <input type="text" class="form-control" name="mail_host"
                                                    value="{{ $settings->host }}"
                                                    placeholder="{{ __('Mailer Host') }}...">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Mailer Port') }}</label>
                                                <input type="text" class="form-control" name="mail_port"
                                                    value="{{ $settings->port }}"
                                                    placeholder="{{ __('Mailer Port') }}...">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Mailer Encryption') }}</label>
                                                <input type="text" class="form-control" name="mail_encryption"
                                                    value="{{ $settings->encryption }}"
                                                    placeholder="{{ __('Mailer Encryption') }}...">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Mailer Username') }}</label>
                                                <input type="text" class="form-control" name="mail_username"
                                                    value="{{ $settings->username }}"
                                                    placeholder="{{ __('Mailer Username') }}...">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Mailer Password') }}</label>
                                                <input type="password" class="form-control" name="mail_password"
                                                    value="{{ $settings->password }}"
                                                    placeholder="{{ __('Mailer Password') }}...">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4 mt-3">
                                            <div class="mb-3">
                                                <label class="form-label"></label>
                                                <a href="{{ route('admin.test.email') }}" class="btn btn-primary">
                                                    {{ __('Test Mail') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="page-title my-3">
                                                {{ __('Facebook Settings') }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Facebook client id') }}</label>
                                                <input type="text" class="form-control" name="facebook_client_id"
                                                    value="{{ $settings->facebook_client_id }}"
                                                    placeholder="{{ __('Facebook client id') }}...">
                                                @error('facebook_client_id')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Facebook client secret') }}</label>
                                                <input type="text" class="form-control" name="facebook_client_secret"
                                                    value="{{ $settings->facebook_client_secret }}"
                                                    placeholder="{{ __('Facebook client secret') }}...">
                                                @error('facebook_client_secret')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4 col-6 col-xl-4 form-group">
                                          <div class="mb-3">
                                              <label class="form-label">{{ __('Facebook callback url') }}</label>
                                              <input type="text" class="form-control" name="facebook_callback_url" value="{{ URL::to('/') }}/auth/facebook/callback" placeholder="{{ __('Facebook callback url') }}..." disabled>
                                              @error('facebook_callback_url')
                                              <span class="help-block text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div> --}}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="page-title my-3">
                                                {{ __('Google Settings') }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Google client id') }}</label>
                                                <input type="text" class="form-control" name="google_client_id"
                                                    value="{{ $settings->google_client_id }}"
                                                    placeholder="{{ __('Google client id') }}...">
                                                @error('google_client_id')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Google client secret') }}</label>
                                                <input type="text" class="form-control" name="google_client_secret"
                                                    value="{{ $settings->google_client_secret }}"
                                                    placeholder="{{ __('Google client secret') }}...">
                                                @error('google_client_secret')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4 col-6 col-xl-4 form-group">
                                          <div class="mb-3">
                                              <label class="form-label">{{ __('Google callback url') }}</label>
                                              <input type="text" class="form-control" name="google_callback_url"
                                              value="{{ URL::to('/') }}/auth/google/callback"
                                              placeholder="{{ __('Google callback url') }}..." disabled>
                                              @error('google_callback_url')
                                              <span class="help-block text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label required">{{ __('Google Analytics ID') }}</label>
                                                <input type="text" class="form-control" name="google_analytics_id"
                                                    value="{{ $settings->google_analytics_id }}"
                                                    placeholder="{{ __('Google Analytics ID') }}..." required>
                                            </div>
                                            <span>{{ __('If you did not get a google analytics id, create a') }} <a
                                                    href="https://analytics.google.com/analytics/web/"
                                                    target="_blank">{{ __('new analytics id.') }}</a> </span>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Android App Url') }}</label>
                                                <input type="text" class="form-control" name="android_app_url"
                                                    value="{{ $settings->android_app_url }}"
                                                    placeholder="{{ __('Android App Url') }}...">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('IOS App Url') }}</label>
                                                <input type="text" class="form-control" name="ios_app_url"
                                                    value="{{ $settings->ios_app_url }}"
                                                    placeholder="{{ __('IOS App Url') }}...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="page-title my-3">
                                                {{ __('Social URL') }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Facebook URL') }}</label>
                                                <input type="url" class="form-control" name="facebook_url"
                                                    value="{{ $settings->facebook_url }}"
                                                    placeholder="{{ __('Facebook URL') }}...">
                                                @error('facebook_url')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Youtube Url') }}</label>
                                                <input type="url" class="form-control" name="youtube_url"
                                                    value="{{ $settings->youtube_url }}"
                                                    placeholder="{{ __('Youtube Url') }}...">
                                                @error('youtube_url')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Twitter Url') }}</label>
                                                <input type="url" class="form-control" name="twitter_url"
                                                    value="{{ $settings->twitter_url }}"
                                                    placeholder="{{ __('Twitter Url') }}...">
                                                @error('twitter_url')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Linkedin url') }}</label>
                                                <input type="url" class="form-control" name="linkedin_url"
                                                    value="{{ $settings->linkedin_url }}"
                                                    placeholder="{{ __('Linkedin url') }}...">
                                                @error('linkedin_url')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Telegram url') }}</label>
                                                <input type="url" class="form-control" name="telegram_url"
                                                    value="{{ $settings->telegram_url }}"
                                                    placeholder="{{ __('Linkedin url') }}...">
                                                @error('telegram_url')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('WhatsApp Number') }}</label>
                                                <input type="text" class="form-control" name="whatsapp_number"
                                                    value="{{ $settings->whatsapp_number }}"
                                                    placeholder="{{ __('WhatsApp Number') }}...">
                                                @error('whatsapp_number')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Instagram Url') }}</label>
                                                <input type="url" class="form-control" name="instagram_url"
                                                    value="{{ $settings->instagram_url }}"
                                                    placeholder="{{ __('Instagram url') }}...">
                                                @error('instagram_url')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 col-xl-4 form-group">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Pinterest Url') }}</label>
                                                <input type="url" class="form-control" name="pinterest_url"
                                                    value="{{ $settings->pinterest_url }}"
                                                    placeholder="{{ __('Instagram url') }}...">
                                                @error('pinterest_url')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row d-flex justify-content-center">
                                        <div class="col-xl-10">
                                            <div class="row">


                                                {{-- <h2 class="page-title my-3">
                                              {{ __('Default Plan Term Settings') }}
                                              </h2>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label required"
                                                      for="term">{{ __('Default Plan Term') }}</label>
                                                      <select name="term" id="term" class="form-control" required>
                                                          <option value="monthly"
                                                              {{ $config[8]->config_value == 'monthly' ? ' selected' : '' }}>
                                                          {{ __('Monthly') }}</option>
                                                          <option value="yearly"
                                                              {{ $config[8]->config_value == 'yearly' ? ' selected' : '' }}>
                                                          {{ __('Yearly') }}</option>
                                                      </select>
                                                  </div>
                                              </div>
                                              <h2 class="page-title my-3">
                                              {{ __('Cookie Consent Settings') }}
                                              </h2>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label required"
                                                      for="cookie">{{ __('Cookie Consent Settings') }}</label>
                                                      <select name="cookie" id="cookie" class="form-control" required>
                                                          <option value="true"
                                                              {{ env('COOKIE_CONSENT_ENABLED') == 'true' ? ' selected' : '' }}>
                                                          {{ __('Enable') }}</option>
                                                          <option value=""
                                                              {{ env('COOKIE_CONSENT_ENABLED') == '' ? ' selected' : '' }}>
                                                          {{ __('Disable') }}</option>
                                                      </select>
                                                  </div>
                                              </div>
                                              <h2 class="page-title my-3">
                                              {{ __('Image Upload Limit') }}
                                              </h2>
                                              <div class="col-md-6 col-xl-6 mb-2">
                                                  <div class="mb-3">
                                                      <label class="form-label"
                                                      for="image_limit">{{ __('Size') }} </label>
                                                      <input type="number" class="form-control" name="image_limit"
                                                      value="{{ $settings->image_limit['SIZE_LIMIT'] }}"
                                                      placeholder="{{ __('Size') }}..." readonly>
                                                  </div>
                                              </div>
                                              <h2 class="page-title my-3">
                                              {{ __('Offline (Bank Transfer) Settings') }}
                                              </h2>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label required">{{ __('Offline (Bank Transfer) Details') }}</label>
                                                      <textarea class="form-control" name="bank_transfer" rows="3"
                                                      placeholder="{{ __('Offline (Bank Transfer) Details') }}" required>{{ $config[31]->config_value }}</textarea>
                                                  </div>
                                              </div>
                                              <h2 class="page-title my-3">
                                              {{ __('Google reCAPTCHA Settings') }}
                                              </h2>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <div class="form-label">{{ __('reCAPTCHA Enable') }}</div>
                                                      <label class="form-check form-switch">
                                                          <input class="form-check-input" type="checkbox" {{ $settings->recaptcha_configuration['RECAPTCHA_ENABLE'] == 'on' ? 'checked' : '' }}
                                                          name="recaptcha_enable">
                                                      </label>
                                                  </div>
                                              </div>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label">{{ __('reCAPTCHA Site Key') }}</label>
                                                      <input type="text" class="form-control" name="recaptcha_site_key"
                                                      value="{{ $settings->recaptcha_configuration['RECAPTCHA_SITE_KEY'] }}"
                                                      placeholder="{{ __('reCAPTCHA Site Key') }}..." readonly>
                                                  </div>
                                                  <span>{{ __('If you did not get a reCAPTCHA, create a') }} <a
                                                      href="https://www.google.com/recaptcha/about/"
                                                  target="_blank">{{ __('reCAPTCHA') }}</a> </span>
                                              </div>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label">{{ __('reCAPTCHA Secret Key') }}</label>
                                                      <input type="text" class="form-control" name="recaptcha_secret_key"
                                                      value="{{ $settings->recaptcha_configuration['RECAPTCHA_SECRET_KEY'] }}"
                                                      placeholder="{{ __('reCAPTCHA Secret Key') }}..." readonly>
                                                  </div>
                                              </div> --}}

                                                {{--  <h2 class="page-title my-3">
                                              {{ __('Google OAuth Settings') }}
                                              </h2>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <div class="form-label">{{ __('Google Auth Enable') }}</div>
                                                      <label class="form-check form-switch">
                                                          <input class="form-check-input" type="checkbox" {{ $settings->google_configuration['GOOGLE_ENABLE'] == 'on' ? 'checked' : '' }}
                                                          name="google_auth_enable">
                                                      </label>
                                                  </div>
                                              </div>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label">{{ __('Google Client ID') }}</label>
                                                      <input type="text" class="form-control" name="google_client_id"
                                                      value="{{ $settings->google_configuration['GOOGLE_CLIENT_ID'] }}"
                                                      placeholder="{{ __('Google CLIENT ID') }}..." readonly>
                                                  </div>
                                              </div>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label">{{ __('Google Client Secret') }}</label>
                                                      <input type="text" class="form-control" name="google_client_secret"
                                                      value="{{ $settings->google_configuration['GOOGLE_CLIENT_SECRET'] }}"
                                                      placeholder="{{ __('Google CLIENT Secret') }}..." readonly>
                                                  </div>
                                              </div>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label">{{ __('Google Redirect') }}</label>
                                                      <input type="text" class="form-control" name="google_redirect"
                                                      value="{{ $settings->google_configuration['GOOGLE_REDIRECT'] }}"
                                                      placeholder="{{ __('Google Redirect') }}..." readonly>
                                                  </div>
                                              </div>
                                              <span>{{ __('If you did not get a google OAuth Client ID & Secret Key, follow a') }} <a
                                                  href="https://support.google.com/cloud/answer/6158849?hl=en#zippy=%2Cuser-consent%2Cpublic-and-internal-applications%2Cauthorized-domains/"
                                              target="_blank">{{ __(' steps') }}</a> </span>
                                              --}}

                                                {{--  <h2 class="page-title my-3">
                                              {{ __('Razorpay Settings') }}
                                              </h2>
                                              <div class="col-md-4 col-xl-4">
                                                  <div class="mb-3">
                                                      <label class="form-label required">{{ __('Client Key') }}</label>
                                                      <input type="text" class="form-control" name="razorpay_client_key"
                                                      value="{{ $config[6]->config_value }}"
                                                      placeholder="{{ __('Client Key') }}..." required>
                                                  </div>
                                              </div>
                                              <div class="col-md-4 col-xl-4">
                                                  <div class="mb-3">
                                                      <label class="form-label required">{{ __('Secret') }}</label>
                                                      <input type="text" class="form-control" name="razorpay_secret"
                                                      value="{{ $config[7]->config_value }}"
                                                      placeholder="{{ __('Secret') }}..." required>
                                                  </div>
                                              </div> --}}

                                                {{-- <div class="col-md-12 col-xl-12">
                                                  <div class="mb-3">
                                                      <label class="form-label required">{{ __('Theme Colors') }}</label>
                                                      <div class="row g-2">
                                                          <div class="col-auto">
                                                              <label class="form-colorinput">
                                                                  <input name="app_theme" type="radio" value="blue"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'blue' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-blue"></span>
                                                              </label>
                                                          </div>
                                                          <div class="col-auto">
                                                              <label class="form-colorinput form-colorinput-light">
                                                                  <input name="app_theme" type="radio" value="indigo"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'indigo' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-indigo"></span>
                                                              </label>
                                                          </div>
                                                          <div class="col-auto">
                                                              <label class="form-colorinput">
                                                                  <input name="app_theme" type="radio" value="green"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'green' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-green"></span>
                                                              </label>
                                                          </div>
                                                          <div class="col-auto">
                                                              <label class="form-colorinput">
                                                                  <input name="app_theme" type="radio" value="yellow"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'yellow' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-yellow"></span>
                                                              </label>
                                                          </div>
                                                          <div class="col-auto">
                                                              <label class="form-colorinput">
                                                                  <input name="app_theme" type="radio" value="red"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'red' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-red"></span>
                                                              </label>
                                                          </div>
                                                          <div class="col-auto">
                                                              <label class="form-colorinput">
                                                                  <input name="app_theme" type="radio" value="purple"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'purple' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-purple"></span>
                                                              </label>
                                                          </div>
                                                          <div class="col-auto">
                                                              <label class="form-colorinput">
                                                                  <input name="app_theme" type="radio" value="pink"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'pink' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-pink"></span>
                                                              </label>
                                                          </div>
                                                          <div class="col-auto">
                                                              <label class="form-colorinput form-colorinput-light">
                                                                  <input name="app_theme" type="radio" value="gray"
                                                                  class="form-colorinput-input"
                                                                  {{ $config[11]->config_value == 'gray' ? 'checked' : ''  }} />
                                                                  <span class="form-colorinput-color bg-muted"></span>
                                                              </label>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div> --}}



                                                {{-- <h2 class="page-title my-3">
                                              {{ __('Tawk Chat Settings') }}
                                              </h2>
                                              <div class="col-md-6 col-xl-6">
                                                  <div class="mb-3">
                                                      <label class="form-label">{{ __('Tawk Chat URL (s1.src)') }}</label>
                                                      <div class="input-group">
                                                          <span class="input-group-text">
                                                              {{ __('https://embed.tawk.to/') }}
                                                          </span>
                                                          <input type="text" class="form-control" name="tawk_chat_bot_key"
                                                          value="{{ $settings->tawk_chat_bot_key }}"
                                                          placeholder="{{ __('Tawk Chat Key') }}" autocomplete="off">
                                                      </div>
                                                  </div>
                                              </div> --}}

                                                <div class="col-md-6 col-xl-6"></div>
                                                <!-- <span class="text-danger">{{ __('Note: Some fields are disabled due to security reasons. You can change the respective values directly from .env file') }} </span> -->
                                                <div class="col-md-4 col-xl-4 my-3">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">
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

    </div>
@endsection

@push('script')
@endpush
