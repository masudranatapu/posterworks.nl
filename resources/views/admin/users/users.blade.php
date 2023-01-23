@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
@section('content')
@section('title') {{ __('User List')}} @endsection
@section('user_list','active')

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
                                    <a href="{{ route('admin.users') }}" class="@yield('user_list')"><i class="fa fa-user"></i> {{ __('All Users') }}</a>  |
                                    <a href="{{ route('admin.user.trash-list') }}" class="@yield('trash_list')"> <i class="fa fa-trash-alt"></i> {{ __('Trash list')}}</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a id="export" class="btn btn-primary">{{ __('Export as CSV')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive px-2 py-2">
                                <table id="dataTable" class="table table-vcenter card-table" id="table-plan">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL.No') }}</th>
                                            <th>{{ __('Full Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Current Plan') }}</th>
                                            <th>{{ __('Joined') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th class="w-1">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($users) && $users->count())
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><a
                                                    href="{{ route('admin.view.user', $user->id)}}">{{ $user->name }}</a>
                                            </td>
                                            <td class="text-muted">
                                                {{ $user->email }}
                                            </td>
                                            <td class="text-muted text-capitalize">
                                                <?php $plan_data = json_decode($user->plan_details,TRUE); ?>
                                                @if ($plan_data == null)
                                                {{ __('No Plan') }}
                                                @else
                                                {{ $plan_data['plan_name'] }}
                                                <span>
                                                    @if ($plan_data['plan_price'] == '0')
                                                    ({{ __('Free') }})
                                                    @else
                                                    ({{ $config[1]->config_value}}
                                                    {{ $plan_data['plan_price'] }})
                                                    @endif
                                                </span>
                                                @endif
                                            </td>
                                            <td class="text-muted">
                                                {{ date('d-m-Y h:m A', strtotime($user->created_at)) }}
                                            </td>
                                            <td class="text-muted">
                                                @if ($user->status == 0)
                                                <span class="badge bg-red">{{ __('Inactive') }}</span>
                                                @elseif ($user->status == 2)
                                                <span class="badge bg-red">{{ __('Deleted') }}</span>
                                                @else
                                                <span class="badge bg-green">{{ __('Active') }}</span>
                                                @endif
                                            </td>
                                            <td>

                                        <div class="dropdown @yield('settings')">
                                            <a class="btn btn-info dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button"
                                                aria-expanded="false">
                                                <span class="nav-link-title">
                                                    {{ __('Action') }}
                                                </span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item btn-sm"
                                                    href="{{ route('admin.edit.user', $user->id)}}">{{ __('Edit') }}</a>
                                                <a class="dropdown-item btn-sm"
                                                    href="{{ route('admin.change.user.plan', $user->id)}}">{{ __('Change Plan') }}</a>
                                                @if ($user->status == 0)
                                                <a href="#" class="dropdown-item btn-sm"
                                                    onclick="getUser('{{ $user->id }}'); return false;">{{ __('Activate') }}</a>
                                                @else
                                                <a href="#" class="dropdown-item btn-sm"
                                                    onclick="getUser('{{ $user->id }}'); return false;">{{ __('Deactivate') }}</a>
                                                @endif
                                                <a href="#" class="dropdown-item btn-sm"
                                                    onclick="deleteUser('{{ $user->id }}'); return false;">{{ __('Delete') }}</a>
                                            </div>
                                        </div>
                                          </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="text-center font-weight-bold">
                                            <td colspan="7">{{ __('No Users Found.') }}</td>
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

<div class="modal modal-blur fade" id="status-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Are you sure?')}}</div>
                <div>{{ __('If you proceed, you will active/deactivate this user data.')}}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto"
                    data-bs-dismiss="modal">{{ __('Cancel')}}</button>
                <a class="btn btn-danger" id="user_id">{{ __('Yes, proceed')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title text-danger text-capitalize">{{ __('WARNING!')}}</div>
                <div>{{ __('This action will remove user account and user data.')}}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto"
                    data-bs-dismiss="modal">{{ __('Cancel')}}</button>
                <a class="btn btn-danger" id="deleted_user_id">{{ __('Yes, proceed')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js" integrity="sha512-XmZS54be9JGMZjf+zk61JZaLZyjTRgs41JLSmx5QlIP5F+sSGIyzD2eJyxD4K6kGGr7AsVhaitzZ2WTfzpsQzg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.3/src/table2csv.min.js"></script>

    <script>
        $('#export').click(()=>{
            $("table").first().table2csv({
                filename: 'users.csv'
            }); // -default action is 'download'
        })

    </script>

@endsection
