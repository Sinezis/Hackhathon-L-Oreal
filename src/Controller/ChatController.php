<?php

namespace App\Controller;

use App\Entity\Chat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chat', name: 'chat_')]
class ChatController extends AbstractController
{
    #[Route('/{id}', name: 'show')]
    public function index(Chat $chat): Response
    {
        return $this->render('chat/index.html.twig', [
            'chat' => $chat,
        ]);
    }
}
