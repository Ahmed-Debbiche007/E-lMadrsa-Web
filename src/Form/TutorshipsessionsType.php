<?php

namespace App\Form;

use App\Entity\Tutorshipsessions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use App\Form\DataTransformer\UserTransformer;
use App\Form\DataTransformer\RequestTransformer;
use App\Repository\RequestsRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TutorshipsessionsType extends AbstractType
{
    private $userRepository;
    private $requestRepository;

    public function __construct(UserRepository $userRepository, RequestsRepository $requestRepository)
    {
        $this->userRepository = $userRepository;
        $this->requestRepository= $requestRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idstudent', HiddenType::class)
            ->add('idtutor', HiddenType::class)
            ->add('idrequest', HiddenType::class)
            ->add('url', HiddenType::class)
            
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'MessagesChat' => 'MessagesChat',
                    'VideoChat' => 'VideoChat'
                ]
            ])
            ->add('date', DateTimeType::class, [

                'widget' => 'single_text',


            ])
            ->add('body', TextareaType::class)
        ;
        $builder->get('idstudent')->addModelTransformer(new UserTransformer( $this->userRepository )) ;
        $builder -> get('idtutor')->addModelTransformer(new UserTransformer( $this->userRepository )) ;
        $builder -> get('idrequest')->addModelTransformer(new RequestTransformer( $this->requestRepository ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tutorshipsessions::class,
        ]);
    }
}
