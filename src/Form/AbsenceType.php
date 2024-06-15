<?php

namespace App\Form;

use App\Entity\Absence;
use App\Entity\Schedule;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('absence_date', DateType::class, [
                'label' => 'Fecha de la ausencia',
                'widget' => 'single_text'
            ])
            ->add('hour', EntityType::class, [
                'label' => 'Hora de la ausencia',
                'class' => Schedule::class,
                'choice_label' => 'name'
            ])
            ->add('task', null, [
                'label' => 'Tarea del día'
            ])
            ->add('reason', null, [
                'label' => 'Motivo de la ausencia'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Absence::class,
        ]);
    }
}
