@extends('admin.layouts.master')

@section('custom-page', 'active')
@section('title') {{ $data['title'] ?? 'Page Header' }} @endsection

@push('style')
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $data['title'] ?? 'Page Header' }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active">{{ $data['title'] ?? 'Page Header' }}</li>
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
                  <h5 class="m-0">{{ $data['title'] ?? 'Page Header' }}</h5>
                </div>
                <div class="card-body">

                            <div class="table-responsive px-2 py-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL')}}</th>
                                            <th>{{ __('Title')}}</th>
                                            <th>{{ __('Body')}}</th>
                                            <th>{{ __('Is active')}}</th>
                                            <th>{{ __('Order Id')}}</th>
                                            <th>{{ __('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($data['rows']) && count($data['rows'])>0)
                                        @foreach($data['rows'] as $key=>$row)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$row->title }}</td>

                                            <td>{{ $row->body }}</td>
                                            <td>
                                                @if ($row->is_active)
                                                {{ __('Yes')}}
                                                @endif
                                            </td>
                                            <td>{{ $row->order_id }}</td>
                                            <td style="width: 150px;">

                                                @if (Auth::user()->can('admin.faq.view'))
                                                <a href="{{ route('admin.faq.view', [$row->id]) }}" class="btn btn-xs btn-success" title="EDIT"><i class="la la-edit"></i> View</a>
                                                @endif

                                                @if (Auth::user()->can('admin.faq.edit'))
                                                <a href="{{ route('admin.faq.edit', [$row->id]) }}" class="btn btn-xs btn-info" title="EDIT"><i class="la la-edit"></i> {{ __('Edit')}}</a>
                                                @endif

                                                @if (Auth::user()->can('admin.faq.delete'))
                                                <a href="{{ route('admin.faq.delete', [$row->id]) }}" class="btn btn-xs btn-danger " onclick="return confirm('Are you sure you want to delete?')" title="DELETE"><i class="la la-trash"></i> {{ __('Delete')}}</a>
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
