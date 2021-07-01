<?php

namespace App\Exports;

use App\Quiz;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuizAttemptsExport implements FromArray,WithHeadings
{
    protected $id;

 function __construct($id) {
        $this->id = $id;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $quiz = Quiz::findOrFail($this->id);
        $full_marks = 0;
        foreach($quiz->questions as $question){
           $full_marks+=$question->marks;
        }
        $attempts = $quiz->attempts->where('status','submitted');
        $results = [];
        foreach ($attempts as $attempt) {
        $data = [
            'user' => $attempt->user->name,
            'contact' => $attempt->user->contact,
            'total_marks' => 0,
            'full_marks' => $full_marks,

        ];
        $total_marks = 0;
        foreach($quiz->questions as $key=>$question){
            $answer_mark = 0;
            foreach ($attempt->attemptAnswers as $answer) {
                if($question->id == $answer->question->id){
                    $answer_mark = $answer->marks;
                    $total_marks += $answer_mark; 
                    break;
                }
            }
            $data['Question '.($key+1)] = ''.$answer_mark.'/'.$question->marks;
        }
        $data['total_marks'] = $total_marks;
        // dd($data);
        array_push($results,$data);

        }

        return $results;

    }

    public function headings():array
    {
        $headings = ["User", "Contact", "Obtained Marks", "Total Marks"];
        $quiz = Quiz::findOrFail($this->id);
        foreach ($quiz->questions as $key => $question) {
            array_push($headings,'Question '.($key+1));
        }
        return $headings;
    }
}
