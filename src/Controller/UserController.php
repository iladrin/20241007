<?php

namespace App\Controller;

use App\Form\UserCreationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user/create', name: 'app_user_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserCreationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();

//            return $this->redirectToRoute()
        }

        return $this->render('user/create.html.twig', [
            'creation_form' => $form->createView(),
        ]);
    }

    #[Route('/user/{userId<\d+>}', name: 'app_user_show', methods: ['GET'])]
    public function show(int $userId): Response
    {
        dump($userId);

        return $this->render('user/create.html.twig', []);
    }
}