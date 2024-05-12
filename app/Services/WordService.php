<?php

namespace App\Services;

use App\Models\Word;
use App\Repositories\WordRepository;
use Google\Cloud\Translate\V2\TranslateClient;
use Stichoza\GoogleTranslate\GoogleTranslate;

class WordService
{
    private WordRepository $wordRepository;

    public function __construct(WordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }


    public function saveWord($word)
    {
        $translate = new TranslateClient([
            'key' => env('GOOGLE_API_KEY'),
        ]);
        $translatedWord = $translate->translate($word['word'], [
            'target' => 'uk'
        ]);
        $word['translation_uk'] = $translatedWord['text'];
        return $this->wordRepository->saveWord($word);
    }

    public function getAllWords($query){
        return $this->wordRepository->getAllWords($query);
    }
}
