<?php

namespace App\Imports;

use App\Option;
use App\Question;
use App\Quiz;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class QuestionsImport implements ToModel,WithValidation, WithHeadingRow
{

    public function __construct($quiz)
    {
     $this->quiz = $quiz;
    }

    public function model(array $row)
    {
        if($row['question_type_maq_or_mcq'] == "mcq"){
            $question_type = "Multiple Choices";
        }else if($row['question_type_maq_or_mcq'] == "maq"){
            $question_type = "Multiple Answers";
        }
        $quiz = Quiz::find($this->quiz);

        // to get question no of latest question
        $latest_question = Question::whereHas('quizzes', function ($query) use ($quiz) {
            $query->where('quiz_id', $quiz->id);
        })
        ->orderBy('question_no','desc')
        ->first();
        
        $question = Question::create([
            'question_text' => $row['question'],
            'question_hint' => $row['question_hint'],
            'type' => $question_type,
            'marks' => $row['marks'],
            'question_no' => ($latest_question)?$latest_question->question_no+1:1,
        ]);
        if($quiz->full_marks){
            $quiz->remaining_marks -= $question->marks;
            $quiz->save();
        }
        $quiz->questions()->attach($question);

        Option::create([
            'option_text' => $row['option_1'],
            'points' => (str_contains($row['correct_options'],'1')?1:0),
            'question_id' => $question->id,
        ]);
        Option::create([
            'option_text' => $row['option_2'],
            'points' => (str_contains($row['correct_options'],'2')?1:0),
            'question_id' => $question->id,
        ]);
        if($row['option_3']){
            Option::create([
                'option_text' => $row['option_3'],
                'points' => (str_contains($row['correct_options'],'3')?1:0),
                'question_id' => $question->id,
            ]);
        }
        if($row['option_4']){
            Option::create([
                'option_text' => $row['option_4'],
                'points' => (str_contains($row['correct_options'],'4')?1:0),
                'question_id' => $question->id,
            ]);
        }
        return $question;
    }

    public function rules(): array
    {
        return [
            'question' => [
                'required',
                'string',
            ],
            'question_type_maq_or_mcq' => [
                'required',
                'string',
            ],
            'marks' => [
                'required',
                'int',
            ],
            'option_1' => [
                'required',
            ],
            'option_2' => [
                'required',
            ],
            'correct_options' => [
                'required',
            ],
        ];
    }
}
