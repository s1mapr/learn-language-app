<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SearchCollectionRequest;
use App\Http\Requests\V1\SearchUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\AdminViewUserResource;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserWordCollectionResource;
use App\Http\Resources\V1\WordCollectionResource;
use App\Http\Resources\V1\WordResource;
use App\Services\UserService;
use App\Services\UserWordCollectionService;
use App\Services\WordCollectionService;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use HttpResponseTrait;

    private UserService $userService;
    private UserWordCollectionService $userWordCollectionService;
    private WordCollectionService $wordCollectionService;

    public function __construct(UserService $userService, UserWordCollectionService $userWordCollectionService, WordCollectionService $wordCollectionService)
    {
        $this->userService = $userService;
        $this->userWordCollectionService = $userWordCollectionService;
        $this->wordCollectionService = $wordCollectionService;
    }

    public function index(SearchUserRequest $request)
    {
        $searchQuery = $request->get('query');
        $users = $this->userService->getAllUsers($searchQuery);
        return $this->success([
            'currentPage' => $users->currentPage(),
            'lastPage' => $users->lastPage(),
            'size'=>$users->total(),
            'users'=>AdminViewUserResource::collection($users)
        ]);
    }

    public function update($id, UpdateUserRequest $request)
    {

        $data = $request->validated();
        $user = $this->userService->updateUser($id, $data);
        return $this->success(new UserResource($user));
    }

    public function startCollection($collectionId)
    {
        $userId = Auth::id();
        $this->userWordCollectionService->startCollection($userId, $collectionId);
        $collection = $this->wordCollectionService->getWordCollectionById($collectionId);
        $words = $collection->words;
        $wordsCount = count($words);
        $wordsLearned = $this->userWordCollectionService->getCountOfUserWords($words, $userId);
        $collection['wordsCount'] = $wordsCount;
        $collection['wordsLearned'] = $wordsLearned;
        $collection['isStarted'] = true;
        return $this->success(new WordCollectionResource($collection), "collection successfully started");
    }


    //todo refactor this method
    public function userCollections(SearchCollectionRequest $request)
    {
        $searchQuery = $request->get('query');
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        $wordCollections = $user->wordCollections()
            ->where('name', 'like', '%' . $searchQuery . '%')
            ->paginate(12);
        foreach ($wordCollections as $wordCollection) {
            $words = $wordCollection->words;
            $wordsCount = count($words);
            $wordsLearned = $this->userWordCollectionService->getCountOfUserWords($words, $userId);
            $wordCollection['wordsCount'] = $wordsCount;
            $wordCollection['wordsLearned'] = $wordsLearned;
            $wordCollection['isLiked'] = $this->userWordCollectionService->checkIfUserLikedCollection($userId, $wordCollection->id);
            $wordCollection['isStarted'] = $this->userWordCollectionService->checkIfUserHasCollection($userId, $wordCollection['id']);
        }
        return $this->success([
            'currentPage' => $wordCollections->currentPage(),
            'lastPage' => $wordCollections->lastPage(),
            'size'=>$wordCollections->total(),
            'data' => WordCollectionResource::collection($wordCollections),
        ]);
    }

    public function getUserWords()
    {
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        return $this->success(WordResource::collection($user->words));
    }

    public function getUserById($id){
        $user = $this->userService->getUserById($id);
        return $this->success(new UserResource($user));
    }

    public function blockOrUnblockUser($id){
        $this->userService->blockOrUnblockUser($id);
        return $this->success('','user status  successfully changed');
    }

    public function likeOrUnlikeCollection($collectionId){
        $userId = Auth::id();
        $userCollection = $this->userWordCollectionService->likeOrUnlikeCollection($userId, $collectionId);
        if(!$userCollection){
            return $this->error('','user don`t started collection');
        }
        return $this->success('','success');
    }

}
