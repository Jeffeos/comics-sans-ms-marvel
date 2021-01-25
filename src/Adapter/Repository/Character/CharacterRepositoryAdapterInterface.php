<?php

namespace App\Adapter\Repository\Character;

use App\DTO\Character;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

interface CharacterRepositoryAdapterInterface
{
    public function __construct(HttpClientInterface $client, ParameterBagInterface $params);

    /**
     * @return array<int, Character>
     */
    public function getCharacters(int $limit = 100, int $offset = 0, int $id = null): array;
}
