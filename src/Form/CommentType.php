<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commentcontent')
          //  ->add('userid')
           // ->add('postid')
          //  ->add('commentvote')
          //  ->add('commentdate')
            ->add('user', EntityType::class,array('class'=>User::class,
                'choice_label'=>'nom'))
            ->add('post', EntityType::class,array('class'=>Post::class,
                'choice_label'=>'posttitle'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
