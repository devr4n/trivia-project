<?php

namespace App\Service;


class Trivia
{
    private $api;
    private $amount = 10;
    private $difficulty = 'easy';
    private $type = 'multiple';
    private $questions;

    public function __construct( $api)
    {
        $this->api = $api;
    }

    public function amount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function difficulty($difficulty)
    {
        $this->difficulty = $difficulty;
        return $this;
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    public function load()
    {
        $response = $this->api->get($this->amount, $this->difficulty, $this->type);
        $questions = json_decode($response)->results;
        $this->mapQuestions($questions);
        return $this;
    }

    public function questions()
    {
        return $this->questions;
    }

    private function mapQuestions($questions)
    {
        $this->questions = collect(
            array_map(function ($question) {
                if ($question->type === 'multiple') {
                    return new MultipleChoiceQuestion($question);
                }
                return new TrueFalseQuestion($question);
            }, $questions)
        );
    }

}
