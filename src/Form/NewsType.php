<?php

namespace App\Form;

use App\Entity\News;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Título',
                'required' => true,
                'attr' => [
                    'class' => 'mb-3'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenido',
                'required' => true,
                'attr' => [
                    'class' => 'mb-3'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Imagen',
                'required' => false,
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
