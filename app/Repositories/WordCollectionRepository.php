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

    public function getPublicCollections(){
        return WordCollection::where('status', 'public')->get();
    }

    public function getAllWordCollections()
    {
        return WordCollection::with('text')->get();
    }

    public function getRequestsForPublish()
    {
        return WordCollection::where('status', 'pending')->with('text')->get();
    }

    public function changeCollectionStatus($id, $status)
    {
        $wordCollection = WordCollection::find($id);
        if (!$wordCollection) {
            return null;
        }
        $wordCollection['status'] = $status;
        $wordCollection->update($wordCollection->toArray());

        return $wordCollection;
    }


}
