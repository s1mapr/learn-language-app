<?php

namespace App\Http\Dto;

class QuizDto
{
    private $questions;

    public function __construct()
    {
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions): void
    {
        $this->questions[] = $questions;
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    public function toArray(): array
    {
        return array_map(function($question) {
            return $question->toArray();
        }, $this->questions);
    }


}
