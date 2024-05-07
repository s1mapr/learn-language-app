<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ChangeCollectionStatusRequest;
use App\Http\Requests\V1\StoreCommentRequest;
use App\Http\Requests\V1\StoreWordCollectionRequest;
use App\Http\Resources\V1\AdminViewCollectionResource;
use App\Http\Resources\V1\CommentResource;
use App\Http\Resources\V1\WordCollectionResource;
use App\Http\Resources\V1\WordResource;
use App\Models\WordCollection;
use App\Services\CommentService;
use App\Services\UserWordCollectionService;
use App\Services\WordCollectionService;
use App\Traits\HttpResponseTrait;

class WordCollectionController extends Controller
{
    use HttpResponseTrait;

    private WordCollectionService $wordCollectionService;
    private UserWordCollectionService $userWordCollectionService;
    private CommentService $commentService;

    public function __construct(WordCollectionService $wordCollection, UserWordCollectionService $userWordCollectionService, CommentService $commentService)
    {
        $this->wordCollectionService = $wordCollection;
        $this->userWordCollectionService = $userWordCollectionService;
        $this->commentService = $commentService;
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
        $comments = $this->commentService->getCollectionComments($id);
        return $this->success([
            new WordCollectionResource($wordCollection),
            CommentResource::collection($comments)
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

    public function createComment($id, StoreCommentRequest $request)
    {
        $data= request()->all();
        $data['word_collection_id'] = $id;
        return $this->commentService->createComment($data);
    }

    public function getQuizForCollection($collectionId){
        return $this->success($this->wordCollectionService->getQuiz($collectionId));
    }

}
