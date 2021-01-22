<?php


namespace App\Adapter\Repository\Character;


use App\DTO\Character;
use Symfony\Contracts\HttpClient\HttpClientInterface;

interface CharacterRepositoryAdapterInterface
{
    public function __construct(HttpClientInterface $client);

    /**
     * @param int $limit
     * @param int $offset
     * @param int|null $id
     * @return array<int, Character>
     */
    public function getCharacters(int $limit = 100, int $offset = 0, int $id = null): array;
}