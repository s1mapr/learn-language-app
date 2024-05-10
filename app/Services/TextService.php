<?php

namespace App\Services;

use App\Repositories\TextRepository;
use Google\Cloud\Translate\V2\TranslateClient;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TextService
{
    private TextRepository $textRepository;


    public function __construct(TextRepository $textRepository)
    {
        $this->textRepository = $textRepository;
    }


    public function saveText($text){
        $translate = new TranslateClient([
            'key' => env('GOOGLE_API_KEY'),
        ]);
        $translatedText = $translate->translate($text['text'], [
            'target' => 'uk'
        ]);
        $text['translation_uk'] = $translatedText['text'];
        return $this->textRepository->saveText($text);
    }

    public function getTextById($id){
        return $this->textRepository->getTextById($id);
    }
}
