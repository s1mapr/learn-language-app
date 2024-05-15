<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ChangeCollectionRequest;
use App\Http\Requests\V1\SearchCollectionRequest;
use App\Http\Requests\V1\StoreCommentRequest;
use App\Http\Requests\V1\StoreWordCollectionRequest;
use App\Http\Resources\V1\AdminViewCollectionResource;
use App\Http\Resources\V1\CommentResource;
use App\Http\Resources\V1\FlashCardResource;
use App\Http\Resources\V1\PublicWordCollectionResource;
use App\Http\Resources\V1\StoredWordCollectionResource;
use App\Http\Resources\V1\TextResource;
use App\Http\Resources\V1\WordCollectionResource;
use App\Http\Resources\V1\WordResource;
use App\Services\CommentService;
use App\Services\UserWordCollectionService;
use App\Services\WordCollectionService;
use App\Traits\HttpResponseTrait;
use Illuminate\Support\Facades\Auth;

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

    public function getAllWordCollections(SearchCollectionRequest $request)
    {
        $searchQuery = $request['query'];
        $wordCollections = $this->wordCollectionService->getAllWordCollections($searchQuery);
        foreach ($wordCollections as $wordCollection){
            $wordCollection['userId'] = $this->userWordCollectionService->getAuthorIdOfCollection($wordCollection->id);
        }
        return $this->success([
            'currentPage' => $wordCollections->currentPage(),
            'lastPage' => $wordCollections->lastPage(),
            'size' => $wordCollections->total(),
            'data'=>AdminViewCollectionResource::collection($wordCollections)
        ]);
    }

    public function store(StoreWordCollectionRequest $request)
    {
        $userId = Auth::id();
        $wordCollection = $this->wordCollectionService->createWordCollection($request->all());
        $wordCollectionId = $wordCollection['id'];
        $this->userWordCollectionService->startCollection($userId, $wordCollectionId);
        $this->userWordCollectionService->makeUserAuthorOfCollection($userId, $wordCollectionId);
        $wordCollectionWithDetails = $this->userWordCollectionService->getWordCollectionWithDetails($wordCollection, $userId);
        return $this->success(new StoredWordCollectionResource($wordCollectionWithDetails));
    }

    public function getPublicCollections(SearchCollectionRequest $request)
    {
        $searchQuery = $request['query'];
        $userId = Auth::id();
        $wordCollections = $this->wordCollectionService->getPublicCollections($searchQuery);
        $wordCollectionsWithDetails = $this->userWordCollectionService->getWordCollectionsWithDetails($wordCollections, $userId);
        return $this->success(
            [
                'currentPage' => $wordCollections->currentPage(),
                'lastPage' => $wordCollections->lastPage(),
                'size' => $wordCollections->total(),
                'data' => WordCollectionResource::collection($wordCollectionsWithDetails),
            ]
        );
    }


    public function show($id)
    {
        $userId = Auth::id();
        $wordCollection = $this->wordCollectionService->getWordCollectionById($id);
        $comments = $this->commentService->getCollectionComments($id);
        $wordCollectionWithDetails = $this->userWordCollectionService->getWordCollectionWithDetails($wordCollection, $userId, $comments);
        return $this->success(
            new WordCollectionResource($wordCollectionWithDetails)
        );
    }

    public function getRequestsForPublish(SearchCollectionRequest $request)
    {
        $searchQuery = $request['query'];
        $collectionRequests = $this->wordCollectionService->getRequestsForPublish($searchQuery);
        foreach ($collectionRequests as $collectionRequest){
            $collectionRequest['userId'] = $this->userWordCollectionService->getAuthorIdOfCollection($collectionRequest->id);
        }
        return $this->success([
            'currentPage' => $collectionRequests->currentPage(),
            'lastPage' => $collectionRequests->lastPage(),
            'size' => $collectionRequests->total(),
            "requests"=>AdminViewCollectionResource::collection($collectionRequests)
        ]);
    }

    public function changeCollection($id, ChangeCollectionRequest $request)
    {
        $data = $request->validated();
        $this->wordCollectionService->changeCollection($id, $data);
        return $this->success('', 'collection successfully changed');
    }

    public function createComment($id, StoreCommentRequest $request)
    {
        $userId = Auth::id();
        $data = request()->all();
        $data['word_collection_id'] = $id;
        $data['user_id'] = $userId;
        return $this->success(new CommentResource($this->commentService->createComment($data)));
    }

    public function getTextForCollection($collectionId)
    {
        $wordCollection = $this->wordCollectionService->getWordCollectionById($collectionId);
        return $this->success([
            'text' => new TextResource($wordCollection->text),
            'words' => WordResource::collection($wordCollection->words)
        ]);
    }

    public function getQuizForCollection($collectionId)
    {
        return $this->success($this->wordCollectionService->getQuiz($collectionId));
    }

    public function getFlashCardsForCollection($collectionId)
    {
        return $this->success(FlashCardResource::collection($this->wordCollectionService->flashCards($collectionId)));
    }

}
