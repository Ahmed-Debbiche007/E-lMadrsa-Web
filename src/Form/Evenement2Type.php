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

class Evenement2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEvenement')
            ->add('description')
            ->add('image')
            ->add('date')
            ->add('etatEvenement')
            ->add('IdCate',EntityType::class,[
                'class'=>CategorieEv::class,
                'choice_label'=>'typeEvenement'
            ]) 
            ->add('image', FileType::class, [
                'label' => 'Image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
            ])
           
            
            ->add('IdUser',EntityType::class,[
                'class'=>User::class,
                'choice_label'=>'nom'
            ])
            
            
        ;   
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
