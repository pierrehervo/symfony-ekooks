<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Repository\RecettesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil_index")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Recettes::class);

        $recettes = $repository->findAll();
        $path = null;
        
        return $this->render('accueil/index.html.twig', [
            'recettes' => $recettes,
            'path' => $path
        ]);
    }
}
