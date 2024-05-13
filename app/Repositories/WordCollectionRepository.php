<?php

namespace App\Repositories;

use App\Models\WordCollection;

class WordCollectionRepository
{
    public function getCollectionById($id){
        return WordCollection::find($id);
    }

    public function createCollection($data){
        return WordCollection::create($data);
    }

    public function getPublicCollections($searchQuery){
        return WordCollection::where('status', 'public')
            ->where('name', 'like', '%'.$searchQuery.'%')
            ->paginate(12);
    }

    public function getAllWordCollections($searchQuery)
    {
        return WordCollection::with('text')
            ->where('name', 'like', '%'.$searchQuery.'%')
            ->paginate(12);
    }

    public function getRequestsForPublish($searchQuery)
    {
        return WordCollection::where('status', 'pending')
            ->where('name', 'like', '%'.$searchQuery.'%')
            ->with('text')
            ->paginate(12);
    }

    public function changeCollection($id, $data)
    {
        $wordCollection = WordCollection::find($id);
        if (!$wordCollection) {
            return null;
        }
        $wordCollection->update($data);
        return $wordCollection;
    }

    public function updateCollection($id, $date){
        $wordCollection = WordCollection::find($id);
        if (!$wordCollection) {
            return null;
        }
        $wordCollection->update($date);
        return $wordCollection;
    }

}
