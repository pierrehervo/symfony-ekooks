<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/authentification", name="authentification_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()){
            return $this->redirectToRoute('user_index');
        }

        //erreur d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();

        $username = $authenticationUtils->getLastUsername();

        return $this->render('authentification/login.html.twig', [
            'error' => $error,
            'nom' => $username
        ]);
    }

    /**
     * @Route("/logout", name="authentication_logout")
     */
    public function logout(): Response
    {
        throw new \LogicException('Vous ne devriez pas être ici!');
    }
}

