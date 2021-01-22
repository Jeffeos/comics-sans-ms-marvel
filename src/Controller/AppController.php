<?php

namespace App\Controller;

use App\DTO\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    private CharacterController $characterController;

    public function __construct(CharacterController $characterController)
    {
        $this->characterController = $characterController;
    }

    /**
     * @Route("/", name="app_index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'characters' => $this->characterController->getMarvelCharacters(20, 100),
        ]);
    }

    /**
     * @Route("/character/{id}", name="app_character", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function showCharacter(int $id): Response
    {
        return $this->render('character.html.twig', [
            'character' => $this->characterController->getMarvelCharacterById($id),
        ]);
    }
}
