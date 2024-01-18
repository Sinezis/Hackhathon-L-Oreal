<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ImageUploadType;
use App\Entity\Picture;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/seoModule', name: 'app_seo')]
    public function seoForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $picture = new Picture();

        $form = $this->createForm(ImageUploadType::class, $picture);
        $form->handleRequest($request);

        //dd($form);
        if ($form->isSubmitted()) {
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('seo/index.html.twig', ['form' => $form]);
    }
}