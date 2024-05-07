<?php

namespace App\Http\Dto;

class AnswerDto
{
    private $id;
    private $translation;
    private $isAnswer;

    public function __construct($id, $translation, $isAnswer)
    {
        $this->id = $id;
        $this->translation = $translation;
        $this->isAnswer = $isAnswer;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'translation' => $this->translation,
            'isAnswer' => $this->isAnswer,
        ];
    }

}
