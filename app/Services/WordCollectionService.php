<?php

namespace App\Services;

use App\Repositories\WordCollectionRepository;
use Illuminate\Support\Facades\DB;

class WordCollectionService
{
    private WordCollectionRepository $wordCollectionRepository;
    private WordService $wordService;
    private TextService $textService;

    public function __construct(WordCollectionRepository $wordCollectionRepository, WordService $wordService, TextService $textService)
    {
        $this->wordCollectionRepository = $wordCollectionRepository;
        $this->wordService = $wordService;
        $this->textService = $textService;
    }

    public function createWordCollection($data)
    {
        try {
            Db::beginTransaction();
            $words = $this->parseText($data['text']);
            $wordIds = $this->createWordsAndGetIds($words);
            $createdText = $this->textService->saveText(['text'=>$data['text']]);
            $newData = ['name' => $data['name'], 'text_id' => $createdText['id'], 'status'=>$data['status']];
            $wordCollection = $this->wordCollectionRepository->createCollection($newData);
            $wordCollection->words()->attach($wordIds);
            Db::commit();
            return $wordCollection;
        } catch (\Exception $e) {
            Db::rollBack();
            return $e->getMessage();
        }
    }

    public function getPublicCollections()
    {
        return $this->wordCollectionRepository->getPublicCollections();
    }

    private function parseText($text)
    {
        $words = preg_split('/\W+/', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
        $filteredWords = array_filter($words, function($word) {
            return strlen($word) >= 3;
        });
        shuffle($filteredWords);
        return array_unique($filteredWords);
    }

    private function createWordsAndGetIds($words)
    {
        $wordIds = [];
        foreach ($words as $word) {
            $word = $this->wordService->saveWord(['word' => $word]);
            $wordIds[] = $word['id'];
        }
        return $wordIds;
    }

}
