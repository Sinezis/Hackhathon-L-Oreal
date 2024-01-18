<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Form\ChatFormType;
use App\Service\OpenaiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/openai', name: 'openai_')]
class OpenAiController extends AbstractController
{
    CONST MA_RECHERCHE = [
        0 => 'Comment appliquer de la crème de jour/nuit?',
        1 => 'Comment choisir la bonne teinte de fond de teint?',
        2 => 'Routine de soin de la peau pour une peau éclatante.',
        3 => 'Comment teindre vos cheveux à la maison?',
        4 => 'Création d\'un regard smoky eye.'
    ];

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
            $chat = $openAIService->onNewChat($chat);

            $entityManager->flush();

            return $this->redirectToRoute('chat_show', [
                'id' => $chat->getId()
            ]);
        } 
        // TODO: Création de l'entité message
        // TODO: envoie de la requête à chatgpt
        // TODO: récupération de la réponse

        return $this->render('public_chat/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/tutorial', name: 'tutorial')]
    public function tutorial(
        Request $request,
        EntityManagerInterface $entityManager,
        OpenaiService $openAIService
    ): Response 
    {
        //Récupération du formulaire
        $form = $this->createFormBuilder()
            ->add('Recherche', ChoiceType::class, [
                'choices' => array_flip(self::MA_RECHERCHE)
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $tutorial = $openAIService->onNewTutorial(self::MA_RECHERCHE[$data["Recherche"]]);
            return $this->render('public_tutorial/show.html.twig', [
                'message' => $tutorial
            ]);
        }

        return $this->render('public_tutorial/index.html.twig', [
            'form' => $form,
        ]);
    }
}