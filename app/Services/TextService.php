<?php

namespace App\Services;

use App\Repositories\TextRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TextService
{
    private TextRepository $textRepository;


    public function __construct(TextRepository $textRepository)
    {
        $this->textRepository = $textRepository;
    }


    public function saveText($text){
        $translator = new GoogleTranslate();
        $translatedText = $translator->setSource('en')->setTarget('uk')->translate($text['text']);
        $text['translation_uk'] = $translatedText;
        return $this->textRepository->saveText($text);
    }

    public function getTextById($id){
        return $this->textRepository->getTextById($id);
    }
}
