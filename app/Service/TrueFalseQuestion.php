<?php

namespace App\Service;
class TrueFalseQuestion extends Question
{

    public function __construct($question)
    {
        $this->category = $question->category;
        $this->text = $question->question;
        $this->correctAnswer = $question->correct_answer;
    }


}