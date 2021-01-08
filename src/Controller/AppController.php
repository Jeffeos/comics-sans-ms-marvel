<?php

namespace App\Controller;

use App\Entity\Character;
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

        // Sample character creation
        $hulk = new Character([
            'id' => 0,
            'name' => 'Hulk',
            'picture' => 'https://e7.pngegg.com/pngimages/211/369/png-clipart-hulk-hulk-thumbnail.png'
        ]);
        $characters = [$hulk];

        return $this->render('index.html.twig', [
            'characters' => $characters]
        );
    }
}