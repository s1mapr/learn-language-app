<?php

namespace App\Services;

use App\Repositories\WordRepository;
use App\Services\impl\GoogleApiTranslationService;
use App\Services\impl\GoogleLibTranslationService;

class WordService
{
    private WordRepository $wordRepository;
    private TranslationServiceI  $translationService;

    public function __construct(WordRepository $wordRepository, GoogleLibTranslationService  $translationService)
    {
        $this->wordRepository = $wordRepository;
        $this->translationService = $translationService;
    }


    public function saveWord($word)
    {
        $translation = $this->translationService->translate($word['word']);
        $word['translation_uk'] = $translation;
        return $this->wordRepository->saveWord($word);
    }

    public function getAllWordsWithPagination($query){
        return $this->wordRepository->getAllWordsWithPagination($query);
    }

    public function getAllWords()
    {
        return $this->wordRepository->getAllWords();
    }

    public function updateWord($id, $data)
    {
        return $this->wordRepository->updateWord($id, $data);
    }

    public function getWordById($id)
    {
        return $this->wordRepository->getWordById($id);
    }
}
