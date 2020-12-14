<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Form\RecetteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette_index")
     */
    public function index(): Response
    {
        return $this->render('recette/index.html.twig', [

        ]);
    }

    /**
     * @Route("/add-recette", name="recette_add")
     */
    public function addRecette(Request $request): Response
    {
        $recette = new Recettes();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
        }

        return $this->render('recette/recette-form.html.twig', [
            "form_title" => "Ajouter une recette",
            "form_recette" => $form->createView(),
        ]);
    }

    /**
     * @Route("/list-recette", name="recette_list")
     */
    public function recetteList()
    {
        $recettes = $this->getDoctrine()->getRepository(Recettes::class)->findAll();

        return $this->render('recette/recette-list.html.twig', [
            "recettes" => $recettes,
        ]);
    }


    /**
     * @Route("/modify-recette/{id}", name="recette_modify")
     */
    public function modifyRecette(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $recette = $em->getRepository(Recettes::class)->find($id);
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();

            return $this->redirectToRoute ('recette_list');
        }

        return $this->render('recette/recette-form.html.twig', [
            "form_title" => "Modifier la recette",
            "form_recette" => $form->createView(),
        ]);
    }


    /**
     * @Route("/delete-recette/{id}", name="recette_delete")
     */
    public function deleteRecette(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $recette = $em->getRepository(Recettes::class)->find($id);
        $em->remove($recette);
        $em->flush();

        return $this->redirectToRoute ('recette_list');

    }
}