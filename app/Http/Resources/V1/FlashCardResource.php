<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlashCardResource extends JsonResource
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
            'word'=>$this->word,
            'translationUk'=>$this->translation_uk,
            'pictureUrl'=>'https://storage.googleapis.com/pod_public/1300/165117.jpg'
        ];
    }
}
