<?php
namespace App\Service;
class MultipleChoiceQuestion extends Question
{
    private $incorrectAnswers;

    public function __construct($question)
    {
        $this->category = $question->category;
        $this->text = $question->question;
        $this->correctAnswer = $question->correct_answer;
        $this->incorrectAnswers = $question->incorrect_answers;
    }


}