<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function createComment($data){
        return Comment::create($data);
    }

    public function getCollectionComments($collectionId){
        return Comment::where('word_collection_id', $collectionId)->with('user')->get();
    }
}
