<?php

namespace App\Service;

use GuzzleHttp\Client;

class OpenTriviaApi {
    private $client;
    private $url = 'https://opentdb.com/api.php?';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($amount, $difficulty, $type)
    {
        $response = $this->client->request('GET', $this->url, [
            'query' => [
                'amount' => $amount,
                'difficulty' => $difficulty,
                'type' => $type,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
