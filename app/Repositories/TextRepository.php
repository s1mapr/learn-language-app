<?php

namespace App\Repositories;

use App\Models\Text;

class TextRepository
{
    public function saveText($text)
    {
        $newText = new Text();
        $newText->fill($text);
        $newText->save();
        return $newText;
    }
}
