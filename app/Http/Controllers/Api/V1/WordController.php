<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWordRequest;
use App\Http\Resources\V1\WordResource;
use App\Http\Resources\V1\WordCollection;
use App\Models\Word;
use App\Services\WordService;

class WordController extends Controller
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }


    public function index()
    {
        return new WordCollection(Word::all());
    }

    public function show(Word $word){
        return new WordResource($word);
    }

    public function store(StoreWordRequest $request)
    {
        return new WordResource($this->wordService->saveWord($request->all()));
    }
}
//dd();
//return new WordResource(Word::create($request->all()));
