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
        $user = $this->userService->getUserById($userId);
        $wordCollection = $this->wordCollectionService->getWordCollectionById($collectionId);
        $user->wordCollections()->attach($wordCollection);
    }

//    public function setOrUnsetCollectionInFavorites($userId, $collectionId)
//    {
//        $this->userWordCollectionRepository->setOrUnsetCollectionInFavorites($userId, $collectionId);
//    }


}
