@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
@section('title') Plan List @endsection
@section('plans', 'active')
@section('plan', 'active')
@section('content')
    <div class="page-wrapper">
        {{-- <div class="container-xl">
        <div class="page-header d-print-none mt-2 mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Overview') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Plans') }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <a type="button" href="{{ route('admin.add.plan') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        {{ __('Add Plan') }}
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

        <div class="page-body" style="min-height: 500px;">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col">
                                    <div class="float-left">
                                        {{ __('All Plans') }}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a href="{{ route('admin.add.plan') }}" class="btn btn-primary"><i
                                                class="lar la-plus"></i> Add Plan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive px-2 py-2">
                                    <table class="table table-bordered card-table" id="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SL.No') }}</th>
                                                <th>{{ __('Plan Name') }}</th>
                                                <th>{{ __('Is Paid') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('No. of vCards') }}</th>
                                                <th>{{ __('Plan Features') }}</th>
                                                <th>{{ __('Package Limitation') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Payment getway') }}</th>
                                                <th class="w-1">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($plans as $plan)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $plan->plan_name }}</td>
                                                    <td class="text-muted">
                                                        @if ($plan->is_free == 1)
                                                            {{ __('Free') }}
                                                        @else
                                                            {{ __('Paid') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($plan->is_free == 1)
                                                            {{ __('Free') }}
                                                        @else
                                                            <small class="d-block">{{ __('Yearly') }}:
                                                                {{ number_format($plan->plan_price_yearly, 2) }}</small>
                                                            <small
                                                                class="d-block">{{ __('Monthly') }}:{{ number_format($plan->plan_price_monthly, 2) }}</small>
                                                            {{-- <small class="d-block">{{ __('Discount') }}:{{ number_format($plan->discount_percentage,2) }}%</small> --}}
                                                        @endif
                                                    </td>
                                                    <td>{{ $plan->no_of_vcards }}</td>
                                                    <td>
                                                        <small
                                                            class="d-block">{{ __('Personal link') }}:{{ $plan->personalized_link == 1 ? 'Yes' : 'No' }}</small>
                                                        <small
                                                            class="d-block">{{ __('Branding') }}:{{ $plan->hide_branding == 1 ? 'Yes' : 'No' }}</small>
                                                        {{-- <small class="d-block">{{ __('Setup') }}:{{ $plan->free_setup == 1 ? 'Free' : 'No' }}</small> --}}
                                                        {{-- <small class="d-block">{{ __('Support') }}:{{ $plan->free_support == 1 ? 'Free' : 'No' }}</small> --}}
                                                    </td>
                                                    <td>
                                                        <small
                                                            class="d-block">{{ __('QR Code Customize') }}:{{ $plan->is_qr_code == 1 ? 'Free' : 'No' }}</small>

                                                    </td>
                                                    <td class="text-muted">
                                                        @if ($plan->status == 0)
                                                            <span class="badge bg-red">{{ __('Discontinued') }}</span>
                                                        @else
                                                            <span class="badge bg-green">{{ __('Active') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-muted">
                                                        @if (!empty($gateway))
                                                            @foreach ($gateway as $gate)
                                                                @if ($plan->is_free == 0)
                                                                    @if ($gate->payment_gateway_name == 'Paypal')
                                                                        <p title="Monthly">Paypal(M):
                                                                            @if ($plan->paypal_plan_id)
                                                                                {{ $plan->paypal_plan_id }}
                                                                            @else
                                                                                <a href="{{ route('admin.plan.getpaypal', ['id' => $plan->id, 'period' => 'month']) }}"
                                                                                    class="btn btn-sm btn-primary">+</a>
                                                                            @endif
                                                                        </p>
                                                                        <p title="Yearly">Paypal(Y):
                                                                            @if ($plan->paypal_plan_id_yearly)
                                                                                {{ $plan->paypal_plan_id_yearly }}
                                                                            @else
                                                                                <a href="{{ route('admin.plan.getpaypal', ['id' => $plan->id, 'period' => 'year']) }}"
                                                                                    class="btn btn-sm btn-primary">+</a>
                                                                            @endif
                                                                        </p>
                                                                    @elseif ($gate->payment_gateway_name == 'Stripe')
                                                                        <p title="Monthly">Stripe(M):
                                                                            @if ($plan->stripe_plan_id)
                                                                                {{ $plan->stripe_plan_id }}
                                                                            @else
                                                                                <a href="{{ route('admin.plan.getstripe', ['id' => $plan->id, 'period' => 'month']) }}"
                                                                                    class="btn btn-sm btn-primary">+</a>
                                                                            @endif
                                                                        </p>
                                                                        <p title="Yearly">Stripe(Y):
                                                                            @if ($plan->stripe_plan_id_yearly)
                                                                                {{ $plan->stripe_plan_id_yearly }}
                                                                            @else
                                                                                <a href="{{ route('admin.plan.getstripe', ['id' => $plan->id, 'period' => 'year']) }}"
                                                                                    class="btn btn-sm btn-primary">+</a>
                                                                            @endif
                                                                        </p>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-list flex-nowrap">
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ route('admin.edit.plan', $plan->plan_id) }}">{{ __('Edit') }}</a>
                                                            @if ($plan->status == 0)
                                                                <a class="btn btn-sm btn-warning" href="#"
                                                                    onclick="getPlan('{{ $plan->plan_id }}'); return false;">{{ __('Activate') }}</a>
                                                            @else
                                                                <a class="btn btn-sm btn-warning" href="#"
                                                                    onclick="getPlan('{{ $plan->plan_id }}'); return false;">{{ __('Deactivate') }}</a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.footer')
    </div>

    <div class="modal modal-blur fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">{{ __('Are you sure?') }}</div>
                    <div>{{ __('If you proceed, you will active/deactivate this plan data.') }}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" id="plan_id">{{ __('Yes, proceed') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function copyUrl(id) {
            /* Get the text field */
            var copyText = document.getElementById("planUrl" + id);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
            swal({
                title: "Success!",
                text: "Plan URL has been copied",
                icon: "success",
            });
            /* Alert the copied text */
            // console.log("Copied the text: " + copyText.value);
        }
    </script>
@endsection
