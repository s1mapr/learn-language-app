<?php

namespace App\Repositories;

use App\Models\UserWordCollection;

class UserWordCollectionRepository
{

    public function findByUserIdAndWordCollectionId($userId, $collectionId)
    {
        return UserWordCollection::where('user_id', $userId)
            ->where('word_collection_id', $collectionId)
            ->first();
    }

    public function setOrUnsetCollectionInFavorites($userId, $collectionId)
    {

    }
}
