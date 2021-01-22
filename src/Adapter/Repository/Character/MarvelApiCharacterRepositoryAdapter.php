<?php


namespace App\Adapter\Repository\Character;


use DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MarvelApiCharacterRepositoryAdapter implements CharacterRepositoryAdapterInterface
{
    private HttpClientInterface  $client;
    private string $baseUrl;
    private string $apiPublicKey;
    private string $apiPrivateKey;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;

        $this->baseUrl = $_ENV['MARVEL_REQUEST_URL'];
        $this->apiPublicKey = $_ENV['MARVEL_API_PUBLIC_KEY'];
        $this->apiPrivateKey = $_ENV['MARVEL_API_PRIVATE_KEY'];
    }

    public function getCharacters(int $limit = 1, int $offset = 0, int $id = null): array
    {
        $fullApiKey = $this->constructFullApiKey();
        $url = $this->baseUrl . 'characters?' . $fullApiKey;

        $options = ['query' => [
            'limit' => $limit,
            'offset' => $offset,
            'id' => $id
        ]];

        $response = $this->client->request('GET', $url, $options);

        return $response->toArray()['data']['results'];
    }

    public function constructFullApiKey()
    {
        $date = new DateTime();
        $ts = $date->getTimestamp();

        return '&ts='.$ts.'&apikey='.$this->apiPublicKey.'&hash='.md5($ts.$this->apiPrivateKey.$this->apiPublicKey);
    }
}