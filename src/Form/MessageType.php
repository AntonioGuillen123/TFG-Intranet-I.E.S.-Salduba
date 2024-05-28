<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\Session;
use Doctrine\ORM\EntityRepository;
use App\Entity\UploadFileMessage;
use App\Repository\SessionRepository;
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
        $username = $options['username'];
        $entityManager = $options['entity'];

        $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

        $builder
            ->add('user_to', EntityType::class, [
                'class' => Session::class,
                'label' => 'Para',
                'choice_label' => 'username',
                'query_builder' => function (SessionRepository $messageRepository) use ($user) {
                    return $messageRepository->createQueryBuilder('s')
                        ->where('s.id != :username')
                        ->setParameter('username', $user->getId());
                },
                'attr' => []
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
            'username' => null,
            'entity' => null
        ]);
    }
}

   /*  $getUsers = function (SessionRepository $messageRepository) use ($username) {
            return $messageRepository->createQueryBuilder('s')
                ->where('s.id = :username')
                ->setParameter([
                    'username' => $username
                ]);
        } */