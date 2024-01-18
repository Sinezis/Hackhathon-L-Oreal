<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    private const PRODUCT = [
        ['productName' =>'Heavy Indeed', 'brand' => 'Shu Uemura', 'productCategory' => 'Hair Care'],
        ['productName' =>'Nothing Method', 'brand' => 'Loreal Pro', 'productCategory' => 'Mask'],
        ['productName' =>'Your Focus', 'brand' => 'Shu Uemura', 'productCategory' => 'Hygiene'],
        ['productName' =>'Source Born', 'brand' => 'Kerastase', 'productCategory' => 'Hair Color'],
        ['productName' =>'Central Defense', 'brand' => 'Loreal Pro', 'productCategory' => 'Hygiene'],
        ['productName' =>'Close When', 'brand' => 'Loreal Pro', 'productCategory' => 'Hygiene'],
        ['productName' =>'Not Piece', 'brand' => 'Kerastase', 'productCategory' => 'Hair Care'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCT as $productData) {
            $product = new Product();
            $product->setProductName($productData['productName']);
            $product->setBrand($productData['brand']);
            $product->setProductCategory($productData['productCategory']);
            $manager->persist($product);
        }
        $manager->flush();
    }
}
