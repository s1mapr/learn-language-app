<?php

namespace App\Http\Dto;

class AnswerDto
{
    private $id;
    private $translation;
    private $pictureUrl = 'https://storage.googleapis.com/pod_public/1300/165117.jpg';
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
            'pictureUrl' => $this->pictureUrl,
            'translation' => $this->translation,
            'isAnswer' => $this->isAnswer,
        ];
    }

}
