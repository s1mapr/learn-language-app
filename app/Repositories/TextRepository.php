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

    public function getTextById($id){
        return Text::find($id);
    }

    public function updateText($id, $data)
    {
        $text = $this->getTextById($id);
        $text->fill($data);
        $text->save();
    }
}
