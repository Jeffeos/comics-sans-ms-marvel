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
        $characters = [];
        // Get Characters list from API for display
        $charactersRawData = $this->getCharactersFromMarvel();

        foreach ($charactersRawData as $characterData)
        {
            $characters[$characterData['name']] = new Character([
                'id' => $characterData['id'],
                'name' => $characterData['name'],
                'picture' => $characterData['thumbnail']['path'] . '/portrait_uncanny.jpg'
            ]);
        }

        return $this->render('index.html.twig', [
            'characters' => $characters]
        );
    }

    public function getCharactersFromMarvel()
    {
        $APIMarvelManager = new APIMarvelManager();

        return $APIMarvelManager->getCharacters(20, 100);
    }
}