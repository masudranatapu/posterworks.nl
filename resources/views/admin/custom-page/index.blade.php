@extends('admin.layouts.master')

@section('custom-page', 'active')
@section('title') Admin|Custom page @endsection

@push('style')
@endpush

@php
$rows = $data;
@endphp
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
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
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

                            <div class="table-responsive px-2 py-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL')}}</th>
                                            <th>{{ __('Title')}}</th>
                                            <th>{{ __('Link')}}</th>
                                            <th>{{ __('Position')}}</th>
                                            <th>{{ __('Is active')}}</th>
                                            <th>{{ __('Order Id')}}</th>
                                            <th>{{ __('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($rows) && count($rows)>0)
                                        @foreach($rows as $key=>$row)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->url_slug }}</td>
                                            <td>{{ Str::ucfirst($row->position)  }}</td>
                                            <td>
                                                @if ($row->is_active)
                                                {{ __('Yes')}}
                                                @endif
                                            </td>
                                            <td>{{ $row->order_id }}</td>
                                            <td style="width: 150px;">

                                                @if (Auth::user()->can('admin.cpage.view'))
                                                <a href="{{ route('admin.cpage.view', [$row->id]) }}" class="btn btn-xs btn-success" title="EDIT"><i class="la la-edit"></i> View</a>
                                                @endif

                                                @if (Auth::user()->can('admin.cpage.edit'))
                                                <a href="{{ route('admin.cpage.edit', [$row->id]) }}" class="btn btn-xs btn-info" title="EDIT"><i class="la la-edit"></i> {{ __('Edit')}}</a>
                                                @endif

                                                @if (Auth::user()->can('admin.cpage.delete'))
                                                <a href="{{ route('admin.cpage.delete', [$row->id]) }}" class="btn btn-xs btn-danger " onclick="return confirm('Are you sure you want to delete?')" title="DELETE"><i class="la la-trash"></i> {{ __('Delete')}}</a>
                                                @endif

                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="alert">
                                            <td colspan="7" class="text-center">{{ __('Data Not Found')}}</td>
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
</div>
@push('custom_js')
<script src="{{ asset('assets/js/toastr.min.js')}}"></script>
@endpush
@endsection
