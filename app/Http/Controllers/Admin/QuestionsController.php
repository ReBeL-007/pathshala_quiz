<?php

namespace App\Http\Controllers\Admin;

use App\Quiz;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Question;
use App\Option;
use Gate;
use Illuminate\Foundation\Console\Presets\None;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\Response;

class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('question-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $quiz = Null;
        if(isset($request->quiz)){
            $quiz = Quiz::findOrFail($request->quiz);
            $questions = $quiz->questions();
        }else{
            $questions = Question::whereHas('quizzes', function ($q) {
                        $q->whereIn('quiz_id', Quiz::ofTeacher()->pluck('id'));
                    });
        }

        if (request('show_deleted') == 1) {
            abort_if(Gate::denies('question-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $questions = $questions->onlyTrashed()->paginate(10);
            $questions->withPath('questions?show_deleted=1&quiz='.$quiz->id);
        } else {
            // foreach($questions->where('deleted_at',NULL)->get() as $key => $question) {
            //     $question->question_no = $key + 1;
            //     $question->save();
            // }
            $questions = $questions->where('deleted_at',NULL)->paginate(10);
            $questions->withPath('questions?quiz='.$quiz->id);
            // dd($questions);
        }

        return view('admin.questions.index', compact('questions','quiz'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('question-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(isset($request->quiz)){
            $quizzes = array(Quiz::findOrFail($request->quiz));
        }else{
        $quizzes = Quiz::all();
        }

        // $quizzes = Quiz::ofTeacher()->pluck('title', 'id')->prepend(trans('global.pleaseSelect').' a Quiz', '');

        return view('admin.questions.create', compact('quizzes'));
    }

    public function store(StoreQuestionRequest $request)
    {
        $time = $request->time;
        switch ($request->time_type) {
            case '1':
                $time = $time*60;
                break;
            case '2':
                $time=$time*60*60;
                break;
        }
        $quiz_id = $request->quiz_id;
        $latest_question = Question::whereHas('quizzes', function ($query) use ($quiz_id) {
                            $query->where('quiz_id', $quiz_id);
                        })
                        ->orderBy('question_no','desc')
                        ->first();
        // dd($latest_question);
        $data1 = [
            'question_text' => $request->question_text,
            'type' => $request->type,
            'marks' => $request->marks,
            'answer_explanation' => $request->answer_explanation,
            'question_hint' => $request->question_hint,
            'time'=>$time,
            'question_no' => ($latest_question)?$latest_question->question_no+1:1,
        ];
        // dd($data1);
        $question = Question::create($data1);

        $question->quizzes()->sync($request->quiz_id);
        $quiz=Quiz::find($request->quiz_id);
        if($quiz->remaining_marks != NULL){
            $quiz->remaining_marks = $quiz->remaining_marks - $request->marks;
        }
        $quiz->update();

        //inserting data into options table.
        if($request->type == 'Multiple Choices'){
            $options = $request->option_text;
            $point = $request->points;
            foreach($options as $key => $option){
            $data2 = [
                'option_text' => $option,
                'points' => (($key+1)==$point)?1:0,
                'question_id' => $question->id,
            ];
                Option::create($data2);
            }
        }
        elseif($request->type == 'Multiple Answers'){
            $options = $request->option_text;
            $point = $request->points;
            foreach($options as $key => $option){
                $data2 = [
                    'option_text' => $option,
                    'question_id' => $question->id,
                ];
                if(in_array($key,$request->points)){
                    $data2['points'] = 1;
                }else{
                    $data2['points'] = 0;
                }
                Option::create($data2);
            }
        }
        elseif($request->type == 'True or False'){
            $options = $request->torf;
            $point = $request->points;
            foreach($options as $key => $option){
            $data2 = [
                'option_text' => $option,
                'points' => (($key+1)==$point)?1:0,
                'question_id' => $question->id,
            ];
                Option::create($data2);
            }
        }
        elseif($request->type == 'Short Answer'){
            // $option = $request->saq;
            // if(isset($option)){

            // $data2 = [
            //     'option_text' => $option,
            //     'question_id' => $question->id,
            // ];
            //     Option::create($data2);
            // }

            }
        return back()->with('flash_success','Question Created Successfully.');
    }

    public function edit(Question $question)
    {
        abort_if(Gate::denies('question-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quizzes = Quiz::all();
        $question->load('quizzes');
        return view('admin.questions.edit', compact('quizzes', 'question'));
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
       $data1 = [
                    'question_text' => $request->question_text,
                    'type' => $request->type,
                    'marks' => $request->marks,
                    'answer_explanation' => $request->answer_explanation,
                    'question_hint' => $request->question_hint,
                    'time'=>$request->time,
                    'time_type'=>$request->time_type,
                ];
        $quiz=Quiz::findOrFail($request->quiz_id);
        $quiz->remaining_marks = $quiz->remaining_marks + $question->marks;
        $quiz->remaining_marks = $quiz->remaining_marks - $request->marks;
        $quiz->update();
        $question->update($data1);
        $question->quizzes()->sync($request->quiz_id);



        //inserting data into options table.
        if($request->type == 'Multiple Choices') {
            $options = $request->option_text;
            $point = $request->points;
            $prevOptions = $question->questionOptions->pluck('id');
            if(count($options) == count($prevOptions)) {
                foreach($options as $key => $option) {
                    $data2 = [
                        'option_text' => $option,
                        'points' => (($key)==$point)?1:0,
                        'question_id' => $question->id,
                    ];
                    Option::updateOrInsert(
                        ['question_id'=>$question->id, 'id'=>$prevOptions[$key-1] ],
                        $data2
                    );
                }
            } else {
                Option::where('question_id',$question->id)->delete();
                foreach($options as $key => $option) {
                    $data2 = [
                        'option_text' => $option,
                        'points' => (($key)==$point)?1:0,
                        'question_id' => $question->id,
                    ];
                    Option::create($data2);
                }
            }
        }
        elseif($request->type == 'Multiple Answers') {
            $options = $request->option_text;
            $point = $request->points;
            $prevOptions = $question->questionOptions->pluck('id');

            if(count($options) == count($prevOptions)) {
                foreach($options as $key => $option) {
                $data2 = [
                    'option_text' => $option,
                    'question_id' => $question->id,
                ];
                foreach($point as $p) {
                    if($key == $p) {
                        $data2['points'] = 1;
                            break;
                    } else {
                        $data2['points'] = 0;
                    }
                }

                    Option::updateOrInsert(
                        ['question_id'=>$question->id, 'id'=>$prevOptions[$key-1] ],
                        $data2
                    );
                }
            } else {
                Option::where('question_id',$question->id)->delete();
                foreach($options as $key => $option) {

                    $data2 = [
                        'option_text' => $option,
                        'question_id' => $question->id,
                    ];
                    foreach($point as $p) {
                        if($key+1 == $p) {
                            $data2['points'] = 1;
                                break;
                        } else {
                            $data2['points'] = 0;
                        }
                    }
                    Option::create($data2);
                }
            }
        }
        elseif($request->type == 'True or False') {

            $options = $request->torf;
            $point = $request->points;
            $prevOptions = $question->questionOptions->pluck('id');

            if(count($options) == count($prevOptions)) {
                foreach($options as $key => $option) {

                    $data2 = [
                        'option_text' => $option,
                        'points' => (($key+1)==$point)?1:0,
                        'question_id' => $question->id,
                    ];

                    Option::updateOrInsert(
                        ['question_id'=>$question->id, 'id'=>$prevOptions[$key] ],
                        $data2
                    );
                }
            } else {
                Option::where('question_id',$question->id)->delete();
                foreach($options as $key => $option) {

                    $data2 = [
                        'option_text' => $option,
                        'points' => (($key+1)==$point)?1:0,
                        'question_id' => $question->id,
                    ];
                    Option::create($data2);
                }
            }
        }
        elseif($request->type == 'Short Answer') {

            // $options = $request->saq;
            // // $point = $request->points;
            // $prevOptions = $question->questionOptions->pluck('id');
            // // dd($options);
            // if(count($options) == count($prevOptions)) {
            //     foreach($options as $key => $option) {

            //         $data2 = [
            //             'option_text' => $option,
            //             // 'points' => (($key+1)==$point)?1:0,
            //             'question_id' => $question->id,
            //         ];

            //         Option::updateOrInsert(
            //             ['question_id'=>$question->id, 'id'=>$prevOptions[$key] ],
            //             $data2
            //         );
            //     }
            // } else {
            //     Option::where('question_id',$question->id)->delete();
            //     foreach($options as $key => $option) {

            //         $data2 = [
            //             'option_text' => $option,
            //             // 'points' => (($key+1)==$point)?1:0,
            //             'question_id' => $question->id,
            //         ];
            //         Option::create($data2);
            //     }
            // }
        }
        return redirect()->route('admin.questions.index',['quiz'=>$quiz->id])->with('flash_success','Updated Successfully');
    }

    public function show(Question $question)
    {
        abort_if(Gate::denies('question-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->load('quizzes');

        return view('admin.questions.show', compact('question'));
    }

    public function destroy(Question $question)
    {
        abort_if(Gate::denies('question-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $quiz = $question->quizzes->first();
        $question->delete();
        $quiz->remaining_marks += $question->marks;
        $quiz->save();
        // dd($quiz);
        $remaining_question = Question::whereHas('quizzes', function ($query) use ($quiz) {
                                    $query->where('quiz_id', $quiz->id);
                                })
                                ->where('deleted_at',NULL)
                                ->get();
        foreach($remaining_question as $key => $question) {
            $question->question_no = $key + 1;
            $question->save();
        }
        return back();
    }

    public function massDestroy(MassDestroyQuestionRequest $request)
    {
        $questions = Question::whereIn('id', request('ids'))->get();
        // dd($questions);
        foreach($questions as $question) {
            $quiz = $question->quizzes->first();
            $question->delete();
            $quiz->remaining_marks += $question->marks;
            $quiz->save();


            $remaining_question = Question::whereHas('quizzes', function ($query) use ($quiz) {
                                        $query->where('quiz_id', $quiz->id);
                                    })
                                    ->where('deleted_at',NULL)
                                    ->get();
            foreach($remaining_question as $key => $question) {
                $question->question_no = $key + 1;
                $question->save();
            }
        }
        // dd($quiz);

        // Question::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

     /**
     * Restore Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        abort_if(Gate::denies('question-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->restore();

        $quiz = $question->quizzes->first();
        $quiz->remaining_marks -= $question->marks;
        if($quiz->remaining_marks>=0){
            $quiz->save();
        }else{
            return back()->with('flash_danger','Question Marks is more than remaining marks of quiz.');
        }


        $latest_question = Question::whereHas('quizzes', function ($query) use ($quiz) {
            $query->where('quiz_id', $quiz->id);
        })
        ->orderBy('question_no','desc')
        ->first();
        $question->question_no = $latest_question->question_no + 1;
        $question->save();
        // dd($question);
        return back();
    }

    /**
     * Permanently delete question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        abort_if(Gate::denies('question-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->forceDelete();
        return back();
    }
}
