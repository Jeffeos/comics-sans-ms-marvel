<?php

namespace App\Controller;

use App\Entity\Character;
use App\Service\APIMarvelManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index() :Response
    {
        // Get Characters list from API for display
        $characters = $this->getCharactersFromMarvel(20, 100);

        return $this->render('index.html.twig', [
            'characters' => $characters
        ]);
    }

    /**
     * @Route("/character/{id}", name="app_character", methods={"GET"})
     */
    public function showCharacter($id) :Response
    {
        $character = $this->getCharactersFromMarvel(1, 0, $id);

        return $this->render('character.html.twig', [
            'character' => $character[0]
        ]);
    }

    public function getCharactersFromMarvel($limit = 100, $offset = 0, $id = '')
    {
        $APIMarvelManager = new APIMarvelManager();
        $charactersRawData = $APIMarvelManager->getCharacters($limit, $offset, $id);

        $characters = [];

        // Create an array of characters object
        foreach ($charactersRawData as $characterData)
        {
            // Create array of comic appearances
            $comicsAppearances = [];
            foreach ($characterData['comics']['items'] as $characterAppearances)
            {
                array_push($comicsAppearances, $characterAppearances['name']);
            }

            $characters[] = new Character([
                'id' => $characterData['id'],
                'name' => $characterData['name'],
                'picture' => $characterData['thumbnail']['path'], // https://developer.marvel.com/documentation/images
                'description' => $characterData['description'],
                'comicsAppearances' => $comicsAppearances
            ]);
        }

        return $characters;
    }
}