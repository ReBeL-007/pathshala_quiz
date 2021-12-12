@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Quizzes')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.response.title_singular') }} @lang('global.list')
    </div>
    @if (count($quiz->attempts->where('status','submitted')) !=0)
    <div>
        <a class="btn btn-success mt-3 " href="{{route('admin.responses.export',['id'=>$quiz->id])}}">Download Excel <i class="far fa-file-excel"></i></a>
    </div>
    @endif
    <div class="card-body">
        <table class=" table table-bordered table-striped datatable table-hover datatable-Quiz">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Total Marks</th>
                    <th>Exam Date</th>
                </tr>
            </thead>

            <tbody>
            
                @foreach ($quiz->attempts()->where('status','submitted')->orderBy('total_marks', 'DESC')->get() as $key=>$attempt)
                <tr data-entry-id="{{ $attempt->id }}">
                    <td>{{$key+1}}</td>
                    <td>{{$attempt->user->name}}</td>
                    <td>
                    <?php
                        $total_marks = 0;
                        foreach($quiz->questions as $key=>$question){
                            $answer_mark = 0;
                            foreach ($attempt->attemptAnswers as $answer) {
                                if($question->id == $answer->question->id){
                                    $total_marks += $answer->marks;
                                    break;
                                }
                            }
                        }
                    ?>
                    {{$total_marks}}</td>
                    <td>{{$attempt->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
  let table = $('.datatable-Quiz').DataTable({
    select: false,
    order: [[2,"desc"]],
    columnDefs: [ {
                orderable: true
                , searchable: true
                , targets: -1
            }],
  });
})
</script>
@endsection
