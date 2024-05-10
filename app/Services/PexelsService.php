<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PexelsService
{
    public function getPhoto($query)
    {
<<<<<<< HEAD

=======
        return Http::withHeaders([
            'Authorization' => 'yE2FB6GoTweWTRDOW6p0hvXKE1tZjgMyt2tEDkSdX7NyOhMdopbWTXAl',
        ])->async()->get('https://api.pexels.com/v1/search?query='. $query);
>>>>>>> 627477768472dfdba6fa5194185b3aa59d3bfd67
    }
}
