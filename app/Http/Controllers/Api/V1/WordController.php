<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WordResource;
use App\Services\WordService;
use App\Traits\HttpResponseTrait;

class WordController extends Controller
{
    use HttpResponseTrait;

    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    public function getAllWords()
    {
        $words = $this->wordService->getAllWords();
        return $this->success([
            'currentPage' => $words->currentPage(),
            'lastPage' => $words->lastPage(),
            'size' => $words->total(),
            "words" => WordResource::collection($words)
            ]);
    }
}
