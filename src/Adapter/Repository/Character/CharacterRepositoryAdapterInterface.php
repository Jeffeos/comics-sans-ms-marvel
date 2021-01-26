<?php

namespace App\Adapter\Repository\Character;

use App\DTO\Character;
use App\HttpClient\SymfonyHttpClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

interface CharacterRepositoryAdapterInterface
{
    public function __construct(SymfonyHttpClient $client, ParameterBagInterface $params);

    /**
     * @return array<int, Character>
     */
    public function getCharacters(int $limit = 100, int $offset = 0, int $id = null): array;
}
