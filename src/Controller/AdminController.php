<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
    * @Route("/list-users", name="user_list")
    */
    public function usersList(UserRepository $users)
    {
       
        return $this->render('admin/index.html.twig', [
            'users' => $users->findAll(),
        ]);
    }


    /**
     * @Route("/add-user", name="user_add")
     */
    public function addUser(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute ('user_list');
        }

        return $this->render('user/user-form.html.twig', [
            "form_title" => "S'inscrire",
            "form_user" => $form->createView(),
        ]);
    }


    /**
    * @Route("/modify-users/{id}", name="users_modify")
    */
    public function modifyUser(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();

            return $this->redirectToRoute ('user_list');
        }

        return $this->render('user/user-form.html.twig', [
            "form_title" => "Modifier l'utilisateur",
            "form_user" => $form->createView(),
        ]);
    }

    /**
    * @Route("/user/{id}", name="user_detail")
    */
    public function userDetail($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->find($id);
        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }
}
