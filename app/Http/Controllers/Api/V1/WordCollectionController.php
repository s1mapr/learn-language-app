<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWordCollectionRequest;
use App\Models\WordCollection;
use App\Services\WordCollectionService;

class WordCollectionController extends Controller
{
    private WordCollectionService  $wordCollection;

    public function __construct(WordCollectionService $wordCollection)
    {
        $this->wordCollection = $wordCollection;
    }

    public function store(StoreWordCollectionRequest $request){
        $wordCollection = $this->wordCollection->createWordCollection($request->all());
        return response()->json($wordCollection, 200);
    }

    public function getPublicCollections(){
        return $this->wordCollection->getPublicCollections();
    }


    public function show($id)
    {
        $wordCollection = WordCollection::find($id);
        dd($wordCollection->words);
        //return WordCollection::find($id)->words();
    }

}
