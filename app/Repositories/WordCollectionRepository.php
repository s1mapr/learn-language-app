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
        return WordCollection::where('status', 'public')->paginate(10);
    }

    public function getAllWordCollections()
    {
        return WordCollection::with('text')->paginate(10);
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

    public function updateCollection($id, $date){
        $wordCollection = WordCollection::find($id);
        if (!$wordCollection) {
            return null;
        }
        $wordCollection->update($date);
        return $wordCollection;
    }


}
