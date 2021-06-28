@extends('admin.backend.layouts.master')
@section('title','Edit Student')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.update", [$student->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf   
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.student.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $student->email) }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact">{{ trans('cruds.student.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', $student->contact) }}" required>
                @if($errors->has('contact'))
                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="school">{{ trans('cruds.student.fields.school') }}</label>
                <input class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}" type="text" name="school" id="school" value="{{ old('school', $student->school) }}" required>
                @if($errors->has('school'))
                    <span class="text-danger">{{ $errors->first('school') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.school_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.student.fields.course') }}</label>
                <select class="input-field {{ $errors->has('course_id') ? 'is-invalid' : '' }}" name="course_id" id="course_id" >
                    <option value="">Select course</option>
                    @foreach($courses as $course)
                    
                        <option value="{{ $course->id }}" {{$course->id == $student->course_id ? 'selected' : ''}}>{{ $course->title }}</option>
                    @endforeach
                </select>
                @if($errors->has('course_id'))
                    <span class="text-danger">{{ $errors->first('course_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.course_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.student.fields.status') }}</label>
                <select name="status" >
                <option value="0" {{$student->status == '0' ? 'selected' : ''}}>Deactive</option>
                <option value="1" {{$student->status == '1' ? 'selected' : ''}}>Active</option>
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.status_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="" for="password">{{ trans('cruds.student.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" >
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.password_helper') }}</span>
            </div> --}}
            {{-- <div class="form-group">
                <label class="" for="address">{{ trans('cruds.student.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $student->address) }}" >
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="" for="contact">{{ trans('cruds.student.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="tel" name="contact" id="contact" value="{{ old('contact', $student->contact) }}" >
                @if($errors->has('contact'))
                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="" for="passed">{{ trans('cruds.student.fields.college') }}</label>
                <input class="form-control {{ $errors->has('passed') ? 'is-invalid' : '' }}" type="text" name="passed" id="passed" value="{{ old('passed', $student->passed) }}" >
                @if($errors->has('passed'))
                    <span class="text-danger">{{ $errors->first('passed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.college_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="" for="school">{{ trans('cruds.student.fields.preference') }}</label>
                <input class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}" type="text" name="school" id="school" value="{{ old('school', $student->school) }}" >
                @if($errors->has('school'))
                    <span class="text-danger">{{ $errors->first('school') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.preference_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
