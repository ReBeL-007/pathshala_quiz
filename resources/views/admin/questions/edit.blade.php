@extends('admin.backend.layouts.master')
@section('title','Edit Question')


@section('styles')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('css/bootstrap/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/admin/addQuizform.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" id="question-update-form" action="{{ route("admin.questions.update", [$question->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="field-wrapper">
                <label for="quiz_id" placeholder="Please select a quiz">Please select a quiz</label>
                <select class="{{ $errors->has('quiz_id') ? 'is-invalid' : '' }}" name="quiz_id" id="quiz_id" required>
                    <option value="">Please select a quiz</option>
                    @foreach($quizzes as $id => $quiz)
                    <option value="{{ $quiz->id }}"  rel-time="{{isset($quiz->time)?$quiz->time:''}}" rel-marks="{{isset($quiz->remaining_marks)?$quiz->remaining_marks:''}}"
                        rel-type="{{isset($quiz->quiz_type)?$quiz->quiz_type:''}}"
                        @foreach($question->quizzes as $q)
                        {{ ($q->id == $quiz->id || old('quiz_id') == $quiz->id)?'selected':''  }}
                        @endforeach>{{ $quiz->title }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('quiz_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('quiz_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.quiz_helper') }}</span>
            </div>
            <div class="field-wrapper">
                <label for="type" placeholder="Please select a type">Please select a type</label>
                <select class="{{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value="Multiple Choices" {{$question->type == 'Multiple Choices' ? 'selected' : '' }}>
                        Multiple Choices</option>
                    <option value="Multiple Answers" {{$question->type == 'Multiple Answers' ? 'selected' : '' }}>
                        Multiple Answers</option>
                    <option value="True or False" {{($question->type == 'True or False') ? 'selected' : '' }}>True or
                        False </option>
                    <option value="Short Answer" {{$question->type == 'Short Answer' ? 'selected' : '' }}>Short Answer
                    </option>
                    {{-- <option value="Long Answer" {{$question->type == 'Long Answer' ? 'selected' : '' }}>Long Answer
                    </option> --}}
                </select>
                @if($errors->has('type'))
                <div class="invalid-feedback">
                    {{ $errors->first('type') }}
                </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.question.fields.type_helper') }}</span> --}}
            </div>
            <br>
            <div class="form-group editor-container" id="quest">
                <label for="question-text" class="editor-label"> Write Question</label>
                <div class="editor {{ $errors->has('question_text') ? 'is-invalid' : '' }}" id="question_text">
                    {{$question->question_text}}
                </div>
                @if($errors->has('question_text'))
                <div class="invalid-feedback">
                    {{ $errors->first('question_text') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>



            @if($question->type == 'Multiple Choices')
            <div class="options-container">
                @foreach($question->questionOptions as $key=>$options)
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="radio" class="points" name="points" id="option{{ $key+1 }}" value="{{ $key+1 }}"
                            {{ (($options->points==1) ? 'checked' : '' )}}>
                        <label for="option{{ $key+1 }}">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option {{$key+1}}</label>
                        <div class="option-editor editor opt-editor-{{$key+1}} {{ $errors->has('option_text') ? 'is-invalid' : '' }}"
                            id="option_text[{{$key+1}}]" rel-pos="{{$key+1}}">{{$options->option_text}}
                        </div>
                    </div>
                    @if ($key > 1)
                    <div><a class="btn btn-danger text-white option-delete-btn"><i class="fas fa-trash"></i></a></div>
                    @endif
                    @if($errors->has('option_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_text') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
                </div>
                @endforeach
            </div>
            <div class="form-group option-button-container">
                @if (count($question->questionOptions)<4)
                    <input type="button" class="btn btn-default" id="add-mcq-option" value="Add more option">
                @endif
            </div>

            {{-- multi answers --}}
            @elseif($question->type == 'Multiple Answers')
            <div class="options-container">
                <div class="col-md-12 row">
                    @foreach($question->questionOptions as $key=>$options)
                    <div class="col-md-12 row option-pad">
                        <div class="icheck-success">
                            <input type="checkbox" name="points[]" class="points" id="option{{ $key+1 }}" value="{{ $key+1 }}"
                                {{ (($options->points==1) ? 'checked' : '' )}}>
                            <label for="option{{ $key+1 }}">
                            </label>
                        </div>
                        <div class="col-md-8 option-container">
                            <label for="question-text" class="editor-label">Option {{$key+1}}</label>
                            <div class="option-editor editor opt-editor-{{$key+1}} {{ $errors->has('option_text') ? 'is-invalid' : '' }}"
                                id="option_text[{{$key+1}}]" rel-pos="{{$key+1}}">{{$options->option_text}}
                            </div>
                        </div>
                        @if ($key > 1)
                            <div><a class="btn btn-danger text-white option-delete-btn"><i class="fas fa-trash"></i></a></div>
                        @endif
                        @if($errors->has('option_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('option_text') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group option-button-container">
                @if (count($question->questionOptions)<4)
                    <input type="button" class="btn btn-default" id="add-maq-option" value="Add more option">
                @endif
            </div>
            @endif
            <div class="form-group editor-container">
                <label for="question-hint" class="editor-label"> Write hint for the question</label>
                <div id="question_hint" class="editor {{ $errors->has('question_hint') ? 'is-invalid' : '' }}" >
                    {{$question->question_hint}}
                </div>
                @if($errors->has('question_hint'))
                <div class="invalid-feedback">
                    {{ $errors->first('question_hint') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>
            <div class="form-group editor-container">
                <label for="question-hint" class="editor-label"> Write explanation of correct answer here</label>
                <div id="answer_explanation"
                    class="editor {{ $errors->has('answer_explanation') ? 'is-invalid' : '' }}">
                    {{$question->question_explanation}}
                </div>
                @if($errors->has('answer_explanation'))
                <div class="invalid-feedback">
                    {{ $errors->first('answer_explanation') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>
            <div class="form-group row">
                <label for="time" placeholder="Time Limit">Time Limit: </label>
                <div class="form-group col-lg-2">
                    <input class="col-lg-12" type="number" name="time" id="time" value="{{ $question->time }}" required
                        {{$question->time?'':'disabled'}}>
                </div>
                <div class="form-group col-lg-2">
                    <select class="{{ $errors->has('time_type') ? 'is-invalid' : '' }} col-lg-12" name="time_type"
                        id="time_type" required {{$question->time_type?'':'disabled'}}>
                        <option value="0" {{ (($question->time_type==0) || old('time_type')) ? 'selected' : '' }}>
                            seconds
                        </option>
                        <option value="1" {{ (($question->time_type==1) || old('time_type')) ? 'selected' : '' }}>
                            minutes
                        </option>
                        <option value="2" {{ (($question->time_type==2) || old('time_type')) ? 'selected' : '' }}>hours
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="" id="time_limit"> Enable
                </div>
            </div>
            <div class="form-group row ">
                <label class="ml-2" for="marks" placeholder="">{{ trans('cruds.question.fields.marks') }}</label>
                <div class="col-lg-2">
                    <input type="number" name="marks" class="form-control" id="marks" value="{{$question->marks}}">
                    <div id="marks-feedback" class="invalid-feedback">
                      </div>
                    <small id="remaining-marks"></small><br>
                    <small class="marks-help-block help-block">
                        {{ trans('cruds.question.fields.marks_helper') }}</small>
                </div>
                @if($errors->has('marks'))
                <div class="invalid-feedback">
                    {{ $errors->first('marks') }}
                </div>
                @endif
            </div>
    </div>

    <div class="card-footer">
        <div class="form-group">
            <button class="btn btn-success" type="submit" id="submit-btn">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/admin/adaptiveDropdown.js') }}"></script>
<script>
     function create_tiny_mce(selector){
        tinymce.init({
                selector: selector,
                inline:true,
                plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                // external_plugins: {
                //     'tiny_mce_wiris' : "{{ asset('backened/plugins/@wiris/mathtype-tinymce5/plugin.min.js')}}"
                // },
                imagetools_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar: 'bold italic underline | fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor | charmap emoticons | fullscreen  preview | insertfile image media link codesample | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistr',
                toolbar_sticky: true,
                image_advtab: true,
                file_picker_types: 'image',
                automatic_uploads: true,
                images_upload_url: '{{route("admin.quizzes.saveImage")}}',
                icons: "thin",
                height: 600,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                quickbars_insert_toolbar: "image media table hr",
                toolbar_mode: 'sliding',
                contextmenu: 'link image imagetools table',
                skin:  'snow',
                content_css: 'default',
        });
    }
    $(function(){
        $("#type").change(function() {
            const question_type = $(this).val();
            console.log(question_type);
            $('.options-container').html('');
            $('.option-button-container').html('');
            tinymce.remove(`.opt-editor-1`);
            tinymce.remove(`.opt-editor-2`);
            tinymce.remove(`.opt-editor-3`);
            tinymce.remove(`.opt-editor-4`);
            if(question_type === 'Multiple Choices'){
                $('.options-container').append(`
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="radio" name="points" class="points" id="option1" value="1">
                        <label for="option1">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option 1</label>
                        <div class="editor option-editor" id="option_text[1]">
                            </div>
                    </div>
                    <div class="invalid-feedback">
                    </div>
                    <span class="help-block"></span>
                </div>
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="radio" name="points" class="points" id="option2" value="2" required>
                        <label for="option2">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option 2</label>
                        <div class="editor option-editor" id="option_text[2]">
                            </div>
                    </div>
                    <div class="invalid-feedback">
                    </div>
                    <span class="help-block"></span>
                </div>
                `);
                $('.option-button-container').html('<input type="button" class="btn btn-default" id="add-mcq-option" value="Add more option">');
            }else if(question_type === 'Multiple Answers'){
                $('.options-container').append(`
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="checkbox" class="points" name="points[1]" id="option1" value="1">
                        <label for="option1">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option 1</label>
                        <div class="editor option-editor" id="option_text[1]">
                            </div>
                    </div>
                    <div class="invalid-feedback">
                    </div>
                    <span class="help-block"></span>
                </div>
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="checkbox" class="points" name="points[2]" id="option2" value="2">
                        <label for="option2">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option 2</label>
                        <div class="editor option-editor" id="option_text[2]">
                            </div>
                    </div>
                    <div class="invalid-feedback">
                    </div>
                    <span class="help-block"></span>
                </div>
                `);
                $('.option-button-container').html('<input type="button" class="btn btn-default" id="add-maq-option" value="Add more option">');
            }else if(question_type === 'True or False'){
                $('.options-container').append(`<div class="torf" id="torf">
                                    <div class="col-md-12 row" style="margin-bottom:5px;">
                                        <div class="icheck-success">
                                            <input type="radio" class="points" name="points" id="option1" value="1" required>
                                            <label for="option1">
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                        <input class="" name="torf[]" id="torf" type="text" value="True" readonly>
                                        </div>
                                            <div class="invalid-feedback">
                                            </div>
                                        <span class="help-block"></span>
                                    </div>
                                    <br>
                                    <div class="col-md-12 row">
                                        <div class="icheck-success">
                                            <input type="radio" class="points" name="points" id="option2" value="2" required>
                                            <label for="option2">
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                        <input class="" name="torf[]" id="torf" type="text" value="False" readonly>

                                        </div>
                                            <div class="invalid-feedback">
                                            </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>`);
            }
            create_tiny_mce('.option-editor');
        });

        $(document).on('click','#add-maq-option',function(){
            const option_count = $('.option-editor').length+1;

            $('.options-container').append(`
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="checkbox" name="points[${option_count}]" class="points" id="option${option_count}" value="${option_count}">
                        <label for="option${option_count}">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option ${option_count}</label>
                        <div class="editor option-editor opt-editor-${option_count}" rel-pos="${option_count}" id="option_text[${option_count}]">
                            </div>
                    </div>
                    <div><a class="btn btn-danger text-white option-delete-btn"><i class="fas fa-trash"></i></a></div>
                    <div class="invalid-feedback">
                    </div>
                    <span class="help-block"></span>
                </div>
                `);
                create_tiny_mce(`.opt-editor-${option_count}`);
                if(option_count>3){
                    $('#add-maq-option').remove();
                }
        });

        $(document).on('click','#add-mcq-option',function(){
            const option_count = $('.option-editor').length+1;
            $('.options-container').append(`
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="radio" class="points" name="points" id="option${option_count}" value="${option_count}">
                        <label for="option${option_count}">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option ${option_count}</label>
                        <div class="editor option-editor opt-editor-${option_count}" rel-pos="${option_count}" id="option_text[${option_count}]">
                            </div>
                    </div>
                    <div><a class="btn btn-danger text-white option-delete-btn"><i class="fas fa-trash"></i></a></div>
                    <div class="invalid-feedback">
                    </div>
                    <span class="help-block"></span>
                </div>
                `);
                create_tiny_mce(`.opt-editor-${option_count}`);
                if(option_count>3){
                    $('#add-mcq-option').remove();
                }
        });

        $(document).on('click','.option-delete-btn',function(){
            position = $(this).parents('.option-pad').find('.option-editor').attr('rel-pos');
            if(position == 3){
                if($('.opt-editor-4').length!=0){
                    tinymce.get('option_text[3]').setContent(tinymce.get('option_text[4]').getContent());
                    $('#option3').prop("checked", $('#option4').prop("checked"));
                    tinymce.remove(`.opt-editor-4`);
                    $('.opt-editor-4').parents('.option-pad').remove();
                }else{
                tinymce.remove(`.opt-editor-${position}`);
                $(this).parents('.option-pad').remove();
                 }
            }else{
                tinymce.remove(`.opt-editor-${position}`);
                $(this).parents('.option-pad').remove();
            }
            if($('#type').val()==='Multiple Choices'){
                type = 'mcq';
            }else if($('#type').val()==='Multiple Answers'){
                type = 'maq';
            }
            $('.option-button-container').html(`<input type="button" class="btn btn-default" id="add-${type}-option" value="Add more option">`);
        });

        // validation check
        $('#question-update-form').on('submit',function(e){
            e.preventDefault();
            hasError = false;
            console.log($('#type').val());

            if($('#type').val() == ''){
                hasError = true;
                $('#type').addClass('is-invalid');
            }else{
                $('#type').removeClass('is-invalid');
            }

            if(tinymce.get('question_text').getContent() == ''){
                    hasError = true;
                    $('#question_text').addClass('invalid');
                    $('html, body').animate({
                        scrollTop: $('#question_text').offset().top
                    }, 100, 'linear');
                }

            $('.option-editor').each(function(i,ele){
                if(tinymce.get(ele.id).getContent() == ''){
                    hasError = true;
                    $(ele).addClass('invalid');
                    $('html, body').animate({
                        scrollTop: ele.offsetTop
                    }, 100, 'linear');
                }else{
                    $(ele).removeClass('invalid');
                }
            });

            if($('.points:checked').length == 0 && $('#type').val() !== 'Short Answer'){
                hasError = true;
                $('.points').parent().addClass('invalid');
                $('html, body').animate({
                        scrollTop: $('.points').parent().offset().top
                    }, 100, 'linear');
             }else{
                $('.points').parent().removeClass('invalid');
             }

            if($('#marks').val() == '' || $('#marks').val() == 0){
                hasError = true;
                $('#marks').addClass('is-invalid');
                $('#marks-feedback').html('Marks is required.');
            }

            if(! hasError){
                event.target.submit();
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#quiz_id',function(){
            $selected_option = $(this).find('option:selected');
            if( $selected_option.attr('rel-time') == ''){
                $('#time-container').removeClass('d-none');
            }else{
                $('#time-container').addClass('d-none');
            }
            if($selected_option.attr('rel-type').trim()=='Practice Quiz'){
                $('#remaining-marks').addClass('d-none');
            }
            $final_remaining_marks = parseFloat($selected_option.attr('rel-marks'))+parseFloat($('#marks').val());
            if($selected_option != ''&& $final_remaining_marks!=''){
                $('#remaining-marks').html('Remaining marks:'+$final_remaining_marks);
                $('#remaining-marks').attr('rel-marks',$final_remaining_marks);
                if(parseInt($final_remaining_marks)<=0 && $selected_option.attr('rel-type').trim()!='Practice Quiz'){
                    $('#submit-btn').attr('disabled');
                }
            }
        });

        $('#quiz_id').val($('#quiz_id').val()).trigger('change');
        $(document).on('keyup','#marks',function(){
            $remaining_marks = $final_remaining_marks - $(this).val();
            if($selected_option != ''&& $final_remaining_marks!=''){
                $('#remaining-marks').html('Remaining marks:'+($final_remaining_marks-$(this).val()));
                $('#remaining-marks').attr('rel-marks',$final_remaining_marks-$(this).val());
            }
            $selected_option = $('#quiz_id').find('option:selected');
            if($selected_option.attr('rel-type').trim()=='Practice Quiz'){
                $('#remaining-marks').addClass('d-none');
            }
            else{
                $('#remaining-marks').removeClass('d-none');
            }
            if($remaining_marks<0 && $selected_option.attr('rel-type').trim()!='Practice Quiz'){
                $('#submit-btn').attr('disabled',true);
                $('.marks-help-block').html('Marks is more than remaining marks');
            }else{
                $('#submit-btn').removeAttr('disabled');
                $('.marks-help-block').html('');
            }
        });
        $('#marks').keyup();

        $('#time_limit'). click(function(){
                if($(this). is(":checked")){
                $("#time, #time_type").removeAttr('disabled');
                }
                else if($(this). is(":not(:checked)")){
                $("#time, #time_type").attr('disabled','true');
                }
            });

        });
</script>
@endsection
