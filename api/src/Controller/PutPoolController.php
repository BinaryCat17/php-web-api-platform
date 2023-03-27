<?php

namespace App\Controller;

use App\Entity\Pool;
use App\Exception\PoolNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

#[AsController]
class PutPoolController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LoggerInterface $logger
    ) {
        $this->logger->info('PutPoolController here');
    }

    public function __invoke($id, Pool $data): Pool
    {
        $entity = $this->em->find('App\Entity\Pool', $id);
        if (isset($entity))
        {
            $entity->pool_id = $data->pool_id;
            $this->em->flush();
        } else
        {
            throw new PoolNotFoundException(sprintf('The pool "%s" does not exist.', $id));
        }
        return $data;
    }
}

