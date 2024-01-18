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

    // Moved method to DashboardController
    /*#[Route('/seoModule', name: 'app_seo')]
    public function seoForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $picture = new Picture();

        $form = $this->createForm(ImageUploadType::class, $picture);
        $form->handleRequest($request);

        
        if ($form->isSubmitted()) {
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('app_imageName', ['id' => $picture->getId()]);
        }

        return $this->render('seo/index.html.twig', ['form' => $form]);
    }*/

    // Moved method to DashboardController
    /*#[Route('/seoModule/imageName/{id}', name:'app_imageName')]
    public function generateName(Picture $picture): Response
    {
        $product = $picture->getProduct();
    
        $productName = str_replace(' ', '-', $product->getProductName());
        $productCategory = str_replace(' ', '-', $product->getProductCategory());
        $productBrand = str_replace(' ', '-', $product->getBrand());
        $pictureExtension = $picture->getExtension();
        $generatedName = strtolower($productName . '-' . $productCategory . '-' . $productBrand . $pictureExtension);

        $picture->setName($generatedName);

        return $this->render('seo/generate_name.html.twig', ['generatedName' => $generatedName, 'picture' => $picture]);
    }*/
}