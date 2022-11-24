<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('posttitle')
            ->add('postcontent')
            ->add('user', EntityType::class,array('class'=>User::class,
                'choice_label'=>'nom'))
            ->add('category', EntityType::class,array('class'=>Category::class,
                'choice_label'=>'categoryname'))
           // ->add('postvote')
           // ->add('postnbcom')
           // ->add('postdate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
