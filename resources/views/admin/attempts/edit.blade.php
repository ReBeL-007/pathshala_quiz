@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Attempts')
@section('styles')
    <style>
        .readonly-editor img, .readonly-editor iframe {
            max-width: 100% !important;
            /* background: black; */
        }
    </style>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />

<style>
    input:disabled {
        color: -internal-light-dark(rgb(8, 8, 8), rgb(14, 14, 14)) !important;
        cursor: default;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .option_text {
        font-weight: normal !important;
    }

    .check {
        float: right;
    }

    .answers:not(:first-child) {
        margin-top: 20px;
    }

    .grading-comtainer {
        background-color: #489aba29;
        height: 7vw;
        display: flex;
        align-items: center;
        border-radius: 20px;
    }

    .grading-text {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 170px;
    }

    .select2-selection {
        background-color: white;
    }

    .change-btn {

        font-size: 1.5rem;
    }

    .select2 {
        width: 300px !important;
        text-align: center;
    }

    .select-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .select2-selection__rendered {
        line-height: 32px !important;
    }

    .select2-selection {
        height: 34px !important;
    }

    .select2-container--krajee .select2-dropdown--below {
        width: 230px !important;
        margin-left: -70px !important;
    }

    .feedback {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .complete-time {
        min-width: 175px;
    }

    .correct-option {
        border: #45d667 solid;
        background-color: #71e98d65;
    }

    .wrong-option {
        border: rgb(255, 53, 53) solid 1px;
        background-color: #e9717139;
    }

    .option {
        padding-left: 10px;
        padding-right: 10px;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    @media screen and (min-device-width: 1000px) and (max-device-width: 1600px) and (-webkit-min-device-pixel-ratio: 1) {

        /* .select-container{
        width: 100%;
        flex: none;
        max-width: none;
    } */
        .grading-comtainer {
            height: 160px;
        }

        /* .review-elem{
        margin-top:10px;
        width: 100%;
        flex: none;
        max-width: none;
    } */
    }


    @media screen and (min-device-width: 768px) and (max-device-width: 1000px) and (-webkit-min-device-pixel-ratio: 1) {
        .review-elem {
            width: 100%;
            flex: none;
            max-width: none;
        }

        .grading-comtainer {
            height: 150px;
        }

    }

    label {
        margin-bottom: 0 !important;
    }

    .grading-input {
        width: 40px;
        height: 30px;
        text-align: center;
    }

    .grading-input-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .next {
        float: right;
    }

    .back {
        float: left;
    }

    .question {
        display: flex;
        align-items: center;
    }

    .option_text {
        display: flex;
        align-items: center;
    }
    .short-answer-container {
    border: 1px solid #0093cd;
    border-radius: 5px;
    padding: 1rem;
    }
</style>
<div class="review-container d-flex justify-content-center">
    <div class="col-md-12">
        {{-- <div class="attempt-nav">
            <div class="back">
                <a><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
            <div class="next">
                <a>Review Next&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <h3>Review: Quiz</h3>
                <div class="grading-comtainer">
                    <div class="row w-100">
                        <div class="col-md-5 review-elem select-container">
                            <a class="change-btn left-btn"><i class="fas fa-angle-left"
                                    style="color: rgb(166, 166, 166);"></i></a>
                            &nbsp;
                            <select class="users-select">
                            </select>
                            &nbsp;
                            <a class="change-btn right-btn"><i class="fas fa-angle-right"
                                    style="color: rgb(166, 166, 166);"></i></a>
                        </div>
                        <div class="col-md-3 complete-time review-elem grading-text">
                            Time to complete: <span class="complete-time-span"></span>
                        </div>
                        <div class="col-md-3 review-elem grading-text">
                            Points: <span class="point-span"></span>
                        </div>
                        <!-- <div class="col-md-1  review-elem feedback-attempt-btn"><i class="far fa-comment-alt"></i>
                        </div> -->
                    </div>
                </div>
                <br>
                <!-- <div class="row w-100">
                    <div class="form-group w-100">
                        <textarea class="form-control feedback-attempt d-none"
                            placeholder="Enter feedback (max 1000 characters)" spellcheck="true" maxlength="1000"
                            rows="3"></textarea>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="answers-container">
                </div>

            </div>
        </div>
    </div>
</div>

{{-- <script>
    var msg = new SpeechSynthesisUtterance();
msg.text = "Hello World";
window.speechSynthesis.speak(msg);
</script> --}}
@stop
@section('scripts')
<script>
    $(function(){
        $attempts = [];
        $.ajax({    async:false,
                    type: 'POST'
                    , url: "{{ route('admin.get_quiz_attempts') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'id':'{{request()->route()->parameters["id"]}}'
                    , }
                    ,success:function(json) {
                    $attempts = JSON.parse(json);
                    console.log($attempts);
                    }

                });

        $attempt_no = 0;

        $.each($attempts,function(i,ele){
            if($attempt_no==i){
            $('.users-select').append('<option value='+i+'>'+$attempts[i].user.name+'</option>').trigger('selected');
            }else{
            $('.users-select').append('<option value='+i+'>'+$attempts[i].user.name+'</option>');
            }
        });
        const hasEditor = false;

        if(! hasEditor){

        }

        // '<div class="option "><input type="radio" disabled="">&nbsp;&nbsp;<label class="option_text" for="">b.test2</label></div>'
        $(document).on('click','.right-btn',function(){
            if($attempts.length >$attempt_no+1 ){
            $attempt_no++;
            $('.users-select').val($attempt_no).trigger('change');
            loadAttempts($attempt_no);
            }
        });
        $(document).on('click','.left-btn',function(){
            if($attempt_no >0 ){
            $attempt_no--;
            $('.users-select').val($attempt_no).trigger('change');
            loadAttempts($attempt_no);
            }
        });

        $(document).on('change','.users-select',function(){
            loadAttempts($(this).val());
        });

        if($attempts.length ==0){
            $('.answers-container').append('<p class="text-center">No attempts available</p>');
        }else{
        loadAttempts($attempt_no);
        }
        function loadAttempts(attempt_no){
            $attempt = $attempts[attempt_no];
            console.log($attempt);
            $('.point-span').html($attempt.total_marks);
            $quiz = $attempt.quiz;
            if($attempt.feedback!=''){
                $('.feedback-attempt').html($attempt.feedback).removeClass('d-none');
            }else{
                $('.feedback-attempt').addClass('d-none');
            }
            $('.feedback-attempt').attr('rel',$attempt.id);
            $('.answers-container').html('');
            var now  = "04/09/2013 15:00:00";
            var then = "02/09/2013 14:20:30";

            var ms = moment($attempt.updated_at,"YYYY-MM-DD HH:mm:ss").diff(moment($attempt.created_at,"YYYY-MM-DD HH:mm:ss"));
            $('.complete-time-span').html(moment.duration(ms).humanize());
            $.each($quiz.questions,function(i,question){
                if(question.deleted_at === null){

                let $attempt_answer = null;
                $attempt.attempt_answers.forEach((attempt_answer) => {
                    if(question.id == attempt_answer.question_id){
                        $attempt_answer = attempt_answer;
                        return;
                    }
                });

                // if($attempt_answer){
                //     $attempt_answer.attempt_options.forEach((attempt_option)=> {

                //     });
                // }

                let options = $('<div></div>');
                if(question.type === 'Multiple Answers'){
                    input_type = 'checkbox'
                }else{
                    input_type = 'radio';
                }
                if(question.type==='Short Answer'){
                    if($attempt_answer.attempt_options){
                        $(options).append(`<div class="readonly-editor short-answer-container">${$attempt_answer.attempt_options[0].answer_text.replace('../','/')}</div>`);
                    }
                    if($attempt_answer.feedback != null){
                        $(options).append(`<div class="form-group mt-3"><small>Feedback</small><textarea class="form-control feedback" rel="${$attempt_answer.id}"placeholder="Enter feedback (max 1000 characters)" spellcheck="true" maxlength="1000" rows="3">${$attempt_answer.feedback}</textarea></div>`);
                    }
                }else{
                question.question_options.forEach((option,index)=>{
                    let check = '';
                    if(option.points){
                        check = '<div class="ml-2"><i class="fas fa-check"></i></div>';
                    }
                    $attempt_option = null;
                    let result = '';
                    let ticked = '';

                    if($attempt_answer){
                        $attempt_answer.attempt_options.forEach((attempt_option)=> {
                            if(attempt_option.option_id == option.id){
                                $attempt_option = attempt_option;
                                return ;
                            }
                        });

                    if($attempt_option !=null){
                        ticked = 'checked';
                    }
                    if(check != '' || ticked !=''){
                        result = 'wrong-option';
                    }
                    if(check != '' && ticked !=''){
                        result = 'correct-option';
                    }
                }
                    $(options).append($(`
                            <div class="option ${result}">
                                    <input type="${input_type}" disabled ${ticked} >&nbsp;&nbsp;<label class="option_text" for="">
                                        ${String.fromCharCode(97+index)}.<div class="readonly-editor">${option.option_text.replace('../','/')}</div>
                                        ${check}
                                </div>
                            `));
                });
            }
            let feedback = $('<div></div>');
            if($attempt_answer!=null){
                $(feedback).append(`
                            <div class="grading-input-container">
                                <h6><input type="text" class="grading-input" rel="${$attempt_answer.id}" value="${$attempt_answer.marks}"> /
                                    ${question.marks} pts</h6>
                            </div>
                            <div class="col-md-3 center"><a class="feedback-btn" rel="${$attempt_answer.id}"></a>
                            </div>
                            `);
            }
                $('.answers-container').append(`
                <div class="attempt-container row my-5" style="position: relative;">
                        <div class="answers col-md-10">
                            <h5 class="question"><small>${question.question_no}</small>.&nbsp;<div class="readonly-editor"><p>${question.question_text.replace('../','/')}</p></div></h5>
                    ${$(options).html()}
                    </div>
                    <div class="" style="position: absolute; right: 0; top: 0;">
                        <div class="row">
                            ${$(feedback).html()}
                        </div>
                    </div>
                </div>
                `);

                }

            });

    $('.image-viewer').each(function(i,ele){
        new Viewer(document.getElementsByClassName('image-viewer')[i]);
    });
    tinymce.init({
                selector: '.readonly-editor',
                inline: true,
                readonly: true,
        });
        }

        function findByQuestion($id){
            $attempt_answers ={};
            $.each($attempt.attempt_answers,function(i,ele){
                if(ele.question_id === $id){
                    console.log('test');
                    $attempt_answers = ele;
                }
            });
            return $attempt_answers;
        }

        $(document).on('click','.feedback-btn',function(){
            if($(this).parents('.attempt-container').find('.feedback').length == 0){
            $(this).parents('.attempt-container').find('.answers').append('<div class="form-group mt-3"><small>Feedback</small><textarea class="form-control feedback" rel="'+$(this).attr("rel")+'"placeholder="Enter feedback (max 1000 characters)" spellcheck="true" maxlength="1000" rows="3"></textarea></div>');
            }
        });

        $(document).on('click','.feedback-attempt-btn',function(){
            $('.feedback-attempt').removeClass('d-none');
        });

        $(document).on('change','.grading-input',function(){
            $marks = ($(this).val()=='')?0:$(this).val();
            $.ajax({
                    type: 'POST'
                    , url: "{{ route('admin.update_answer') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'answer_id':$(this).attr('rel'),
                        'marks': $marks
                    , }
                });
                $.ajax({    async:false,
                    type: 'POST'
                    , url: "{{ route('admin.get_quiz_attempts') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'id':'{{request()->route()->parameters["id"]}}'
                    , }
                    ,success:function(json) {
                    $attempts = JSON.parse(json);
                    $('.point-span').html($attempts[$attempt_no].total_marks);
                    }

                });
        });

        $(document).on('change','.feedback',function(){
            $feedback = ($(this).val()=='')?'[[[clear]]]':$(this).val();
            $.ajax({
                    type: 'POST'
                    , url: "{{ route('admin.update_answer') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'answer_id':$(this).attr('rel'),
                        'feedback': $feedback
                    , }
                });
        });
        $(document).on('change','.feedback-attempt',function(){
            $.ajax({
                    type: 'POST'
                    , url: "{{ route('admin.update_attempt') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'attempt_id':$(this).attr('rel'),
                        'feedback': $(this).val()
                    , }
                });
        });

    });
</script>
@endsection
