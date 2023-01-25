@extends('admin.layouts.master')

@section('admin-user', 'active')
@section('title') Admin| User Create @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Admin user create') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin user create') }}</li>
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
                                <h5 class="m-0">{{ __('Admin user create') }}
                                    <span class="float-right">
                                    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary"> <= back</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">

                                <form method="POST" action="{{ route('admin.user.store') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input value="{{ old('name') }}"
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            placeholder="Name" required>

                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input value="{{ old('email') }}"
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            placeholder="Email address" required>
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input value="{{ old('username') }}"
                                            type="text"
                                            class="form-control"
                                            name="username"
                                            placeholder="Username" required>
                                        @if ($errors->has('username'))
                                            <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div> --}}

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
@endpush