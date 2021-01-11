<?php


namespace App\Tests;


use App\Entity\Character;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    protected $character;

    public function setUp() :void
    {
        $this->character = new Character([
            'id' => 1009351,
            'name' => 'Hulk',
            'picture' => 'http://i.annihil.us/u/prod/marvel/i/mg/5/a0/538615ca33ab0',
            'description' => 'Caught in a gamma bomb explosion...',
            'comicsAppearances' => ['5 Ronin (Hardcover)', 'A+X (2012) #1', 'Absolute Carnage: Immortal Hulk (2019) #1']
        ]);
    }

    public function testThatWeCanGetCharacterInformation()
    {
        $this->assertEquals($this->character->getId(), 1009351);
        $this->assertEquals($this->character->getName(), 'Hulk');
        $this->assertEquals($this->character->getPicture(), 'http://i.annihil.us/u/prod/marvel/i/mg/5/a0/538615ca33ab0');
        $this->assertEquals($this->character->getDescription(), 'Caught in a gamma bomb explosion...');
        $this->assertEquals($this->character->getComicsAppearances(), ['5 Ronin (Hardcover)', 'A+X (2012) #1', 'Absolute Carnage: Immortal Hulk (2019) #1']);
    }
}