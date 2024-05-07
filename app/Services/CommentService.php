<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment($commentData)
    {
        return $this->commentRepository->createComment($commentData);
    }

    public function getCollectionComments($commentId){
        return $this->commentRepository->getCollectionComments($commentId);
    }


}
