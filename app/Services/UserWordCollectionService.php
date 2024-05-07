<?php

namespace App\Services;

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
//    public function setOrUnsetCollectionInFavorites($userId, $collectionId)
//    {
//        $this->userWordCollectionRepository->setOrUnsetCollectionInFavorites($userId, $collectionId);
//    }

}
