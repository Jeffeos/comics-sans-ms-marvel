<?php

namespace App\Adapter\Repository\Character;

use App\DTO\Character;
use App\Service\CharacterFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharacterRepository extends AbstractController
{
    private MarvelApiCharacterRepositoryAdapter $marvelApiCharacter;
    private CharacterFactory $characterFactory;

    public function __construct(MarvelApiCharacterRepositoryAdapter $marvelApiCharacter, CharacterFactory $characterFactory)
    {
        $this->marvelApiCharacter = $marvelApiCharacter;
        $this->characterFactory = $characterFactory;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param int|null $id
     * @return Character[]
     */
    public function getMarvelCharacters(int $limit = 1, int $offset = 0, int $id = null): array
    {
        $charactersRawData = $this->marvelApiCharacter->getCharacters($limit, $offset, $id);

        return $this->getCharacterFromRawData($charactersRawData);
    }

    /**
     * @param array $charactersRawData
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
}
