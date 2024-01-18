<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Form\ChatFormType;
use App\Service\OpenaiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/openai', name: 'openai_')]
class OpenAiController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('open_ai/index.html.twig', [
            'controller_name' => 'OpenAiController',
        ]);
    }

    #[Route('/message', name: 'message')]
    public function message(
        Request $request,
        EntityManagerInterface $entityManager,
        OpenaiService $openAIService
    ): Response 
    {
        //Récupération du formulaire
        $chat = new Chat();
        $form = $this->createForm(ChatFormType::class, $chat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chat);
            $openAIService->onNewChat($chat);

            $entityManager->flush();
        } else if ($form->isSubmitted()) {
            dd($form->getErrors(true));
        }

        // TODO: Création de l'entité message
        // TODO: envoie de la requête à chatgpt
        // TODO: récupération de la réponse

        return $this->render('public_chat/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/tutorial', name: 'tutorial')]
    public function tutorial(): Response 
    {
        return $this->render('open_ai/index.html.twig', [
            'controller_name' => 'OpenAiController',
        ]);
    }
}
