<?php

namespace App\Adapter\Repository\Character;

use App\HttpClient\SymfonyHttpClient;
use DateTime;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MarvelApiCharacterRepositoryAdapter implements CharacterRepositoryAdapterInterface
{
    private SymfonyHttpClient $client;
    private string $baseUrl;
    private string $apiPublicKey;
    private string $apiPrivateKey;

    public function __construct(SymfonyHttpClient $client, ParameterBagInterface $params)
    {
        $this->client = $client;
        $this->baseUrl = $params->get('marvel_url');
        $this->apiPublicKey = $params->get('marvel_public_key');
        $this->apiPrivateKey = $params->get('marvel_private_key');
    }

    public function getCharacters(int $limit = 1, int $offset = 0, int $id = null): array
    {
        $fullApiKey = $this->constructFullApiKey();
        $url = $this->baseUrl.'characters?'.$fullApiKey;

        $options = ['query' => [
            'limit' => $limit,
            'offset' => $offset,
            'id' => $id,
        ]];

        $response = $this->client->get($url, $options);

        return $response->toArray()['data']['results'];
    }

    public function constructFullApiKey(): string
    {
        $date = new DateTime();
        $ts = $date->getTimestamp();

        return '&ts='.$ts.'&apikey='.$this->apiPublicKey.'&hash='.md5($ts.$this->apiPrivateKey.$this->apiPublicKey);
    }
}
