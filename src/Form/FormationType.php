<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sujet')
            ->add('description')
            ->add('Difficulte', ChoiceType::class,array (

                'choices'=>array(
                    'facile'=>'facile',
                    'moyen'=>'moyen',
                    'difficile'=>'difficile',

                )
            ))
            //->add('Difficulte')
            ->add('duree')
            ->add('prerequis')
            //->add('idprerequis')
            //->add('idcompetence')
            ->add('competences')
            //->add('idexamen')
            ->add('examen')
            //->add('idcategorie')
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
