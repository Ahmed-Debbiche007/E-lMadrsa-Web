<?php


namespace App\Form\DataTransformer;



use App\Repository\RequestsRepository;
use Symfony\Component\Form\DataTransformerInterface;

class RequestTransformer implements DataTransformerInterface
{

    private $repository;

    public function __construct(RequestsRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($request): ?int
    {
        return ( $request !== null ) ? $request->getId() : null;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($requestId)
    {

        if ('' === $requestId || null === $requestId) {
            return '';
        }

        $request = $this->repository->find( $requestId );
        return $request;
    }
}