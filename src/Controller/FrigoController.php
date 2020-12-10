<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrigoController extends AbstractController
{
    /**
     * @Route("/", name="frigo_index")
     */
    public function index(): Response
    {
        return $this->render('frigo/index.html.twig', [

        ]);
    }
}