<?php

namespace App\Form;

use App\Entity\Tutorshipsessions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorshipsessionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idstudent')
            ->add('idtutor')
            ->add('idrequest')
            ->add('url')
            ->add('type')
            ->add('date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tutorshipsessions::class,
        ]);
    }
}
