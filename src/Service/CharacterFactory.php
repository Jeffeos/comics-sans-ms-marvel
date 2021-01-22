<?php

namespace App\Service;

use App\DTO\Character;
use App\DTO\Comics;

class CharacterFactory
{
    private const ID_KEY = 'id';
    private const NAME_KEY = 'name';
    private const PICTURE_KEY = 'thumbnail';
    private const DESCRIPTION_KEY = 'description';
    private const COMICS_KEY = 'comics';

    /**
     * @param array $data
     * @return Character
     */
    public function create(array $data = []): Character
    {
        return $this->hydrateCharacter($data);
    }

    /**
     * @param array $data
     * @return Character
     */
    private function hydrateCharacter(array $data): Character
    {
        $character = new Character();
        $this->setId($character, $data);
        $this->setName($character, $data);
        $this->setPicture($character, $data);
        $this->setDescription($character, $data);
        $this->setComicsAppearances($character, $data);

        return $character;
    }

    /**
     * @param Character $character
     * @param array $data
     */
    private function setId(Character $character, array $data): void
    {
        if (empty($data[self::ID_KEY])) {
            return;
        }

        $character->setId($data[self::ID_KEY]);
    }

    /**
     * @param Character $character
     * @param array $data
     */
    private function setName(Character $character, array $data): void
    {
        if (empty($data[self::NAME_KEY])) {
            return;
        }

        $character->setName($data[self::NAME_KEY]);
    }

    /**
     * @param Character $character
     * @param array $data
     */
    private function setPicture(Character $character, array $data): void
    {
        if (empty($data[self::PICTURE_KEY]['path'])) {
            return;
        }

        $character->setPicture($data[self::PICTURE_KEY]['path']);
    }

    /**
     * @param Character $character
     * @param array $data
     */
    private function setDescription(Character $character, array $data): void
    {
        if (empty($data[self::DESCRIPTION_KEY])) {
            return;
        }

        $character->setDescription($data[self::DESCRIPTION_KEY]);
    }

    /**
     * @param Character $character
     * @param array<string> $data
     */
    private function setComicsAppearances(Character $character, array $data): void
    {
        if (isset($data[self::COMICS_KEY]['items'])) {
            foreach ($data[self::COMICS_KEY]['items'] as $comic) {
                $newComic = new Comics();
                $newComic->setName($comic['name']);
                $character->addComicsAppearances($newComic);
            }
        }
    }
}
