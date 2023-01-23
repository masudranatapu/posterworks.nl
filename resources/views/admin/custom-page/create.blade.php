@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
<!--push from page-->
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush('css')
@section('settings', 'active')
@section('custom_page_list','active')
@section('title') {{ __('Create Page')}} @endsection
@section('page-name') {{ __('Create Page')}} @endsection
<?php
$row = $data ?? [] ;
$tabindex = 1;
?>
@section('content')
<div class="page-wrapper">
    {{--     <div class="container-xl">
        <div class="page-header d-print-none mt-2 mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Overview') }}
                    </div>
                    <h2 class="page-title">
                    {{ __('Create Page') }}
                    </h2>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-12 col-lg-12">
                    <div class="card card-sm card-success" >
                        <div class="card-header">
                            <div class="col">
                                <div class="float-left">
                                    {{ __('Create Custome Page') }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="{{route('admin.custom-page.list')}}" class="btn btn-primary">{{ __('Back')}}</a>
                                </div>
                            </div>
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="la la-times"></i></button>
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="la la-times"></i></button>
                            {{ Session::get('error') }}
                        </div>
                        @endif
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-9">
                                        <form action="{{ route('admin.custom-page.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group {!! $errors->has('title') ? 'error' : '' !!}">
                                                        <label for="title">{{ __('Title')}} <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="title" id="title" class="form-control mb-1" required placeholder="Enter title" tabindex="{{ $tabindex++ }}">
                                                            {!! $errors->first('title', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group {!! $errors->has('url_slug') ? 'error' : '' !!}">
                                                        <label for="url_slug">{{ __('Url Slug')}}<span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="url_slug" id="url_slug" class="form-control mb-1" required placeholder="Enter url slug" tabindex="{{ $tabindex++ }}">
                                                            {!! $errors->first('url_slug', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group {!! $errors->has('position') ? 'error' : '' !!}">
                                                        <label for="position">{{ __('Position')}}<span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <select class="form-control" name="position" id="position" required tabindex="{{ $tabindex++ }}">
                                                                <option value="footer">{{ __('Footer')}}</option>
                                                                <option value="header">{{ __('Header')}}</option>
                                                            </select>
                                                            {!! $errors->first('position', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group {!! $errors->has('body') ? 'error' : '' !!}">
                                                        <label for="body">{{ __('Body')}} <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <textarea name="body" id="text-editor" cols="30" rows="10" required class="form-control summernote" placeholder="Enter page body" tabindex="{{ $tabindex++ }}"></textarea>
                                                            {!! $errors->first('body', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group {!! $errors->has('is_active') ? 'error' : '' !!}">
                                                        <label for="is_active">{{ __('Is Active')}} <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <select id="is_active" class="form-control" name="is_active" required tabindex="{{ $tabindex++ }}">
                                                                <option value="1">{{ __('Yes')}}</option>
                                                                <option value="0">{{ __('No')}}</option>
                                                            </select>
                                                            {!! $errors->first('is_active', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group {!! $errors->has('display_in') ? 'error' : '' !!}">
                                                        <label for="display_in">{{ __('Display In')}} <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <select id="display_in" class="form-control" name="display_in" required tabindex="{{ $tabindex++ }}">
                                                                <option value="col-1">Col 1</option>
                                                                <option value="col-2">Col 2</option>
                                                                <option value="col-3">Col 3</option>
                                                                <option value="col-4">Col 4</option>
                                                            </select>
                                                            {!! $errors->first('display_in', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3 col-12">
                                                    <div class="form-group {!! $errors->has('meta_keywords') ? 'error' : '' !!}">
                                                        <label for="meta_keywords">{{ __('Meta keywords')}}</label>
                                                        <div class="controls">
                                                            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" placeholder="Enter keywords" tabindex="{{ $tabindex++ }}">
                                                            {!! $errors->first('meta_keywords', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3 col-12">
                                                    <div class="form-group {!! $errors->has('meta_description') ? 'error' : '' !!}">
                                                        <label for="meta_description">{{ __('Meta Description')}}</label>
                                                        <div class="controls">
                                                            <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="" tabindex="{{ $tabindex++ }}"></textarea>
                                                            {!! $errors->first('meta_description', '<label class="help-block text-danger">:message</label>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-actions text-center">
                                                        <a href="{{route('admin.custom-page.list')}}" class="btn btn-warning mr-1"><i class="ft-x"></i> {{ __('Cancel')}}</a>
                                                        <button type="submit" class="btn bg-primary bg-darken-1 text-white">
                                                        <i class="la la-check-square-o"></i> {{ __('Save')}} </button>
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/text-editor.js') }}"></script>
<script>
    $('#title').on('keyup keydown paste',function(){
        var str = $(this).val();
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();
        // remove accents, swap ñ for n, etc
        var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeeiiiiooooouuuunc------";
        for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }
        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes
        $("#url_slug").val(str);
        return str;
    })
    var get_url = $('#base_url').val();
    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: '{{URL("admin/ajax/text-editor/image/")}}',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function(url) {
                var image = $('<img>').attr('src', url).attr('data-src', url).attr('class', 'img-fluid img-responsive');
                $('#text-editor').summernote("insertNode", image[0]);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>
@endpush('custom_js')
