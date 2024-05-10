<?php

namespace App\Services;

use GuzzleHttp\Client;

class PexelsService
{
    public function getPhoto($query)
    {
        $client = new Client();
        $response = $client->get(
            'https://api.pexels.com/v1/search?query='. $query,
            [
                'headers' => [
                    'Authorization' => 'yE2FB6GoTweWTRDOW6p0hvXKE1tZjgMyt2tEDkSdX7NyOhMdopbWTXAl',
                ],
            ]
        );
        $jsonData = $response->getBody()->getContents();
        $data = json_decode($jsonData, true);
        return $data['photos'][0]['src']['medium'];
    }
}
