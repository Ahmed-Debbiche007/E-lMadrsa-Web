<?php


namespace App\Form\DataTransformer;



use App\Repository\UserRepository;
use Symfony\Component\Form\DataTransformerInterface;

class UserTransformer implements DataTransformerInterface
{

    private $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($user): ?int
    {
        return ( $user !== null ) ? $user->getId() : null;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($userId)
    {

        if ('' === $userId || null === $userId) {
            return '';
        }

        $user = $this->repository->find( $userId );
        return $user;
    }
}