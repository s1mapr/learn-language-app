<?php

namespace App\Repositories;

use App\Models\Word;

class WordRepository
{
    public function saveWord($word)
    {
        return Word::firstOrCreate($word);
    }

    public function getAllWords()
    {
        return Word::paginate(10);
    }
}
