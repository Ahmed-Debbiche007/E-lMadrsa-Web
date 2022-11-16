<?php

namespace App\Form;

use App\Entity\Requests;
use App\Entity\User;
use App\Form\DataTransformer\UserTransformer;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Repository\UserRepository;

class RequestsType extends AbstractType
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idTutor', EntityType::class, array(
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.role = :param')
                        ->setParameter('param','Tutor');
                },
                'choice_label' => 'nom'
            ))
            ->add('idstudent', HiddenType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'MessagesChat' => 'MessagesChat',
                    'VideoChat' => 'VideoChat'
                ]
            ])
            ->add('body', TextareaType::class)
            ->add('date', DateTimeType::class, [

                'widget' => 'single_text',


            ]);
        $builder->get('idstudent')->addModelTransformer(new UserTransformer( $this->userRepository ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Requests::class,
        ]);
    }
}
