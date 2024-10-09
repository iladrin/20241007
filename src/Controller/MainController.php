<?php

namespace App\Controller;

use App\ContactHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage', methods: ['GET'])]
    public function homepage(Request $request): Response
    {
        dump(hello: $this);
        return $this->render('main/homepage.html.twig', []);
    }

    #[Route('/contact', name: 'app_contact', methods: ['GET'])]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig', []);
    }

    #[Route('/contact', name: 'app_contact_post', methods: ['POST'])]
    public function contactPost(Request $request, ContactHandler $handler): Response
    {
        $data = dump($request->request->all());
        $handler->handle($data);

        return $this->redirectToRoute('app_homepage');
    }
}
