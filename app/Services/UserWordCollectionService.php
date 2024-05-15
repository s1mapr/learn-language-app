<?php

namespace App\Services;

use App\Models\UserWordCollection;
use App\Repositories\UserWordCollectionRepository;

class UserWordCollectionService
{
    private UserWordCollectionRepository $userWordCollectionRepository;
    private UserService $userService;
    private WordCollectionService $wordCollectionService;

    public function __construct(UserWordCollectionRepository $userWordCollectionRepository, UserService $userService, WordCollectionService $wordCollectionService)
    {
        $this->userWordCollectionRepository = $userWordCollectionRepository;
        $this->userService = $userService;
        $this->wordCollectionService = $wordCollectionService;
    }

    public function startCollection($userId, $collectionId)
    {
        $this->userWordCollectionRepository->startCollection($userId, $collectionId);
        $wordCollection = $this->wordCollectionService->getWordCollectionById($collectionId);
        $words = $wordCollection->words;
        $user = $this->userService->getUserById($userId);
        $user->words()->syncWithoutDetaching($words);
    }

    public function makeUserAuthorOfCollection($userId, $wordCollectionId)
    {
        $this->userWordCollectionRepository->makeUserAuthorOfCollection($userId, $wordCollectionId);
    }

    public function getCountOfUserWords($words, $userId)
    {
        $count = 0;
        $userWords = $this->userService->getUserById($userId)->words;
        foreach ($words as $word) {
            if ($userWords->contains($word)) {
                $count++;
            }
        }
        return $count;
    }

    public function checkIfUserHasCollection($userId, $wordCollectionId)
    {
        $userWordCollection = $this->userWordCollectionRepository->getUserWordCollectionByUserIdAndCollectionId($userId, $wordCollectionId);
        return $userWordCollection !== null;
    }

    public function getAuthorIdOfCollection($wordCollectionId)
    {
        $author = $this->userWordCollectionRepository->getAuthorOfCollection($wordCollectionId);
        return $author->user_id;
    }

    public function likeOrUnlikeCollection($userId, $collectionId)
    {
        $this->wordCollectionService->likePublication($collectionId);
        return $this->userWordCollectionRepository->likeOrUnlikeCollection($userId, $collectionId);
    }

    public function checkIfUserLikedCollection($userId, $wordCollectionId)
    {
        $isLiked = $this->userWordCollectionRepository->checkIfUserLikedCollection($userId, $wordCollectionId);
        return $isLiked;
    }

    public function getUserWordCollections($user, $searchQuery)
    {
        return $user->wordCollections()
            ->where('name', 'like', '%' . $searchQuery . '%')
            ->paginate(12);
    }

    public function getUserWordCollectionsWithDetails($user, $searchQuery){
        $wordCollections = $this->getUserWordCollections($user, $searchQuery);
        foreach ($wordCollections as $wordCollection) {
            $words = $wordCollection->words;
            $wordsCount = count($words);
            $wordsLearned = $user->words()->count();
            $wordCollection['wordsCount'] = $wordsLearned;
            $wordCollection['wordsLearned'] = $wordsCount;
            $wordCollection['isLiked'] = $this->checkIfUserLikedCollection($user->id, $wordCollection->id);
            $wordCollection['isStarted'] = $this->checkIfUserHasCollection($user->id, $wordCollection['id']);
        }
        return $wordCollections;
    }

    public function getWordCollectionWithDetails($wordCollection, $userId, $comments = null)
    {
        $words = $wordCollection->words;
        $wordsCount = count($words);
        $wordsLearned = $this->getCountOfUserWords($words, $userId);
        $wordCollection['wordsCount'] = $wordsCount;
        $wordCollection['wordsLearned'] = $wordsLearned;
        $wordCollection['isStarted']=true;
        if(isset($comments)){
            $wordCollection['comments'] = $comments;
        }
        return $wordCollection;
    }

    public function getWordCollectionsWithDetails($wordCollections, $userId)
    {
        foreach ($wordCollections as $wordCollection) {
            $words = $wordCollection->words;
            $wordsCount = count($words);
            $wordsLearned = $this->getCountOfUserWords($words, $userId);
            $wordCollection['wordsCount'] = $wordsCount;
            $wordCollection['wordsLearned'] = $wordsLearned;
            $wordCollection['isLiked'] = $this->checkIfUserLikedCollection($userId, $wordCollection->id);
            $wordCollection['isStarted'] = $this->checkIfUserHasCollection($userId, $wordCollection['id']);
        }
        return $wordCollections;
    }

}
