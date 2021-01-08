<?php


namespace App\Service;


use DateTime;
use Symfony\Component\HttpClient\HttpClient;

class APIMarvelManager
{
    // Used to call the Marvel API and retrieve the data we need
    protected $client;
    protected $baseUrl;
    protected $apiPublicKey;
    protected $apiPrivateKey;

    public function __construct()
    {
        $this->client = HttpClient::create();
        $this->baseUrl = $_ENV['MARVEL_REQUEST_URL'];
        $this->apiPublicKey = $_ENV['MARVEL_API_PUBLIC_KEY'];
        $this->apiPrivateKey = $_ENV['MARVEL_API_PRIVATE_KEY'];
    }

    public function getCharacters(int $limit = 100, int $offset = 0)
    {
        $date = new DateTime();
        $ts = $date->getTimestamp();

        $fullApiKey = '&ts=' . $ts . '&apikey=' . $this->apiPublicKey . '&hash=' . md5($ts . $this->apiPrivateKey . $this->apiPublicKey);

        // Send the request to the API
        $response = $this->client->request(
            'GET',
            $this->baseUrl . 'characters?limit=' . $limit . '&offset=' . $offset . $fullApiKey
        );

        return $response->toArray()['data']['results'];
    }
}