<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ChangeCollectionStatusRequest;
use App\Http\Requests\V1\StoreWordCollectionRequest;
use App\Http\Resources\V1\AdminViewCollectionResource;
use App\Http\Resources\V1\WordCollectionResource;
use App\Http\Resources\V1\WordResource;
use App\Models\WordCollection;
use App\Services\UserWordCollectionService;
use App\Services\WordCollectionService;
use App\Traits\HttpResponseTrait;

class WordCollectionController extends Controller
{
    use HttpResponseTrait;

    private WordCollectionService $wordCollectionService;
    private UserWordCollectionService $userWordCollectionService;

    public function __construct(WordCollectionService $wordCollection, UserWordCollectionService $userWordCollectionService)
    {
        $this->wordCollectionService = $wordCollection;
        $this->userWordCollectionService = $userWordCollectionService;
    }

    public function index()
    {
        return $this->wordCollectionService->getAllWordCollections();
    }

    public function store(StoreWordCollectionRequest $request)
    {
        $wordCollection = $this->wordCollectionService->createWordCollection($request->all());
        $userId = $request['userId'];
        $wordCollectionId = $wordCollection['id'];
        $this->userWordCollectionService->startCollection($userId, $wordCollectionId);
        $this->userWordCollectionService->makeUserAuthorOfCollection($userId, $wordCollectionId);
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

    public function getRequestsForPublish()
    {
        $collectionRequests = $this->wordCollectionService->getRequestsForPublish();
        return $this->success(AdminViewCollectionResource::collection($collectionRequests));
    }

    public function changeStatusOfCollection($id, ChangeCollectionStatusRequest $request){
        $status = $request['status'];
        $collection = $this->wordCollectionService->changeCollectionStatus($id, $status);
        return $this->success($collection);
    }

}
