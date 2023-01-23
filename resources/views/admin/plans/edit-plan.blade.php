@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
@section('title') Edit Plan @endsection
@section('plans', 'active')
@section('plan', 'active')
@section('content')
    <?php
    $tabindex = 1;
    ?>
    <style>
        .remove-field {
            cursor: pointer;
        }
    </style>

    <div class="page-wrapper">
        {{--  <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none mt-2 mb-3">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            {{ __('Overview') }}
                        </div>
                        <h2 class="page-title">
                            {{ __('Edit Plan') }}
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
                        <form action="{{ route('admin.update.plan') }}" method="post" class="card">
                            @csrf
                            <div class="card-header">
                                <div class="col">
                                    <div class="float-left">
                                        {{ __('Update Plan') }}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a href="{{ route('admin.plans') }}" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="row">
                                            <input type="hidden" name="plan_id" value="{{ $plan_details->plan_id }}">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label required">{{ __('Plan Name') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('plan_name') is-invalid @enderror "
                                                        name="plan_name" placeholder="{{ __('Plan Name') }}..."
                                                        value="{{ $plan_details->plan_name }}" required
                                                        tabindex="{{ $tabindex++ }}">
                                                    @if ($errors->has('plan_name'))
                                                        <span
                                                            class="help-block text-danger">{{ $errors->first('plan_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label required">{{ __('Description') }}</label>
                                                    <textarea class="form-control @error('plan_description') is-invalid @enderror " name="plan_description" rows="3"
                                                        placeholder="{{ __('Description') }}.." required tabindex="{{ $tabindex++ }}">{{ $plan_details->plan_description }}</textarea>
                                                    @if ($errors->has('plan_description'))
                                                        <span
                                                            class="help-block text-danger">{{ $errors->first('plan_description') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label required" >{{ __('Plan Type') }}</label>
                                                    <div class="">
                                                        <select class="form-control" name="plan_type" required id="plan_type" required>
                                                            <option value="1" {{ $plan_details->plan_type==1 ? 'selected':'' }}>{{ __('Solopreneur and Individuals') }}</option>
                                                            <option value="2" {{ $plan_details->plan_type==2 ? 'selected':'' }}>{{ __('Team Accounts') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-4 col-xl-4">
                                                <div class="mb-3">
                                                    <div class="form-label">{{ __('Recommended') }}</div>
                                                    <label class="form-check form-switch">
                                                        <input
                                                            class="form-check-input @error('recommended') is-invalid @enderror "
                                                            type="checkbox" name="recommended"
                                                            {{ $plan_details->recommended == 1 ? 'checked' : '' }}
                                                            tabindex="{{ $tabindex++ }}">
                                                    </label>
                                                    @if ($errors->has('recommended'))
                                                        <span
                                                            class="help-block text-danger">{{ $errors->first('recommended') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <h2 class="page-title my-3">
                                                {{ __('Plan Prices') }}
                                            </h2>

                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label required">{{ __('Is Free') }}</label>
                                                    <div class="">
                                                        <select class="form-control @error('is_free') is-invalid @enderror "
                                                            name="is_free" required id="is_free" required
                                                            tabindex="{{ $tabindex++ }}">
                                                            <option
                                                                value="1"{{ $plan_details->is_free == 1 ? 'selected' : '' }}>
                                                                {{ __('Yes') }}</option>
                                                            <option
                                                                value="0"{{ $plan_details->is_free == 0 ? 'selected' : '' }}>
                                                                {{ __('No') }}</option>
                                                        </select>
                                                        @if ($errors->has('is_free'))
                                                            <span
                                                                class="help-block text-danger">{{ $errors->first('is_free') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="col-md-6 col-xl-6 plan-price {{ $plan_details->is_free == 1 ? 'd-none' : '' }}">
                                                <div class="mb-3">
                                                    <label class="form-label required">{{ __('Plan Price Monthly') }}
                                                    </label>
                                                    <input type="number"
                                                        class="form-control @error('plan_price_monthly') is-invalid @enderror "
                                                        name="plan_price_monthly" id="plan_price_monthly"
                                                        data-price="{{ $plan_details->plan_price_monthly }}" min="0"
                                                        step="0.01" placeholder="{{ __('Plan Price Monthly') }}..."
                                                        value="{{ $plan_details->plan_price_monthly }}" required
                                                        tabindex="{{ $tabindex++ }}">
                                                    @if ($errors->has('plan_price_monthly'))
                                                        <span
                                                            class="help-block text-danger">{{ $errors->first('plan_price_monthly') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div
                                                class="col-md-6 col-xl-6 plan-price {{ $plan_details->is_free == 1 ? 'd-none' : '' }}">
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label required">{{ __('Plan Price Yearly') }}</label>
                                                    <input type="number"
                                                        class="form-control @error('plan_price_yearly') is-invalid @enderror "
                                                        name="plan_price_yearly" id="plan_price_yearly"
                                                        data-price="{{ $plan_details->plan_price_yearly }}" min="0"
                                                        step="0.01" placeholder="{{ __('Plan Price Yearly') }}..."
                                                        value="{{ $plan_details->plan_price_yearly }}" required
                                                        tabindex="{{ $tabindex++ }}">
                                                    @if ($errors->has('plan_price_yearly'))
                                                        <span
                                                            class="help-block text-danger">{{ $errors->first('plan_price_yearly') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label required">{{ __('Plan Price Forever') }} </label>
                                                    <input type="number" class="form-control" name="plan_price" min="0"
                                                           step="0.01"
                                                           placeholder="{{ __('Price') }}..."
                                                           value="{{ $plan_details->plan_price }}" required>
                                                </div>
                                            </div> --}}
                                            <h2 class="page-title my-3">
                                                {{ __('Plan Features') }}
                                            </h2>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label required">{{ __('No. Of vCards') }} <span
                                                            class="text-danger">({{ __('For unlimited, enter 999') }})</span></label>
                                                    <input type="number"
                                                        class="form-control @error('no_of_vcards') is-invalid @enderror "
                                                        name="no_of_vcards" min="1" max="999"
                                                        placeholder="{{ __('No. Of vCards') }}..."
                                                        value="{{ $plan_details->no_of_vcards }}" required
                                                        tabindex="{{ $tabindex++ }}">
                                                    @if ($errors->has('no_of_vcards'))
                                                        <span
                                                            class="help-block text-danger">{{ $errors->first('no_of_vcards') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{--  <div class="col-md-4 col-xl-4">
                                                 <div class="mb-3">
                                                     <label class="form-label required">{{ __('No. Of Services/Products') }} <span
                                                             class="text-danger">({{ __('For unlimited, enter 999') }})</span></label>
                                                     <input type="number" class="form-control" name="no_of_services" min="1" max="999"
                                                         placeholder="{{ __('No. Of Services/Products') }}..."
                                                         value="{{ $plan_details->no_of_services }}" required>
                                                 </div>
                                             </div>
                                             <div class="col-md-4 col-xl-4">
                                                 <div class="mb-3">
                                                     <label class="form-label required">{{ __('No. Of Galleries') }} <span
                                                             class="text-danger">({{ __('For unlimited, enter 999') }})</span></label>
                                                     <input type="number" class="form-control" name="no_of_galleries" min="1" max="999"
                                                         placeholder="{{ __('No. Of Galleries') }}..."
                                                         value="{{ $plan_details->no_of_galleries }}" required>
                                                 </div>
                                             </div>
                                             <div class="col-md-6 col-xl-6">
                                                 <div class="mb-3">
                                                     <label class="form-label required">{{ __('No. Of Card Features') }}
                                                         <span
                                                             class="text-danger">({{ __('For unlimited, enter 999') }})</span></label>
                                                     <input type="number" class="form-control" name="no_of_features" min="1" max="999"
                                                         placeholder="{{ __('No. Of Card Features') }}..."
                                                         value="{{ $plan_details->no_of_features }}" required>
                                                 </div>
                                             </div>
                                             <div class="col-md-6 col-xl-6">
                                                 <div class="mb-3">
                                                     <label class="form-label required">{{ __('No. Of Payment Listed') }}
                                                         <span
                                                             class="text-danger">({{ __('For unlimited, enter 999') }})</span></label>
                                                     <input type="number" class="form-control" name="no_of_payments" min="1" max="999"
                                                         placeholder="{{ __('No. Of Payment Listed') }}..."
                                                         value="{{ $plan_details->no_of_payments }}" required>
                                                 </div>
                                             </div> --}}

                                            <div class="col-12">
                                                <div class="row">
                                                    {{-- <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('Personalized Link') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                       name="personalized_link"
                                                                    {{ $plan_details->personalized_link == 1 ? 'checked' : '' }}>
                                                            </label>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('Hide Branding') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input
                                                                    class="form-check-input @error('hide_branding') is-invalid @enderror "
                                                                    type="checkbox" name="hide_branding"
                                                                    {{ $plan_details->hide_branding == 1 ? 'checked' : '' }}
                                                                    tabindex="{{ $tabindex++ }}">
                                                            </label>

                                                            @if ($errors->has('hide_branding'))
                                                                <span
                                                                    class="help-block text-danger">{{ $errors->first('hide_branding') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('Free Setup') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                       name="free_setup"
                                                                    {{ $plan_details->free_setup == 1 ? 'checked' : '' }}>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('Free Support') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                       name="free_support"
                                                                    {{ $plan_details->free_support == 1 ? 'checked' : '' }}>
                                                            </label>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <h2 class="page-title my-3">
                                                    {{ __('Package Limitation') }}
                                                </h2>
                                                <div class="row">
                                                    {{-- <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('Vcards') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="is_vcard" {{ $plan_details->is_vcard == 1 ? 'checked' : '' }}>
                                                            </label>
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('Whatsapp Store') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="is_whatsapp_store" {{ $plan_details->is_whatsapp_store == 1 ? 'checked' : '' }}>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('Email Signature') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" name="is_email_signature" {{ $plan_details->is_email_signature == 1 ? 'checked' : '' }}>
                                                            </label>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-6 col-md-3">
                                                        <div class="mb-3">
                                                            <div class="form-label">{{ __('QR Code Customize') }}</div>
                                                            <label class="form-check form-switch">
                                                                <input
                                                                    class="form-check-input @error('is_qr_code') is-invalid @enderror "
                                                                    type="checkbox" name="is_qr_code"
                                                                    {{ $plan_details->is_qr_code == 1 ? 'checked' : '' }}
                                                                    tabindex="{{ $tabindex++ }}">
                                                            </label>

                                                            @if ($errors->has('is_qr_code'))
                                                                <span
                                                                    class="help-block text-danger">{{ $errors->first('is_qr_code') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="parent-feature">
                                                    <label class="form-label">Feature</label>
                                                    @php($features = json_decode($plan_details->features ?? '[]'))
                                                    @if (count($features))
                                                        @foreach ($features as $feature)
                                                            <div class="form-group mb-3 child-feature">
                                                                <div class="input-group mb-3 ">
                                                                    <input type="text"
                                                                        class="form-control @error('feature') is-invalid @enderror "
                                                                        placeholder="Add more feature" name="feature[]"
                                                                        value="{{ $feature }}"
                                                                        tabindex="{{ $tabindex++ }}">
                                                                    <div class="input-group-append">
                                                                        <span
                                                                            class="input-group-text bg-danger text-white remove-field">X</span>
                                                                    </div>
                                                                    @if ($errors->has('feature'))
                                                                        <span
                                                                            class="help-block text-danger">{{ $errors->first('feature') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="form-group mb-3 child-feature">
                                                            <div class="input-group mb-3 ">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Add feature" name="feature[]"
                                                                    value="" tabindex="{{ $tabindex++ }}">
                                                                <div class="input-group-append">
                                                                    <span
                                                                        class="input-group-text bg-danger text-white remove-field">X</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-plus" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="12" y1="5" x2="12"
                                                                y2="19"></line>
                                                            <line x1="5" y1="12" x2="19"
                                                                y2="12"></line>
                                                        </svg>
                                                        {{ __('Update') }}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mt-0">
                                                    <a href="javascript:void(0)" class="btn btn-primary addfield btn-sm"
                                                        style="float: right">{{ __('Add More Feature') }}</a>
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

    <script>
        $(document).on('click', '.addfield', function(e) {
            let html = '';
            html +=
                '<div class="form-group mb-3 child-feature"><div class="input-group mb-3 "><input type="text" class="form-control" placeholder="Add more feature" name="feature[]" ><div class="input-group-append"><span class="input-group-text bg-danger text-white remove-field">X</span></div></div></div>';
            $('.parent-feature').append(html);

            //   $(html).appendTo('.add_dynamic_field');
            //   $('.add_dynamic_field .customer_records').addClass('single remove');
            //   $('.single .addfield').remove();
            //   $('.single').append('<a href="#" class="remove-field btn btn-danger mr-3 mb-3">X</a>');
            //   $('.add_dynamic_field > .single').attr("class", "remove mb-3");
        });

        $(document).on('click', '.remove-field', function(e) {
            $(this).closest('.child-feature').remove();
            e.preventDefault();
        });


        $(document).on('change', '#is_free', function(e) {
            var val = $(this).val();
            if (val == 1) {
                $('.plan-price').hide(500);
                $('#plan_price_yearly').val(0);
                $('#plan_price_monthly').val(0);
            } else {

                var plan_price_monthly = $('#plan_price_monthly').attr('data-price');
                var plan_price_yearly = $('#plan_price_yearly').attr('data-price');
                $('#plan_price_monthly').val(plan_price_monthly);
                $('#plan_price_yearly').val(plan_price_yearly);
                $('.plan-price').show(500);
            }
        })
    </script>

@endsection
