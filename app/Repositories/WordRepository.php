<?php

namespace App\Repositories;

use App\Models\Word;

class WordRepository
{
    public function saveWord($word)
    {
        return Word::firstOrCreate($word);
    }

    public function getAllWords($searchQuery)
    {
        return Word::where('word', 'like', '%' . $searchQuery . '%')
            ->paginate(12);
    }

    public function updateWord($id, $data)
    {
        $word = Word::find($id);
        $word->update($data);
        return $word;
    }

    public function getWordById($id)
    {
        return Word::find($id);
    }
}
