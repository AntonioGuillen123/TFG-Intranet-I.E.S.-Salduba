<?php

namespace App\Form;

use App\Entity\Crime;
use App\Entity\CrimeMeasure;
use App\Entity\DisciplinePart;
use App\Entity\Student;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisciplinePartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('part_date', null, [
                'label' => 'Fecha de la falta',
                'widget' => 'single_text',
            ])
            ->add('student', EntityType::class, [
                'label' => 'Alumno',
                'class' => Student::class,
                'choice_label' => 'name',
            ])
            ->add('crime', EntityType::class, [
                'label' => 'Motivo de la falta',
                'class' => Crime::class,
                'choice_label' => 'name',
            ])
            ->add('measure', EntityType::class, [
                'label' => 'Sanción de la falta',
                'class' => CrimeMeasure::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DisciplinePart::class,
        ]);
    }
}
