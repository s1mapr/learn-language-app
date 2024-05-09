<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'status'=>$this->status,
            'textId'=>$this->text_id,
            'posterUrl'=>$this->poster_url,
            'bannerUrl'=>$this->banner_url,
            'likes'=>$this->likes,
            'views'=>$this->views,
            'wordsCount'=>$this->wordsCount,
            'wordsLearned'=>$this->wordsLearned,
            'isStarted' => $this->isStarted,
            'comments'=>CommentResource::collection($this->comments)
        ];
    }
}
