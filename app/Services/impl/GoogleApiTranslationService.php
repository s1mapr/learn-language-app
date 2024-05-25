<?php

namespace App\Services\impl;

use App\Services\TranslationServiceI;
use Google\Cloud\Translate\V2\TranslateClient;

class GoogleApiTranslationService implements TranslationServiceI
{

    public function translate($value)
    {
        $translate = new TranslateClient([
            'key' => env('GOOGLE_API_KEY'),
        ]);
        $translatedWord = $translate->translate($value, [
            'target' => 'uk'
        ]);
        return $translatedWord['text'];
    }
}
