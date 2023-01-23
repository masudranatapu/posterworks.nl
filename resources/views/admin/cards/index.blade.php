@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
@section('content')
    @section('title') {{ __('Card List') }} @endsection
@section('cards', 'active')
@section('card_list', 'active')
<div class="page-wrapper">
    {{-- <div class="container-xl">
        <div class="page-header d-print-none mt-2 mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Overview') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Users') }}
                    </h2>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col">
                                <div class="float-left">
                                    <a href="{{ route('admin.cards') }}" class="@yield('card_list')"><i
                                            class="fa fa-user"></i> {{ __('All Cards') }}</a> |
                                    <a href="{{ route('admin.card.trash') }}" class="@yield('trash_card')"> <i
                                            class="fa fa-trash-alt"></i> {{ __('Trash list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive px-2 py-2">
                                <table id="dataTable" class="table table-vcenter card-table" id="table-plan">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL.No') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Card Url') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Current Plan') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            {{-- <th>{{ __('Status') }}</th> --}}
                                            <th class="w-1">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($cards) && $cards->count())
                                            @foreach ($cards as $row)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <div style="max-width: 150px; overflow:hidden; display: grid">
                                                            <div><a
                                                                    href="{{ route('admin.view.user', $row->user_id) }}">{{ $row->title }}
                                                                    {{ $row->title2 }}</a></div>
                                                            <div
                                                                style="font-size:12px;font-style: italic; text-transform: lowercase;">
                                                                User:<a
                                                                    href="{{ route('admin.view.user', $row->user_id) }}">{{ $row->username }}</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($row->status == 1)
                                                            <a href="{{ route('card.preview', $row->card_url) }}"
                                                                target="__blank">{{ $row->card_url }}</a>
                                                        @else
                                                            {{ $row->card_url }}
                                                        @endif
                                                    </td>
                                                    <td class="text-muted">
                                                        {{ $row->card_email }} <br>
                                                        {{ $row->phone_number }}
                                                    </td>
                                                    <td class="text-muted text-capitalize">
                                                        {{ $row->plan_name }}
                                                    </td>
                                                    <td class="text-muted">
                                                        {{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                                                    </td>
                                                    {{-- <td class="text-muted">
                                               @if ($row->status == 0)
                                                <span class="badge bg-red">{{ __('Inactive') }}</span>
                                                @else
                                                <span class="badge bg-green">{{ __('Active') }}</span>
                                                @endif
                                            </td> --}}
                                                    <td>
                                                        <div class="dropdown @yield('settings')">
                                                            <a class="btn btn-info dropdown-toggle" href="#navbar-extra"
                                                                data-bs-toggle="dropdown" role="button"
                                                                aria-expanded="false">
                                                                <span class="nav-link-title">
                                                                    {{ __('Action') }}
                                                                </span>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                {{-- <a class="dropdown-item btn-sm" href="{{ route('admin.card.edit', $row->id)}}">{{ __('Edit') }}</a> --}}
                                                                {{-- <a class="dropdown-item btn-sm" href="#">{{ __('Edit') }}</a> --}}
                                                                <a class="dropdown-item btn-sm" target="_blank"
                                                                    href="{{ route('card.preview', $row->card_url) }}">{{ __('View') }}</a>
                                                                {{-- @if ($row->status == 0)
                                                            <a href="{{ route('admin.card.change-status',$row->id) }}" class="dropdown-item btn-sm">{{ __('Activate') }}</a>
                                                        @else
                                                            <a href="{{ route('admin.card.change-status',$row->id) }}" class="dropdown-item btn-sm">{{ __('Deactivate') }}</a>
                                                        @endif --}}
                                                                <a class="dropdown-item btn-sm"
                                                                    onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                                    href="{{ route('admin.card.delete', $row->id) }}"class="dropdown-item btn-sm">{{ __('Delete') }}</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center font-weight-bold">
                                                <td colspan="7">{{ __('No Cards Found.') }}</td>
                                            </tr>
                                        @endif
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
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"
    integrity="sha512-XmZS54be9JGMZjf+zk61JZaLZyjTRgs41JLSmx5QlIP5F+sSGIyzD2eJyxD4K6kGGr7AsVhaitzZ2WTfzpsQzg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.3/src/table2csv.min.js"></script>

<script>
    $('#export').click(() => {
        $("table").first().table2csv({
            filename: 'users.csv'
        }); // -default action is 'download'
    })
</script>
@endsection
