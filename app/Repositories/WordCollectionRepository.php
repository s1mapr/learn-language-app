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
}
