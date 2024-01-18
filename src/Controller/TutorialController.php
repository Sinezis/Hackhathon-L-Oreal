<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tutorial', name: 'tutorial_')]
class TutorialController extends AbstractController
{
    #[Route('/show', name: 'show')]
    public function index(

    ): Response
    {
        dd($_POST);
        return $this->render('tutorial/index.html.twig', [
            'controller_name' => 'TutorialController',
        ]);
    }
}
