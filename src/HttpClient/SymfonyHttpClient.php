<?php

namespace App\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SymfonyHttpClient
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function get(string $url, array $options)
    {
        return $this->client->request('GET', $url, $options);
    }
}
