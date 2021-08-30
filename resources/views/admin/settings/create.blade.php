@extends('admin.backend.layouts.master')

@section('title','Settings')

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.setting') }}
    </div>

    <div class="card-body">
    @if(isset ($settings))
        <form method="POST" action="{{ route('admin.settings.update', [$settings->id]) }}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
    @endif
            @csrf
            <div class="form-group">
                <label class="required" for="title">Project Title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" placeholder="Enter Project Title" value="{{ old('title', $settings->title ?? '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="theme_color">Theme Color</label>
                <input class="form-control {{ $errors->has('theme_color') ? 'is-invalid' : '' }}" type="text" name="theme_color" id="theme_color" placeholder="Enter Project Theme Color" value="{{ old('theme_color', $settings->theme_color ?? '') }}" >
                @if($errors->has('theme_color'))
                    <span class="text-danger">{{ $errors->first('theme_color') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! $settings->description ?? '' !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <!--form control-->

            <div class="form-group">
                <label class="" for="logo">Logo</label>
                <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" type="file" name="logo" id="logo" value="{{ old('logo', $settings->logo ?? '') }}" >
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                @if(isset($settings->logo))
                    <img src="{{asset('storage/uploads/logo/'.$settings->logo)}}" alt="project logo" width="150">
                @endif
            </div>
            <!--form control-->

            <div class="form-group">
                <label class="" for="favicon">Favicon</label>
                <input class="form-control {{ $errors->has('favicon') ? 'is-invalid' : '' }}" type="file" name="favicon" id="favicon" value="{{ old('favicon', $settings->favicon ?? '') }}" >
                @if($errors->has('favicon'))
                    <span class="text-danger">{{ $errors->first('favicon') }}</span>
                @endif
                @if(isset($settings->favicon))
                    <img src="{{asset('storage/uploads/favicon/'.$settings->favicon)}}" alt="project favicon" width="150">
                @endif
            </div>
            <!--form control-->

            <div class="form-group">
                <label class="" for="copyright">Copyright</label>
                <textarea class="ckeditor form-control {{ $errors->has('copyright') ? 'is-invalid' : '' }}" name="copyright" id="copyright" placeholder="Enter Copyright text">{!! $settings->copyright ?? '' !!}</textarea>
                @if($errors->has('copyright'))
                    <span class="text-danger">{{ $errors->first('copyright') }}</span>
                @endif
            </div>
            <!--form control-->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@stop

@section('ascripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
