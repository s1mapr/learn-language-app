<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWordCollectionRequest;
use App\Http\Resources\V1\WordCollectionResource;
use App\Http\Resources\V1\WordResource;
use App\Models\WordCollection;
use App\Services\WordCollectionService;
use App\Traits\HttpResponseTrait;

class WordCollectionController extends Controller
{
    use HttpResponseTrait;

    private WordCollectionService $wordCollectionService;

    public function __construct(WordCollectionService $wordCollection)
    {
        $this->wordCollectionService = $wordCollection;
    }

    public function index()
    {
        return $this->wordCollectionService->getAllWordCollections();
    }

    public function store(StoreWordCollectionRequest $request)
    {
        $wordCollection = $this->wordCollectionService->createWordCollection($request->all());
        return response()->json($wordCollection, 200);
    }

    public function getPublicCollections()
    {
        return $this->wordCollectionService->getPublicCollections();
    }


    public function show($id)
    {
        $wordCollection = $this->wordCollectionService->getWordCollectionById($id);
        return $this->success([
            new WordCollectionResource($wordCollection),
        ]);
    }

}
