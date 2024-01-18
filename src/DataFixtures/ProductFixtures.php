<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    private const PRODUCT = [];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCT as $productData) {
            $product = new Product();
            $product->setProductName($productData);
            $product->setBrand($productData);
            $product->setProductCategory($productData);
            $manager->persist($product);
        }
        $manager->flush();
    }
}
