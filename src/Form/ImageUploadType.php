<?php

namespace App\Form;

use App\Entity\Picture;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ImageUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'productName',
                'label' => false,
            ])
            ->add('productFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true,
                'label' => false,
            ])
            ->add('metaDescription', TextareaType::class, [
                'label' => false
            ])
            ->add('height', IntegerType::class, [
                'label' => false
            ])
            ->add('width', IntegerType::class, [
                'label' => false
            ])
            ->add('extension', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    '.jpg' => '.jpg',
                    '.png' => '.png',
                    '.svg' => '.svg',
                    '.webp' => '.webp',
                ]
            ]);
    }
}
