<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ImageUploadType;
use App\Entity\Picture;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(): Response
    {
        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        return $this->render('dashboard/home.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/images', name: 'images')]
    public function images(Request $request, EntityManagerInterface $entityManager): Response
    {
        /*return $this->render('dashboard/images.html.twig', [
            'controller_name' => 'DashboardController',
        ]);*/

        $picture = new Picture();

        $form = $this->createForm(ImageUploadType::class, $picture);
        $form->handleRequest($request);

        
        if ($form->isSubmitted()) {
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('app_imageName', ['id' => $picture->getId()]);
        }

        return $this->render('dashboard/images.html.twig', ['form' => $form]);
    }

    #[Route('/analytics', name: 'analytics')]
    public function analytics(): Response
    {
        return $this->render('dashboard/analytics.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
