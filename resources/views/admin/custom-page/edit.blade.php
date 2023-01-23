@extends('admin.layouts.admin_app', ['header' => true, 'nav' => true, 'demo' => true])
<!--push from page-->
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush('css')
@section('settings', 'active')
@section('custome_page_edit','active')
@section('title') {{ __('Edit Page')}} @endsection
@section('page-name') {{ __('Edit Page')}} @endsection
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
                    {{ __('Edit Page') }}
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
                    <div class="card card-sm card-success" >
                        <div class="card-header">
                            <div class="col">
                                <div class="float-left">
                                    {{ __('Edit Custome Page') }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="{{route('admin.custom-page.list')}}" class="btn btn-primary">{{ __('Back')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-9">
                                        <form action="{{ route('admin.custom-page.update',$row->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group {!! $errors->has('title') ? 'error' : '' !!}">
                                                        <label for="title">{{ __('Title')}} <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="title" id="title" class="form-control mb-1" required placeholder="{{ __('Enter title')}}" value="{{$row->title}}" tabindex="{{ $tabindex++ }}">
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
                                                            <input type="text" name="url_slug" id="url_slug" class="form-control mb-1" required value="{{$row->url_slug}}" placeholder="{{ __('Enter url slug')}}" tabindex="{{ $tabindex++ }}" readonly>
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
                                                        <label for="body">{{ __('Body')}} <span class="text-danger">*</span></label>
                                                        <div class="controls">
                                                            <textarea name="body" id="text-editor" cols="30" rows="10" required class="form-control summernote" placeholder="{{ __('Enter page body')}}" tabindex="{{ $tabindex++ }}">{{ $row->body }}</textarea>
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
                                                        <label for="meta_keywords">{{ __('Meta keywords')}}</label>
                                                        <div class="controls">
                                                            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" placeholder="{{ __('Enter keywords')}}" value="{{$row->meta_keywords}}" tabindex="{{ $tabindex++ }}">
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
                                                            <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="" tabindex="{{ $tabindex++ }}">{{$row->meta_description}}</textarea>
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
		$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
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
