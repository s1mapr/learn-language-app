<?php

namespace App\Services;

use App\Models\Word;
use App\Repositories\WordRepository;
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
        $translator = new GoogleTranslate();
        $translatedWord = $translator->setSource('en')->setTarget('uk')->translate($word['word']);
        $word['translation_uk'] = $translatedWord;
        return $this->wordRepository->saveWord($word);
    }
}
