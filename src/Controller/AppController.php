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
        $characters = $this->getCharactersFromMarvel();

        return $this->render('index.html.twig', [
            'characters' => $characters]
        );
    }

    public function getCharactersFromMarvel()
    {
        $APIMarvelManager = new APIMarvelManager();
        $charactersRawData = $APIMarvelManager->getCharacters(20, 100);

        $characters = [];

        // Create an array of characters object
        foreach ($charactersRawData as $characterData)
        {
            $characters[$characterData['name']] = new Character([
                'id' => $characterData['id'],
                'name' => $characterData['name'],
                'picture' => $characterData['thumbnail']['path'] . '/portrait_xlarge.jpg'
            ]);
        }

        return $characters;
    }
}