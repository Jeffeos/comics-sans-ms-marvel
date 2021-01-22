<?php

namespace App\Service;

use DateTime;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIMarvelManager
{
    private HttpClientInterface $client;
    private string $baseUrl;
    private string $apiPublicKey;
    private string $apiPrivateKey;

    public function __construct()
    {
        $this->client = HttpClient::create();
        $this->baseUrl = $_ENV['MARVEL_REQUEST_URL'];
        $this->apiPublicKey = $_ENV['MARVEL_API_PUBLIC_KEY'];
        $this->apiPrivateKey = $_ENV['MARVEL_API_PRIVATE_KEY'];
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCharacters(int $limit = 100, int $offset = 0): array
    {
        $fullApiKey = $this->constructFullApiKey();

        // Send the request to the API
        $response = $this->client->request(
            'GET',
            $this->baseUrl.'characters?limit='.$limit.'&offset='.$offset.$fullApiKey
        );

        return $response->toArray()['data']['results'];
    }

    public function getCharacterById(int $id): array
    {
        $fullApiKey = $this->constructFullApiKey();

        // Send the request to the API
        $response = $this->client->request(
            'GET',
            $this->baseUrl.'characters/'.$id.'?'.$fullApiKey
        );

        return $response->toArray()['data']['results'][0];
    }

    public function constructFullApiKey()
    {
        $date = new DateTime();
        $ts = $date->getTimestamp();

        return '&ts='.$ts.'&apikey='.$this->apiPublicKey.'&hash='.md5($ts.$this->apiPrivateKey.$this->apiPublicKey);
    }
}
