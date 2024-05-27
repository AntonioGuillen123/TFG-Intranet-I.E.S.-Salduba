<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\Session;
use App\Entity\UploadFileMessage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_to', EntityType::class, [
                'class' => Session::class,
                'label' => 'Para',
                'choice_label' => 'username',
                'attr' => [
                ]
            ])
            ->add('affair', TextType::class, [
                'label' => 'Asunto',
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
            /*  ->add('file', EntityType::class, [
                'class' => UploadFileMessage::class,
                'choice_label' => 'id',
                'multiple' => true,
            ]) */;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
