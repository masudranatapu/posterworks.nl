@extends('admin.layouts.master')

@section('admin-user', 'active')
@section('title') Admin| role edit @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Admin role edit') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin role edit') }}</li>
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
                                <h5 class="m-0">{{ __('Admin user role') }}
                                    <span class="float-right">
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-primary"> <= back</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">


                                <form method="POST" action="{{ route('admin.roles.update',$role->id) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Role Name</label>
                                        <input value="{{ $role->name }}"
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            placeholder="Name" required>

                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                       <div class="row">
                                           <div class="col-3">
                                            <div class="custom-control custom-checkbox">
                                            <input
                                                {{ App\Models\Admin::roleHasPermission($role, $permissions) ? 'checked' : '' }}
                                                class="custom-control-input" type="checkbox" id="permission_all" value="1">
                                            <label for="permission_all" class="custom-control-label">{{ __('All') }}</label>
                                           </div>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="mb-3">
                                        @php $i=1; @endphp
                                        @foreach ($permission_groups as $group)
                                            @php
                                                $permissionss = App\Models\Admin::getpermissionsByGroupName($group->name);
                                                $j = 1;
                                            @endphp
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input
                                                            {{ App\Models\Admin::roleHasPermission($role, $permissions) ? 'checked' : '' }}
                                                            class="custom-control-input" type="checkbox"
                                                            id="{{ $i }}management"
                                                            onclick="CheckPermissionByGroup('role-{{ $i }}-management-checkbox',this)"
                                                            value="2">
                                                        <label for="{{ $i }}management"
                                                            class="custom-control-label text-capitalize">{{ $group->name }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-9 role-{{ $i }}-management-checkbox">
                                                    @foreach ($permissionss as $permission)
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                onclick="checksinglepermission('role-{{ $i }}-management-checkbox','{{ $i }}management',{{ count($permissionss) }})"
                                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                                name="permissions[]" class="custom-control-input"
                                                                type="checkbox"
                                                                id="permission_checkbox_{{ $permission->id }}"
                                                                value="{{ $permission->name }}">
                                                            <label for="permission_checkbox_{{ $permission->id }}"
                                                                class="custom-control-label">{{ __($permission->name) }}</label>
                                                        </div>
                                                        @php $j++; @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr>
                                            @php $i++; @endphp
                                        @endforeach

                                    </div>


                                    <button type="submit" class="btn btn-primary">Save</button>

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
    <script>
        $('#permission_all').click(function() {
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            } else {
                // uncheck all the checkbox
                $('input[type=checkbox]').prop('checked', false);
            }
        });

        // check permission by group
        function CheckPermissionByGroup(classname, checkthis) {
            const groupIdName = $("#" + checkthis.id);
            const classCheckBox = $('.' + classname + ' input');
            if (groupIdName.is(':checked')) {
                // check all the checkbox
                classCheckBox.prop('checked', true);
            } else {
                // uncheck all the checkbox
                classCheckBox.prop('checked', false);
            }
        }
    </script>
@endpush

