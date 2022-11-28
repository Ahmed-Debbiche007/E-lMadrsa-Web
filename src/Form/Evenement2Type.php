<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\CategorieEv;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
class Evenement2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEvenement')
            ->add('description')
            ->add('image')
            ->add('date', DateTimeType::class, [

                'widget' => 'single_text',


            ])
            ->add('etatEvenement', HiddenType::class)
            ->add('IdCate',EntityType::class,[
                'class'=>CategorieEv::class,
                'choice_label'=>'typeEvenement'
            ]) 
            ->add('image', FileType::class, [
                'label' => 'Image',
            ])
           
            
            ->add('IdUser',HiddenType::class)
            
            
        ;   
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
