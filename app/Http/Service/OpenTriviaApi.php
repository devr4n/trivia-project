<?php

namespace App\Http\Service;

class OpenTriviaApi
{
    private $client;
    private $host = 'https://opentdb.com/api.php';
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->host = config('services.opentdb.api_url');
    }

    public function get($amount, $difficulty, $type)
    {
        $response = $this->client->request('GET', $this->host, [
            'query' => [
                'amount' => $amount,
                'difficulty' => $difficulty,
                'type' => $type
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
