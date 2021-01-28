<?php

namespace App\Controller;

use App\Adapter\Repository\Character\CharacterRepositoryAdapterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    private CharacterRepositoryAdapterInterface $characterRepository;

    public function __construct(CharacterRepositoryAdapterInterface $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * @Route("/characters/{number}", name="character_index", methods={"GET"})
     * @param int $number
     * @return Response
     */
    public function index(int $number): Response
    {
        return $this->render('character/index.html.twig', [
            'characters' => $this->characterRepository->getMarvelCharacters($number, 100),
        ]);
    }

    /**
     * @Route("/character/{id}", name="character_show", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function showCharacter(int $id): Response
    {
        $characterArray = $this->characterRepository->getMarvelCharacters(1, 0, $id);

        return $this->render('character/character.html.twig', [
            'character' => reset($characterArray),
        ]);
    }
}
