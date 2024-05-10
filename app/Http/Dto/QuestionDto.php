<?php

namespace App\Http\Dto;

class QuestionDto
{
    private $id;
    private $word;
    private $pictureUrl;
    private $answers = [];

    public function __construct($id, $word, $pictureUrl)
    {
        $this->id = $id;
        $this->word = $word;
        $this->pictureUrl = $pictureUrl;
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
            'pictureUrl' => $this->pictureUrl,
            'answers' => array_map(function($answer) {
                return $answer->toArray();
            }, $this->answers),
        ];
    }


}
