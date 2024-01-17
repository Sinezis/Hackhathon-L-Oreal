<?php

namespace App\Form;

use App\Entity\Chat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChatFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => array_flip(Chat::GENDER)
            ])
            ->add('age')
            ->add('skinType', ChoiceType::class, [
                'choices' => array_flip(Chat::SKIN_TYPE)
            ])
            ->add('skinColor', ChoiceType::class, [
                'choices' => array_flip(Chat::SKIN_COLOR)
            ])
            ->add('hairType', ChoiceType::class, [
                'choices' => array_flip(Chat::HAIR_TYPE)
            ])
            ->add('hairTexture', ChoiceType::class, [
                'choices' => array_flip(Chat::HAIR_TEXTURE)
            ])
            ->add('hairColor', ChoiceType::class, [
                'choices' => array_flip(Chat::HAIR_COLOR)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chat::class,
        ]);
    }
}
