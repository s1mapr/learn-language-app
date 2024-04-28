<?php

namespace App\Repositories;

use App\Models\Word;

class WordRepository
{
    public function saveWord($word){
        $newWord = new Word();
        $newWord->fill($word);
        $newWord->save();
        return $newWord;
    }
}
