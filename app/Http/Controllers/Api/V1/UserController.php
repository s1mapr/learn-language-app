<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
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

    public function index(){
        $user = $this->userService->getAllUsers();
        return UserResource::collection($user);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $user = $this->userService->updateUser($id, $data);
        return $this->success(new UserResource($user));
    }

    public function startCollection($collectionId){
        $userId = Auth::id();
        $this->userWordCollectionService->startCollection($userId, $collectionId);
        return $this->success('', "collection successfully started");
    }


    //todo refactor this method
    public function userCollections()
    {
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        $wordCollections = $user->wordCollections;
        foreach ($wordCollections as $wordCollection) {
            $words = $wordCollection->words;
            $wordsCount = count($words);
            $wordsLearned = $this->userWordCollectionService->getCountOfUserWords($words, $userId);
            $wordCollection['wordsCount'] = $wordsCount;
            $wordCollection['wordsLearned'] = $wordsLearned;
        }
        return $this->success(WordCollectionResource::collection($wordCollections));
    }

    public function getUserWords(){
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        return $this->success(WordResource::collection($user->words));
    }


}
