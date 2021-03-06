@extends('admin.backend.layouts.master')

@section('title','Add Student')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.student.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.student.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" >
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password_confirmation">{{ trans('cruds.student.fields.password_confirmation') }}</label>
                <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" id="password_confirmation" >
                @if($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="" for="contact">{{ trans('cruds.student.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="tel" name="contact" id="contact" value="{{ old('contact') }}">
                @if($errors->has('contact'))
                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.contact_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="" for="course">{{ trans('cruds.student.fields.category') }}</label>
                        <select class="form-control {{ $errors->has('course_id') ? 'is-invalid' : '' }}" name="course_id" id="course_id" >
                    <option value="">Select course</option>
                    @foreach($courses as  $course)
                    
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected="selected"' : '' }}>{{ $course->title }}</option>
                    @endforeach
                    @if($errors->has('course_id'))
                    <span class="text-danger">{{ $errors->first('course_id') }}</span>
                     @endif
                </select>
                    </div>

            <div class="form-group">
                <label class="" for="school">{{ trans('cruds.student.fields.school') }}</label>
                <input class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}" type="text" name="school" id="school" value="{{ old('school') }}">
                @if($errors->has('school'))
                    <span class="text-danger">{{ $errors->first('school') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.school_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.student.fields.status') }}</label>
                <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                <option value="0" {{ old('status') == "0" ? 'selected' : '' }}>Deactive</option>
                <option value="1" {{ old('status') == "1" ? 'selected' : '' }}>Active</option>
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.status_helper') }}</span>
            </div>

            {{-- <div class="form-group">
                <label class="" for="address">{{ trans('cruds.student.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="address" name="address" id="address" >
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.address_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label class="" for="passed">{{ trans('cruds.student.fields.college') }}</label>
                <input class="form-control {{ $errors->has('passed') ? 'is-invalid' : '' }}" type="text" name="passed" id="passed" >
                @if($errors->has('passed'))
                    <span class="text-danger">{{ $errors->first('passed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.college_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="" for="school">{{ trans('cruds.student.fields.preference') }}</label>
                <input class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}" type="text" name="school" id="school" >
                @if($errors->has('school'))
                    <span class="text-danger">{{ $errors->first('school') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.preference_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
