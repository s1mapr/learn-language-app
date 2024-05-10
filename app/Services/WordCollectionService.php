<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

use App\Http\Dto\AnswerDto;
use App\Http\Dto\QuestionDto;
use App\Http\Dto\QuizDto;
use App\Repositories\WordCollectionRepository;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Promise\Utils;
use Illuminate\Http\Client\Pool;

class WordCollectionService
{
    private WordCollectionRepository $wordCollectionRepository;
    private WordService $wordService;
    private TextService $textService;
    private PexelsService $pexelsService;


    public function __construct(WordCollectionRepository $wordCollectionRepository,
                                WordService              $wordService,
                                TextService              $textService,
                                PexelsService            $pexelsService
    )
    {
        $this->wordCollectionRepository = $wordCollectionRepository;
        $this->wordService = $wordService;
        $this->textService = $textService;
        $this->pexelsService = $pexelsService;
    }

    public function createWordCollection($data)
    {
        try {
            Db::beginTransaction();
            $path = 'https://empat-final-project-pictures.s3.amazonaws.com/';
            $words = $this->parseText($data['text']);
            $wordIds = $this->createWordsAndGetIds($words);
            $createdText = $this->textService->saveText(['text' => $data['text']]);
            $newData = [
                'name' => $data['name'],
                'text_id' => $createdText['id'],
                'status' => $data['status']
            ];
            $wordCollection = $this->wordCollectionRepository->createCollection($newData);
            if (isset($data['banner']) && isset($data['poster'])) {
                $bannerUrl = $path . $data['banner']->storeAs('public/banners', 'banner' . $wordCollection->id . '.jpg');
                $posterUrl = $path . $data['poster']->storeAs('public/posters', 'poster' . $wordCollection->id . '.jpg');
                $imagesData = [
                    'poster_url' => $posterUrl,
                    'banner_url' => $bannerUrl
                ];
                $wordCollection = $this->updateCollection($wordCollection->id, $imagesData);
            }
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
        $filteredWords = array_filter($words, function ($word) {
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

    public function getWordCollectionById($collectionId)
    {
        $wordCollection = $this->wordCollectionRepository->getCollectionById($collectionId);
        $this->addView($wordCollection);
        return $wordCollection;
    }

    public function getAllWordCollections()
    {
        return $this->wordCollectionRepository->getAllWordCollections();
    }

    public function getRequestsForPublish()
    {
        return $this->wordCollectionRepository->getRequestsForPublish();
    }

    public function changeCollectionStatus($id, mixed $status)
    {
        return $this->wordCollectionRepository->changeCollectionStatus($id, $status);
    }

    public function getQuiz($collectionId)
    {
        $wordCollection = $this->getWordCollectionById($collectionId);
        $allWords = $this->wordService->getAllWords();
        $collectionWords = $wordCollection->words;
        $wordCount = count($allWords);
        $quiz = new QuizDto();
        $wordId = 1;
        $responses = Http::pool(function (Pool $pool) use ($collectionWords) {
            foreach ($collectionWords as $word) {
                $pool->withHeaders([
                    'Authorization' => 'yE2FB6GoTweWTRDOW6p0hvXKE1tZjgMyt2tEDkSdX7NyOhMdopbWTXAl',
                ])->get('https://api.pexels.com/v1/search?query=' . $word['word']);
            }
        });

        $imges = [];

        foreach ($responses as $response) {
            $jsonData = $response->getBody()->getContents();
            $data = json_decode($jsonData, true);
            $imges[] = $data['photos'][0]['src']['medium'];
        }

        for ($i = 0; $i < count($collectionWords); $i++) {
            $question = new QuestionDto($wordId++, $collectionWords[$i]  , $imges[$i]);
            $question->setAnswers(new AnswerDto(1, $collectionWords[$i]['translation_uk'], true));
            for ($i = 2; $i <= 4; $i++) {
                $randomId = rand(0, $wordCount - 1);
                $randomWord = $allWords[$randomId];
                $isAnswer = false;
                if ($randomWord['word'] == $collectionWords[$i]['word']) {
                    $isAnswer = true;
                }
                $question->setAnswers(new AnswerDto($i, $randomWord['translation_uk'], $isAnswer));
            }
            $question->shuffleAnswers();
            $quiz->setQuestions($question);

        }
        return $quiz->toArray();
    }

    public function flashCards($collectionId)
    {
        $wordCollection = $this->getWordCollectionById($collectionId);
        return $wordCollection->words;
    }

    private function addView($wordCollection)
    {
        $wordCollection->views += 1;
        $wordCollection->save();
    }

    public function getText()
    {
    }

    public function updateCollection($collectionId, $data)
    {
        return $this->wordCollectionRepository->updateCollection($collectionId, $data);
    }

}
