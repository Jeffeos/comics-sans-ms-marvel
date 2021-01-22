<?php

namespace App\Controller;

use App\DTO\Character;
use App\DTO\Comics;
use App\Service\APIMarvelManager;
use App\Service\CharacterFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharacterController extends AbstractController
{
    private APIMarvelManager $APIMarvelManager;
    private CharacterFactory $characterFactory;

    public function __construct(APIMarvelManager $APIMarvelManager, CharacterFactory $characterFactory)
    {
        $this->APIMarvelManager = $APIMarvelManager;
        $this->characterFactory = $characterFactory;

    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Character[]
     */
    public function getMarvelCharacters(int $limit = 100, int $offset = 0): array
    {
        $charactersRawData = $this->APIMarvelManager->getCharacters($limit, $offset);

        $characters = [];

        foreach ($charactersRawData as $characterData) {
            $characters[] = $this->characterFactory->create($characterData);
        }

        return $characters;
    }

    public function getMarvelCharacterById(int $id): Character
    {
        $characterRawData = $this->APIMarvelManager->getCharacterById($id);

        return $this->characterFactory->create($characterRawData);
    }
}
