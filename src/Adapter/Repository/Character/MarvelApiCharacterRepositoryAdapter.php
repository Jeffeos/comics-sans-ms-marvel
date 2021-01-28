<?php

namespace App\Adapter\Repository\Character;

use App\DTO\Character;
use App\HttpClient\SymfonyHttpClient;
use App\Service\CharacterFactory;
use DateTime;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MarvelApiCharacterRepositoryAdapter implements CharacterRepositoryAdapterInterface
{
    private SymfonyHttpClient $client;
    private CharacterFactory $characterFactory;
    private string $baseUrl;
    private string $apiPublicKey;
    private string $apiPrivateKey;

    public function __construct(SymfonyHttpClient $client, CharacterFactory $characterFactory, ParameterBagInterface $params)
    {
        $this->client = $client;
        $this->characterFactory = $characterFactory;
        $this->baseUrl = $params->get('marvel_url');
        $this->apiPublicKey = $params->get('marvel_public_key');
        $this->apiPrivateKey = $params->get('marvel_private_key');
    }

    /**
     * @return Character[]
     */
    public function getMarvelCharacters(int $limit = 1, int $offset = 0, int $id = null): array
    {
        $charactersRawData = $this->getCharactersFromApi($limit, $offset, $id);

        return $this->getCharacterFromRawData($charactersRawData);
    }

    /**
     * @return Character[]
     */
    public function getCharacterFromRawData(array $charactersRawData): array
    {
        $characters = [];

        foreach ($charactersRawData as $characterData) {
            $characters[] = $this->characterFactory->create($characterData);
        }

        return $characters;
    }

    public function getCharactersFromApi(int $limit = 1, int $offset = 0, int $id = null): array
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
