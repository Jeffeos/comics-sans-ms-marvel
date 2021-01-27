<?php

namespace App\Tests;

use App\Service\CharacterFactory;
use PHPUnit\Framework\TestCase;

class CharacterFactoryTest extends TestCase
{
    private CharacterFactory $characterFactory;
    private $characterJson;
    private $character;

    /**
     * @before
     */
    public function setUpTest()
    {
        $this->characterFactory = new CharacterFactory();
        $this->characterJson = $this->getJson('mock-character-hulk.json');
        $this->character = $this->characterFactory->create($this->characterJson['data']['results'][0]);
    }

    public function testHydration()
    {
        $this->assertEquals(
            '1009351',
            $this->character->getId()
        );
        $this->assertEquals(
            'Hulk',
            $this->character->getName()
        );
        $this->assertEquals(
            'http://i.annihil.us/u/prod/marvel/i/mg/5/a0/538615ca33ab0',
            $this->character->getPicture()
        );
        $this->assertEquals(
            'Caught in a gamma bomb explosion while trying to save the life of a teenager, Dr. Bruce Banner was transformed into the incredibly powerful creature called the Hulk. An all too often misunderstood hero, the angrier the Hulk gets, the stronger the Hulk gets.',
            $this->character->getDescription()
        );
    }

    public function testHydrationComics()
    {
        $comicsAppearances = $this->character->getComicsAppearances();
        $this->assertIsArray($comicsAppearances);
        $this->assertEquals(20, count($comicsAppearances));
        $this->assertEquals(
            '5 Ronin (Hardcover)',
            $comicsAppearances[0]->getName()
        );
        $this->assertEquals(
            '5 Ronin (2010) #2',
            $comicsAppearances[1]->getName()
        );
    }

    private function getJson(string $mockFileName)
    {
        $filePath = __DIR__.'/../Mock/'.$mockFileName;

        $json = file_get_contents($filePath);
        if ($json) {
            return json_decode($json, true);
        } else {
            return json_decode('', true);
        }
    }
}
