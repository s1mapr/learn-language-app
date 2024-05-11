<?php

namespace App\Repositories;

use App\Models\UserWordCollection;
use App\Models\WordCollection;

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

    public function makeUserAuthorOfCollection($userId, $wordCollectionId)
    {
        $userWordCollection = UserWordCollection::where('user_id', $userId)
            ->where('word_collection_id', $wordCollectionId)
            ->first();
        $userWordCollection->is_author = true;
        $userWordCollection->update($userWordCollection->toArray());
    }

    public function startCollection($userId, $collectionId)
    {
        $data = [
            'user_id' => $userId,
            'word_collection_id' => $collectionId
        ];
        UserWordCollection::firstOrCreate($data);
    }

    public function getUserWordCollectionByUserIdAndCollectionId($userId, $wordCollectionId)
    {
        return UserWordCollection::where('user_id', $userId)
            ->where('word_collection_id', $wordCollectionId)
            ->first();
    }

    public function getAuthorOfCollection($wordCollectionId)
    {
        return UserWordCollection::where("word_collection_id", $wordCollectionId)
            ->where("is_author", true)
            ->first();
    }

    public function likeOrUnlikeCollection($userId, $collectionId)
    {
        $userCollection = UserWordCollection::where('user_id', $userId)
            ->where('word_collection_id', $collectionId)
            ->first();
        if(!$userCollection){
            return null;
        }
        $userCollection->is_liked = !$userCollection->is_liked;
        $userCollection->update($userCollection->toArray());
        return $userCollection;
    }

    public function checkIfUserLikedCollection($userId, $wordCollectionId)
    {
        $userWordCollection = UserWordCollection::where("word_collection_id", $wordCollectionId)
            ->where("user_id", $userId)
            ->first();
        if(!$userWordCollection){
            return false;
        }
        return $userWordCollection->is_liked;
    }

}
