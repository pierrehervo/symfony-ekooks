<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    /**
     * @Route("/", name="recette_index")
     */
    public function index(): Response
    {
        return $this->render('recette/index.html.twig', [

        ]);
    }
}