<?php

namespace App\Http\Dto;

class QuestionDto
{
    private $id;
    private $word;
    private $answers = [];

    public function __construct($id, $word)
    {
        $this->id = $id;
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
            'id' => $this->id,
            'word' => $this->word,
            'answers' => array_map(function($answer) {
                return $answer->toArray();
            }, $this->answers),
        ];
    }


}
