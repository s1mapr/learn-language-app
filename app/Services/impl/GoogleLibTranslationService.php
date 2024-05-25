<?php

namespace App\Services\impl;

use App\Services\TranslationServiceI;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleLibTranslationService implements TranslationServiceI
{

    public function translate($value)
    {
        $tr = new GoogleTranslate();
        $tr->setSource('en')->setTarget('uk');
        return $tr->translate($value);
    }
}
