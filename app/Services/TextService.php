<?php

namespace App\Services;

use App\Repositories\TextRepository;
use App\Services\impl\GoogleApiTranslationService;
use App\Services\impl\GoogleLibTranslationService;

class TextService
{
    private TextRepository $textRepository;
    private TranslationServiceI $translationService;


    public function __construct(TextRepository $textRepository, GoogleLibTranslationService $translationService)
    {
        $this->textRepository = $textRepository;
        $this->translationService = $translationService;
    }


    public function saveText($text){
        $translation = $this->translationService->translate($text['text']);
        $text['translation_uk'] = $translation;
        return $this->textRepository->saveText($text);
    }

    public function getTextById($id){
        return $this->textRepository->getTextById($id);
    }

    public function updateText($id, $data){
        $this->textRepository->updateText($id, $data);
    }
}
