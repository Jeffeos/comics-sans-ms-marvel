<?php

namespace App\Adapter\Repository\Character;

use App\DTO\Character;
use App\HttpClient\SymfonyHttpClient;
use App\Service\CharacterFactory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

interface CharacterRepositoryAdapterInterface
{
    public function __construct(SymfonyHttpClient $client, CharacterFactory $characterFactory, ParameterBagInterface $params);

    /**
     * @param int $limit
     * @param int $offset
     * @param int|null $id
     * @return array<int, Character>
     */
    public function getCharactersFromApi(int $limit = 100, int $offset = 0, int $id = null): array;
}
