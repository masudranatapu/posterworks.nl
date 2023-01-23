@extends('admin.layouts.master')

@section('custom-page', 'active')
@section('title') Admin|Custom page edit @endsection

@push('style')
@endpush

@php
    $row = $data;
    $tabindex = 1;
    
@endphp
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Custom page edit') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Custom page edit') }}</li>
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
                                <h5 class="m-0">{{ $row->title }}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.custom-page.update', $row->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group {!! $errors->has('title') ? 'error' : '' !!}">
                                                <label for="title">{{ __('Title') }} <span
                                                        class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" name="title" id="title"
                                                        class="form-control mb-1" required
                                                        placeholder="{{ __('Enter title') }}" value="{{ $row->title }}"
                                                        tabindex="{{ $tabindex++ }}">
                                                    {!! $errors->first('title', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group {!! $errors->has('url_slug') ? 'error' : '' !!}">
                                                <label for="url_slug">{{ __('Url Slug') }}<span
                                                        class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" name="url_slug" id="url_slug"
                                                        class="form-control mb-1" required value="{{ $row->url_slug }}"
                                                        placeholder="{{ __('Enter url slug') }}"
                                                        tabindex="{{ $tabindex++ }}" readonly>
                                                    {!! $errors->first('url_slug', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group {!! $errors->has('position') ? 'error' : '' !!}">
                                                <label for="position">{{ __('Position')}}<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <select class="form-control" name="position" id="position" required tabindex="{{ $tabindex++ }}">
                                                        <option value="footer" {{$row->position=='footer' ? 'selected':''}}>Footer</option>
                                                        <option value="header" {{$row->position=='header' ? 'selected':''}}>Header</option>
                                                    </select>
                                                    {!! $errors->first('position', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group {!! $errors->has('body') ? 'error' : '' !!}">
                                                <label for="body">{{ __('Body') }} <span
                                                        class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <textarea name="body" id="text-editor" cols="30" rows="10" required class="form-control summernote"
                                                        placeholder="{{ __('Enter page body') }}" tabindex="{{ $tabindex++ }}">{{ $row->body }}</textarea>
                                                    {!! $errors->first('body', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group {!! $errors->has('is_active') ? 'error' : '' !!}">
                                                <label for="is_active">{{ __('Is Active')}} <span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <select id="is_active" class="form-control" name="is_active" required tabindex="{{ $tabindex++ }}">
                                                        <option value="1" {{$row->is_active=='1' ? 'selected':''}}>Yes</option>
                                                        <option value="0" {{$row->is_active=='0' ? 'selected':''}}>No</option>
                                                    </select>
                                                    {!! $errors->first('is_active', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-md-12 mb-3 col-12">
                                            <div class="form-group {!! $errors->has('meta_keywords') ? 'error' : '' !!}">
                                                <label for="meta_keywords">{{ __('Meta keywords') }}</label>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="meta_keywords"
                                                        id="meta_keywords" placeholder="{{ __('Enter keywords') }}"
                                                        value="{{ $row->meta_keywords }}" tabindex="{{ $tabindex++ }}">
                                                    {!! $errors->first('meta_keywords', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3 col-12">
                                            <div class="form-group {!! $errors->has('meta_description') ? 'error' : '' !!}">
                                                <label for="meta_description">{{ __('Meta Description') }}</label>
                                                <div class="controls">
                                                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder=""
                                                        tabindex="{{ $tabindex++ }}">{{ $row->meta_description }}</textarea>
                                                    {!! $errors->first('meta_description', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group {!! $errors->has('order_id') ? 'error' : '' !!}">
                                                <label for="order_id">{{ __('Order Id')}} <span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" name="order_id" id="order_id" class="form-control mb-1" required value="{{$row->order_id}}" tabindex="{{ $tabindex++ }}">
                                                    {!! $errors->first('order_id', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group {!! $errors->has('display_in') ? 'error' : '' !!}">
                                                <label for="display_in">{{ __('Display In')}} <span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <select id="display_in" class="form-control" name="display_in" required tabindex="{{ $tabindex++ }}">
                                                        <option value="col-1" {{$row->display_in=='col-1' ? 'selected':''}}>Col 1</option>
                                                        <option value="col-2" {{$row->display_in=='col-2' ? 'selected':''}}>Col 2</option>
                                                        <option value="col-3" {{$row->display_in=='col-3' ? 'selected':''}}>Col 3</option>
                                                        <option value="col-4" {{$row->display_in=='col-4' ? 'selected':''}}>Col 4</option>
                                                    </select>
                                                    {!! $errors->first('display_in', '<label class="help-block text-danger">:message</label>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-actions text-center">
                                                <a href="{{ route('admin.custom-page.list') }}"
                                                    class="btn btn-warning mr-1"><i class="ft-x"></i>
                                                    {{ __('Cancel') }}</a>
                                                <button type="submit" class="btn bg-primary bg-darken-1 text-white">
                                                    <i class="la la-check-square-o"></i> {{ __('Save') }} </button>
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
    @push('custom_js')
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    @endpush
@endsection
