@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Quiz Response')
@section('styles')
    <style>
        .readonly-editor img, .readonly-editor iframe {
            max-width: 100% !important;
            /* background: black; */
        }
    </style>
@endsection
@section('content')
<style>
    .grading-container {
        background-color: #489aba29;
        height: 7vw;
        display: flex;
        align-items: center;
        padding: 5rem;
        border-radius: 20px;
        display: flex;
    }

    .question {
        display: flex;
        align-items: center;
    }
    .latest-answer-container{
        border: 1px solid #0093cd;
        border-radius: 5px;
        margin: 2rem 0px;
        padding: 1rem;
        position: relative;
    }
    .latest-answer-label{
        position: absolute;
        top: -.7rem;
        background-color: white;
        font-size: .8rem;
    }
</style>
<div class="card">
    <div class="card-body">
        <h3>Review: Quiz</h3>
        <div class="grading-container">
            <div class="row w-100" style="display: flex;justify-content: space-around;">
                <div class="col-md-3 average-score review-elem grading-text">
                    Average Score:
                    @php
                    $totalMarks = 0;
                    foreach ($quiz->attempts->where('status','submitted') as $attempt) {
                    $totalMarks += $attempt->total_marks;
                    }
                    if (count($quiz->attempts->where('status','submitted')) !=0) {
                    echo(round($totalMarks/count($quiz->attempts->where('status','submitted')),2));
                    }else{
                    echo(0);
                    }
                    @endphp
                </div>
                <div class="col-md-3 review-elem grading-text">
                    Responses: {{count($quiz->attempts->where('status','submitted'))}}
                </div>
            </div>
        </div>
        @if (count($quiz->attempts->where('status','submitted')) !=0)
        <a class="btn btn-primary mt-3" href="{{route('admin.show_attempts',['id'=>$quiz->id])}}">Review Answer</a>
        <a class="btn btn-success mt-3" href="{{route('admin.responses.export',['id'=>$quiz->id])}}">Download Excel</a>
        @else
        <br>
        <p class="text-center">No Any Responses</p>
        @endif
        <div class="responses-content-detail">
            @foreach ($quiz->questions->sortBy('question_no')->where('deleted_at',null) as $no=>$question)
            <div class="question">{{$question->question_no}}. <div id="re{{$no}}" class="readonly-editor">
                    {{$question->question_text}}
                </div><span>({{$question->marks}} Points)</span>
            </div>
            <div>
                @php
                $totalCount = 0;
                $correctCount = 0;
                $data = [];
                $percentage = 0;
                if($question->type != 'Short Answer'){
                foreach ($question->questionOptions as $key=>$option) {
                $arr = [
                'id' => $option->id,
                'name' => str_replace('</p>','',str_replace('<p>','',$option->option_text)),
                    'y' =>0.0,
                    'count'=>0,
                    ];

                    if ($option->points == 1) {
                    $arr['name'] = $arr['name'].' ✔';
                    }
                    if($key==0){
                    $arr = $arr+[
                    'sliced'=> true,
                    'selected'=> true
                    ];
                    }
                    array_push($data,$arr);
                    }
                    foreach ($quiz->attempts->where('status','submitted') as $attempt) {
                    $answer = $attempt->attemptAnswers()->where('question_id',$question->id)->first();
                    if($answer != null){
                    if($answer->marks > 0){
                    $correctCount++;
                    }
                    $totalCount++;
                    foreach ($answer->attemptOptions as $l=>$option) {
                    foreach ($data as $i=>$value) {
                    if($value['id'] == $option->option_id){
                    $data[$i]['count'] = $value['count']+1;
                    }
                    }
                    }
                    }
                    }
                    foreach ($data as $i=>$value) {
                    $data[$i]['y'] = $value['count'];
                    }
                    if ($totalCount !=0) {
                    $percentage = round(($correctCount/$totalCount)*100);
                    }else{
                    $percentage = 0;
                    }
                }
                    @endphp
                    {{$percentage}}% of respondents ({{$correctCount}} of {{$totalCount}}) answered this question
                    correctly.
            </div>
            @if($question->type != 'Short Answer')
            <figure class="highcharts-figure">
                <div id="chart{{$no}}"></div>

            </figure>
            <script>
                Highcharts.chart('chart{{$no}}', {
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
      },
      exporting: {
    enabled: false
  },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        layout: 'vertical',
        x: 0,
        y: 100
    },
      title: {
        text: ''
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: false
          },
          showInLegend: true
        }
      },
      series: [{
        name: '',
        colorByPoint: true,
        data: JSON.parse('{{json_encode($data)}}'.replace(/&quot;/g,'"'))
      }]
    });
            </script>
            @else
            <div class="latest-answer-container">
                <label class="latest-answer-label"> Latest Answer </label>
                <div class="readonly-editor">
                    {{App\AttemptAnswer::where('question_id',$question->id)->get()->last()->attemptOptions()->first()->answer_text}}
                </div>
            </div>
            @endif
            @endforeach
        </div>

    </div>
</div>

@endsection
