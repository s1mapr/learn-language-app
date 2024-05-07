<?php

namespace App\Http\Dto;

class QuestionDto
{
    private $word;
    private $answers = [];

    public function __construct($word)
    {
        $this->word = $word;
    }


    public function setAnswers($answers): void
    {
        $this->answers[] = $answers;
    }

    public function shuffleAnswers(): void
    {
        shuffle($this->answers);
    }

    public function toArray(): array
    {
        return [
            'word' => $this->word,
            'answers' => array_map(function($answer) {
                return $answer->toArray();
            }, $this->answers),
        ];
    }


}
